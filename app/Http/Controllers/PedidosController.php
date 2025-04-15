<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Noivo;

class PedidosController extends Controller
{

    public function list(Request $request): View
    {
        $pedidos = Pedido::all();
        return view('pedidos.list', compact('pedidos'));
    }

    public function criar(): View
    {

        $noivos = Noivo::all();
        return view('pedidos.criar', compact('noivos'));
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'idnoivo' => 'required|exists:noivos,id',
            'valor' => 'required|string',
            'procedimento' => 'required|string',
            'dentista' => 'required|string',
            'status' => 'required|string',
            'data' => 'required|date',
        ]);
    
        $valor = str_replace(['R$', '.', ','], ['', '', '.'], $validatedData['valor']);

        $noivoNome = \App\Models\Noivo::where('id', $validatedData['idnoivo'])->value('nome');
    
        if (is_numeric($valor)) {
            Pedido::create([
                'idnoivo' => $validatedData['idnoivo'],
                'noivo' => $noivoNome,
                'valor' => (float) $valor,
                'procedimento' => $validatedData['procedimento'],
                'dentista' => $validatedData['dentista'],
                'status' => $validatedData['status'],
                'data' => $validatedData['data'],
            ]);
    
            return redirect()->route('pedidos.list')->with('status', 'Pedido criado com sucesso!');
        } else {
            return back()->withErrors(['valor' => 'O valor informado é inválido.']);
        }
    }

    public function buscarNoivos(Request $request)
    {
        $search = $request->input('query');
        $noivos = Noivo::where('nome', 'LIKE', "%{$search}%")->get();

        return response()->json($noivos);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $pedido = Pedido::find($id);

        if ($pedido) {
            $pedido->status = $request->input('status');
            $pedido->save();


            return response()->json(['success' => true, 'message' => 'Status atualizado com sucesso!']);
        }

        return response()->json(['success' => false, 'message' => 'Pedido não encontrado.'], 404);
    }


    public function editar($id): View
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.editar', compact('pedido'));
    }


    public function atualizar(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'noivo' => 'required|string|max:255',
            'valor' => 'required|string',
            'procedimento' => 'nullable|string|max:255',
            'dentista' => 'nullable|string|max:255',
            'status' => 'nullable|string',
            'data' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pedidos.editar', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $valor = str_replace(['R$', '.', ','], ['', '', '.'], $request->input('valor'));

        if (!is_numeric($valor)) {
            return redirect()->route('pedidos.editar', $id)
                ->withErrors(['valor' => 'O valor informado é inválido.'])
                ->withInput();
        }

        $pedido = Pedido::findOrFail($id);
        $pedido->update([
            // 'noivo' => $request->input('noivo'),
            'valor' => (float) $valor,
            'procedimento' => $request->input('procedimento'),
            'dentista' => $request->input('dentista'),
            'status' => $request->input('status'),
            'data' => $request->input('data'),
        ]);

        return redirect()->route('pedidos.list')->with('status', 'Pedido atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return redirect()->route('pedidos.list')->with('status', 'Pedido excluído com sucesso!');
    }

    public function gerarPdf($id)
    {

        $pedido = Pedido::findOrFail($id);

        $logoPath = public_path('/img/logo.jpg');

        $logoData = base64_encode(file_get_contents($logoPath));
        $logoSrc = 'data:image/png;base64,' . $logoData;

        $pdf = PDF::loadView('pedidos.pdf', compact('pedido', 'logoSrc'));

        return $pdf->download('pedido_' . $pedido->id . '.pdf');
    }
}
