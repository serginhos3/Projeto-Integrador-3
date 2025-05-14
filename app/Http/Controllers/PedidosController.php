<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Noivo;
use App\Models\Padrinho;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidosController extends Controller
{

    public function list()
    {
        $pedidos = Pedido::with('noivo', 'padrinhos')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pedidos.list', compact('pedidos'));
    }


    public function criar(): View
    {
        $noivos = Noivo::all();
        $padrinhos = Padrinho::all();

        return view('pedidos.criar', compact('noivos', 'padrinhos'));
    }


    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    public function store(Request $request)
    {

        $itens = [];
        $valor_total_itens = 0;

        if ($request->has('descricao') && $request->has('valor')) {
            foreach ($request->descricao as $index => $descricao) {
                $valor = (float) ($request->valor[$index] ?? 0);

                if (!empty($descricao)) {
                    $itens[] = [
                        'descricao' => $descricao,
                        'valor' => $valor,
                    ];
                    $valor_total_itens += $valor;
                }
            }
        }


        $pagamentos = [];
        if ($request->has('data_pagamento') && $request->has('valor_pagamento') && $request->has('metodo_pagamento')) {
            foreach ($request->data_pagamento as $index => $data) {
                $valor_total_pago = (float) ($request->valor_pagamento[$index] ?? 0);
                $metodo = $request->metodo_pagamento[$index] ?? '';

                if (!empty($data)) {
                    $pagamentos[] = [
                        'data_pagamento' => $data,
                        'valor_pago' => $valor_total_pago,
                        'metodo_pagamento' => $metodo,
                    ];
                }
            }
        }


        $data_pagamentos = array_column($pagamentos, 'data_pagamento');
        $metodo_pagamentos = array_column($pagamentos, 'metodo_pagamento');
        $valor_pagamentos = array_column($pagamentos, 'valor_pago');


        $request->merge([
            'itens' => $itens,
            'pagamentos' => $pagamentos,
            'valor_total_itens' => $valor_total_itens,
        ]);


        $validatedData = $request->validate([
            'idnoivo' => 'required|exists:noivos,id',
            'descricao' => 'required|array',
            'descricao.*' => 'required|string',
            'valor' => 'required|array',
            'valor.*' => 'required|numeric',
            'valor_total_itens' => 'required|numeric',
            'valor_total_pago' => 'nullable|numeric',
            'valor_restante' => 'nullable|numeric',
            'status' => 'required|string',
            'datadalocacao' => 'required|date',
            'datadasegundaprova' => 'required|date',
            'datadaretirada' => 'required|date',
            'datadoevento' => 'required|date',
            'status_pagamento' => 'nullable|string',
            'observacoes' => 'nullable|string',
        ]);


        $descricao_itens = implode(', ', $request->descricao);
        $valor_itens = implode(',', $request->valor);


        $pedido = Pedido::create([
            'noivo_id' => $validatedData['idnoivo'],
            'descricao_itens' => $descricao_itens,
            'valor_itens' => $valor_itens,
            'valor_total_itens' => $valor_total_itens,
            'valor_total_pago' => $validatedData['valor_total_pago'] ?? 0,
            'valor_restante' => $validatedData['valor_restante'] ?? ($valor_total_itens - ($validatedData['valor_total_pago'] ?? 0)),
            'status' => $validatedData['status'],
            'datadalocacao' => $validatedData['datadalocacao'],
            'datadasegundaprova' => $validatedData['datadasegundaprova'],
            'datadaretirada' => $validatedData['datadaretirada'],
            'datadoevento' => $validatedData['datadoevento'],
            'status_pagamento' => $validatedData['status_pagamento'] ?? null,
            'observacoes' => $validatedData['observacoes'] ?? null,
            'data_pagamento' => implode('|', $data_pagamentos),
            'valor_pagamentos' => implode('|', $valor_pagamentos),
            'metodo_pagamento' => implode('|', $metodo_pagamentos),
        ]);


        if ($request->has('padrinhos')) {
            $pedido->padrinhos()->attach($request->padrinhos);
        }

        return redirect()->route('pedidos.list')->with('status', 'Pedido criado com sucesso!');
    }



    public function editar($id): View
    {
        $pedido = Pedido::with('padrinhos')->findOrFail($id);
        $noivos = Noivo::all();
        $padrinhos = Padrinho::all();

        return view('pedidos.editar', compact('pedido', 'noivos', 'padrinhos'));
    }




    public function atualizar(Request $request, $id)
    {

        $pedido = Pedido::findOrFail($id);


        $valor_total_itens = 0;
        $descricao_itens = [];
        $valor_itens = [];

        if ($request->has('descricao') && $request->has('valor')) {
            foreach ($request->descricao as $index => $descricao) {
                $valor = (float) ($request->valor[$index] ?? 0);
                if (!empty($descricao)) {
                    $descricao_itens[] = $descricao;
                    $valor_itens[] = $valor;
                    $valor_total_itens += $valor;
                }
            }
        }


        $valor_total_pago = 0;
        $data_pagamentos = [];
        $valor_pagamentos = [];
        $metodo_pagamentos = [];

        if (
            $request->has('data_pagamento') &&
            $request->has('valor_pagamento') &&
            $request->has('metodo_pagamento')
        ) {
            foreach ($request->data_pagamento as $index => $data) {
                $valor_pago = (float) ($request->valor_pagamento[$index] ?? 0);
                $metodo = $request->metodo_pagamento[$index] ?? '';

                if (!empty($data)) {
                    $data_pagamentos[] = $data;
                    $valor_pagamentos[] = $valor_pago;
                    $metodo_pagamentos[] = $metodo;
                    $valor_total_pago += $valor_pago;
                }
            }
        }

        $validatedData = $request->validate([
            'noivo_id' => 'required|exists:noivos,id',
            'status' => 'required|string',
            'status_pagamento' => 'nullable|string',
            'datadalocacao' => 'required|date',
            'datadasegundaprova' => 'required|date',
            'datadaretirada' => 'required|date',
            'datadoevento' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $pedido->update([
            'noivo_id' => $validatedData['noivo_id'],
            'descricao_itens' => implode(', ', $descricao_itens),
            'valor_itens' => implode(',', $valor_itens),
            'valor_total_itens' => $valor_total_itens,
            'valor_total_pago' => $valor_total_pago,
            'valor_restante' => $valor_total_itens - $valor_total_pago,
            'data_pagamento' => implode('|', $data_pagamentos),
            'valor_pagamentos' => implode('|', $valor_pagamentos),
            'metodo_pagamento' => implode('|', $metodo_pagamentos),
            'status' => $validatedData['status'],
            'status_pagamento' => $validatedData['status_pagamento'] ?? null,
            'datadalocacao' => $validatedData['datadalocacao'],
            'datadasegundaprova' => $validatedData['datadasegundaprova'],
            'datadaretirada' => $validatedData['datadaretirada'],
            'datadoevento' => $validatedData['datadoevento'],
            'observacoes' => $validatedData['observacoes'] ?? null,
        ]);


        $pedido->padrinhos()->sync($request->padrinhos ?? []);

        return redirect()->route('pedidos.list')->with('status', 'Pedido atualizado com sucesso!');
    }



    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return redirect()->route('pedidos.list')->with('status', 'Pedido excluído com sucesso!');
    }


    public function obterInformacoesNoivo($id)
    {
        $noivo = Noivo::find($id);

        if ($noivo) {
            return response()->json([
                'datadalocacao' => $noivo->datadalocacao,
                'datadasegundaprova' => $noivo->datadasegundaprova,
                'datadaretirada' => $noivo->datadaretirada,
                'datadoevento' => $noivo->datadoevento,
            ]);
        }

        return response()->json(['error' => 'Noivo não encontrado'], 404);
    }

    public function gerarPdf($id)
    {
        $pedido = Pedido::findOrFail($id);

        // processa os métodos e valores como fizemos no blade
        $metodos = explode('|', $pedido->metodo_pagamento ?? '');
        $valores = explode('|', $pedido->valor_pagamentos ?? '');
        $metodosAgrupados = [];

        foreach ($metodos as $index => $metodo) {
            $metodo = trim($metodo);
            $valor = isset($valores[$index]) ? (float) $valores[$index] : 0;

            if (!empty($metodo)) {
                if (!isset($metodosAgrupados[$metodo])) {
                    $metodosAgrupados[$metodo] = 0;
                }
                $metodosAgrupados[$metodo] += $valor;
            }
        }

        $pdf = Pdf::loadView('pedidos.pdf', compact('pedido', 'metodosAgrupados'));
        return $pdf->download('pedido_' . $pedido->id . '.pdf');
    }
}
