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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'noivo_id' => 'required|exists:noivos,id',
            'nome' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:padrinhos,email',
            'status' => 'nullable|string|max:50',
            'datadelocacao' => 'nullable|date',
            'dataderetirada' => 'nullable|date',
            'paleto' => 'nullable|string|max:255',
            'calca' => 'nullable|string|max:255',
            'camisa' => 'nullable|string|max:255',
            'colete' => 'nullable|string|max:255',
            'manga' => 'nullable|string|max:255',
            'barra_calca' => 'nullable|string|max:255',
            'modelo_terno' => 'nullable|string|max:255',
            'cor_terno' => 'nullable|string|max:255',
            'observacoes' => 'nullable|string',
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
        $validator = Validator::make($request->all(), [
            'noivo_id' => 'required|exists:noivos,id',
            'nome' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:padrinhos,email,' . $id,
            'status' => 'nullable|string|max:50',
            'datadelocacao' => 'nullable|date',
            'dataderetirada' => 'nullable|date',
            'paleto' => 'nullable|string|max:255',
            'calca' => 'nullable|string|max:255',
            'camisa' => 'nullable|string|max:255',
            'colete' => 'nullable|string|max:255',
            'manga' => 'nullable|string|max:255',
            'barra_calca' => 'nullable|string|max:255',
            'modelo_terno' => 'nullable|string|max:255',
            'cor_terno' => 'nullable|string|max:255',
            'observacoes' => 'nullable|string',
        ]);

        // STORE
        $padrinho = new Padrinho();
        $padrinho->paleto = $request->paleto;
        $padrinho->calca = $request->calca;
        $padrinho->camisa = $request->camisa;
        $padrinho->colete = $request->colete;
        $padrinho->manga = $request->manga;
        $padrinho->barra_calca = $request->barra_calca;
        $padrinho->modelo_terno = $request->modelo_terno;
        $padrinho->cor_terno = $request->cor_terno;
        // Outros campos
        $padrinho->nome = $request->nome;
        $padrinho->email = $request->email;
        $padrinho->telefone = $request->telefone;
        $padrinho->status = $request->status;
        $padrinho->noivo_id = $request->noivo_id;
        $padrinho->datadoevento = $request->datadoevento;
        $padrinho->save();

        // UPDATE
        $padrinho = Padrinho::findOrFail($id);
        $padrinho->paleto = $request->paleto;
        $padrinho->calca = $request->calca;
        $padrinho->camisa = $request->camisa;
        $padrinho->colete = $request->colete;
        $padrinho->manga = $request->manga;
        $padrinho->barra_calca = $request->barra_calca;
        $padrinho->modelo_terno = $request->modelo_terno;
        $padrinho->cor_terno = $request->cor_terno;
        // Outros campos
        $padrinho->nome = $request->nome;
        $padrinho->email = $request->email;
        $padrinho->telefone = $request->telefone;
        $padrinho->status = $request->status;
        $padrinho->noivo_id = $request->noivo_id;
        $padrinho->datadoevento = $request->datadoevento;
        $padrinho->save();

        if ($validator->fails()) {
            return redirect()->route('padrinhos.editar', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $padrinho = Padrinho::findOrFail($id);
        $padrinho->fill($request->except(['_token']));
        $padrinho->save();

        return redirect()->route('padrinhos.list')->with('status', 'Padrinho atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $padrinho = Padrinho::findOrFail($id);
        $padrinho->delete();

        return redirect()->route('padrinhos.list')->with('status', 'Padrinho excluído com sucesso!');
    }
}
