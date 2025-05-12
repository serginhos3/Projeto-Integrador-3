<?php

namespace App\Http\Controllers;

use App\Models\Noivo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class NoivosController extends Controller
{
    public function list(Request $request): View
    {
        $noivos = Noivo::withCount('padrinhos')->paginate(10);
        return view('noivos.list', compact('noivos'));
    }

    public function cadastrar(): View
    {
        return view('noivos.cadastrar');
    }

    public function show($id): View
    {
        $noivo = Noivo::with(['evento', 'padrinhos'])->findOrFail($id);

        $noivo->padrinhos_ativos = $noivo->padrinhos->where('status', 'ativo')->count();
        $noivo->padrinhos_inativos = $noivo->padrinhos->where('status', 'inativo')->count();

        return view('noivos.show', compact('noivo'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'endereco' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'observacoesnoivo' => 'nullable|string',

            'datadoevento' => 'nullable|date',
            'localevento' => 'nullable|string|max:255',
            'enderecoevento' => 'nullable|string|max:255',
            'datadalocacao' => 'nullable|date',
            'datadasegundaprova' => 'nullable|date',
            'datadaretirada' => 'nullable|date',
            'observacoesevento' => 'nullable|string',

            'paleto' => 'nullable|string',
            'calca' => 'nullable|string',
            'camisa' => 'nullable|string',
            'colete' => 'nullable|string',
            'manga' => 'nullable|string',
            'barra_calca' => 'nullable|string',
            'modelo' => 'nullable|string',
            'cor' => 'nullable|string',
            'observacoesmedidas' => 'nullable|string',
        ]);

        // Salvar o noivo com os dados validados
        Noivo::create($validatedData);

        return redirect()->route('noivos.list')->with('success', 'Noivo cadastrado com sucesso!');
    }

    public function editar($id)
    {
        $noivo = Noivo::findOrFail($id);
        return view('noivos.editar', compact('noivo'));
    }



    public function atualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'endereco' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'observacoesnoivo' => 'nullable|string',

            'datadoevento' => 'nullable|date',
            'localevento' => 'nullable|string|max:255',
            'enderecoevento' => 'nullable|string|max:255',
            'datadalocacao' => 'nullable|date',
            'datadasegundaprova' => 'nullable|date',
            'datadaretirada' => 'nullable|date',
            'observacoesevento' => 'nullable|string',

            'paleto' => 'nullable|string',
            'calca' => 'nullable|string',
            'camisa' => 'nullable|string',
            'colete' => 'nullable|string',
            'manga' => 'nullable|string',
            'barra_calca' => 'nullable|string',
            'modelo' => 'nullable|string',
            'cor' => 'nullable|string',
            'observacoesmedidas' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('noivos.editar', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $noivo = Noivo::findOrFail($id);
        $noivo->update($validator->validated());

        return redirect()->route('noivos.list')->with('success', 'Noivo atualizado com sucesso!');
    }

    public function alterarStatus(Request $request, $noivo, $status)
    {
        $noivo = Noivo::findOrFail($noivo);

        // Atualiza o status
        $noivo->status = $status;
        $noivo->save();

        return redirect()->back()->with('status', 'Status atualizado com sucesso!');
    }


    public function destroy($id)
    {
        $noivo = Noivo::findOrFail($id);
        $noivo->delete();

        return redirect()->route('noivos.list')->with('success', 'Noivo excluído com sucesso!');
    }
}
