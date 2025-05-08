<?php

namespace App\Http\Controllers;

use App\Models\Padrinho;
use App\Models\Noivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PadrinhosController extends Controller
{
    public function list(): View
    {
        $padrinhos = Padrinho::with('noivo')->paginate(10);
        return view('padrinhos.list', compact('padrinhos'));
    }

    public function cadastrar(): View
    {
        $noivos = Noivo::all();
        return view('padrinhos.cadastrar', compact('noivos'));
    }

    public function show($id)
    {
        // Buscar o padrinho pelo ID
        $padrinho = Padrinho::findOrFail($id); // Isso busca ou retorna erro 404 se não encontrar

        // Passar o padrinho para a view show.blade.php
        return view('padrinhos.show', compact('padrinho'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'noivo_id' => 'required|exists:noivos,id',
            'nome' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:padrinhos,email',
            'status' => 'nullable|string|max:50',
            'observacoes' => 'nullable|string',
            'datadalocacao' => 'nullable|date',
            'datadaretirada' => 'nullable|date',
            'observacoesevento' => 'nullable|string',

            'paleto' => 'nullable|string|max:255',
            'calca' => 'nullable|string|max:255',
            'camisa' => 'nullable|string|max:255',
            'colete' => 'nullable|string|max:255',
            'manga' => 'nullable|string|max:255',
            'barra_calca' => 'nullable|string|max:255',
            'modelo_terno' => 'nullable|string|max:255',
            'cor_terno' => 'nullable|string|max:255',
            'observacoes_medidas' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('padrinhos.cadastrar')
                ->withErrors($validator)
                ->withInput();
        }

        $padrinho = new Padrinho();
        $padrinho->fill($request->except(['_token']));
        $padrinho->save();

        return redirect()->route('padrinhos.list')->with('status', 'Padrinho cadastrado com sucesso!');
    }

    public function editar($id): View
    {
        $padrinho = Padrinho::findOrFail($id);
        $noivos = Noivo::all();
        return view('padrinhos.editar', compact('padrinho', 'noivos'));
    }

    public function atualizar(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:50',
            'observacoes' => 'nullable|string',
            'noivo_id' => 'required|exists:noivos,id',
            'datadalocacao' => 'nullable|date',
            'datadaretirada' => 'nullable|date',
            'observacoesevento' => 'nullable|string',

            'paleto' => 'nullable|string|max:255',
            'calca' => 'nullable|string|max:255',
            'camisa' => 'nullable|string|max:255',
            'colete' => 'nullable|string|max:255',
            'manga' => 'nullable|string|max:255',
            'barra_calca' => 'nullable|string|max:255',
            'modelo_terno' => 'nullable|string|max:255',
            'cor_terno' => 'nullable|string|max:255',
            'observacoes_medidas' => 'nullable|string',
        ]);

        $padrinho = Padrinho::findOrFail($id);

        $padrinho->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'status' => $request->status,
            'observacoes' => $request->observacoes,
            'noivo_id' => $request->noivo_id,
            'datadalocacao' => $request->datadalocacao,
            'datadaretirada' => $request->datadaretirada,
            'observacoesevento' => $request->observacoes_evento,

            'paleto' => $request->paleto,
            'calca' => $request->calca,
            'camisa' => $request->camisa,
            'colete' => $request->colete,
            'manga' => $request->manga,
            'barra_calca' => $request->barra_calca,
            'modelo_terno' => $request->modelo,
            'cor_terno' => $request->cor,
            'observacoes_medidas' => $request->observacoes_medidas,
        ]);

        return redirect()->route('padrinhos.list')->with('success', 'Padrinho atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $padrinho = Padrinho::findOrFail($id);
        $padrinho->delete();

        return redirect()->route('padrinhos.list')->with('status', 'Padrinho excluído com sucesso!');
    }
}
