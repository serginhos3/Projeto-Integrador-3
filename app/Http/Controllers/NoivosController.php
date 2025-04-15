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

    public function show($id)
    {
        $noivo = Noivo::with(['evento', 'pedido.medidas', 'padrinhos'])->findOrFail($id);

        $noivo->padrinhos_ativos = $noivo->padrinhos->where('status', 'ativo')->count();
        $noivo->padrinhos_inativos = $noivo->padrinhos->where('status', 'inativo')->count();

        return view('noivos.show', compact('noivo'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Informações Pessoais
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'status' => 'required|string',
    
            // Informações do Evento
            'datadoevento' => 'required|date',
            'datadalocacao' => 'required|date',
            'datadasegundaprova' => 'required|date',
            'datadaretirada' => 'required|date',
    
            // Medidas do Terno
            'paleto' => 'required|string|max:255',
            'calca' => 'required|string|max:255',
            'camisa' => 'required|string|max:255',
            'colete' => 'required|string|max:255',
            'manga' => 'required|string|max:255',
            'barra_calca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
        ]);
    
        // Salvar o noivo com os dados validados
        Noivo::create($validatedData);
    
        return redirect()->route('noivos.list')->with('success', 'Noivo cadastrado com sucesso!');
    }
    
    

    public function atualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:noivos,email,' . $id,
            'telefone' => 'nullable|string|max:15',
            'padrinho' => 'nullable|string|max:255',
            'datadoevento' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'endereco' => 'nullable|string|max:255',
            'observacoesnoivo' => 'nullable|string|max:255',
            'localevento' => 'nullable|string|max:255',
            'datadalocacao' => 'nullable|date',
            'datadasegundaprova' => 'nullable|date',
            'datadaretirada' => 'nullable|date',
            'observacoesevento' => 'nullable|string|max:255',
            'observacoesmedidas' => 'nullable|string|max:255',
            'paleto' => 'nullable|string|max:255',
            'calca' => 'nullable|string|max:255',
            'camisa' => 'nullable|string|max:255',
            'colete' => 'nullable|string|max:255',
            'manga' => 'nullable|string|max:255',
            'barra_calca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'cor' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('noivos.editar', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $noivo = Noivo::findOrFail($id);
        $noivo->update($validator->validated());

        return redirect()->route('noivos.list')->with('status', 'Noivo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $noivo = Noivo::findOrFail($id);
        $noivo->delete();

        return redirect()->route('noivos.list')->with('status', 'Noivo excluído com sucesso!');
    }
}
