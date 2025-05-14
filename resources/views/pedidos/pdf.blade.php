<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Pedido #{{ $pedido->id }}</title>
    <style>
        * {
            font-family: Georgia, serif;
            box-sizing: border-box;
        }

        body {
            font-size: 12px;
            color: #333;
            padding: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            height: 60px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .status-badges span {
            display: inline-block;
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 12px;
            color: #fff;
            margin-right: 5px;
        }

        .ativo {
            background-color: #3b82f6;
        }

        .pago {
            background-color: #10b981;
        }

        .total-box {
            font-size: 16px;
            font-weight: bold;
        }

        .grid {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .card {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
        }

        .card h3 {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .label {
            color: #666;
            font-size: 11px;
        }

        .value {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .section-title {
            font-weight: bold;
            margin: 20px 0 8px;
            font-size: 13px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
            font-size: 11px;
        }

        table th {
            background-color: #f2f2f2;
        }

        .badge {
            background-color: #3b82f6;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ public_path('/img/lotoateliepng.png') }}" alt="Logo" style="height: 100px;">
    </div>


    <div class="header">
        <div><strong>Detalhes do Pedido #{{ $pedido->id }}</strong></div>
        <div class="total-box">
            R$ {{ number_format($pedido->valor_total_itens, 2, ',', '.') }}
        </div>
    </div>

    <table style="width: 100%; table-layout: fixed; border-collapse: separate; border-spacing: 10px;">
        <tr>
            <!-- Cliente -->
            <td style="vertical-align: top; border: 1px solid #ccc; border-radius: 8px; padding: 16px;">
                <h3 style="margin-bottom: 12px;">Informações do Cliente</h3>
                <div style="font-weight: bold; font-size: 12px;">Nome do Noivo</div>
                <div style="margin-bottom: 10px;">{{ $pedido->noivo->nome ?? '-' }}</div>

                <div style="font-weight: bold; font-size: 12px;">Telefone</div>
                <div style="margin-bottom: 10px;">{{ $pedido->noivo->telefone ?? '-' }}</div>

                <div style="font-weight: bold; font-size: 12px;">Email</div>
                <div>{{ $pedido->noivo->email ?? '-' }}</div>
            </td>

            <!-- Datas -->
            <td style="vertical-align: top; border: 1px solid #ccc; border-radius: 8px; padding: 16px;">
                <h3 style="margin-bottom: 12px;">Datas Importantes</h3>
                <div style="font-weight: bold; font-size: 12px;">Data de Locação</div>
                <div style="margin-bottom: 10px;">{{ \Carbon\Carbon::parse($pedido->datadalocacao)->format('d/m/Y') }}
                </div>

                <div style="font-weight: bold; font-size: 12px;">Data da Segunda Prova</div>
                <div style="margin-bottom: 10px;">
                    {{ \Carbon\Carbon::parse($pedido->datadasegundaprova)->format('d/m/Y') }}</div>

                <div style="font-weight: bold; font-size: 12px;">Data de Retirada</div>
                <div style="margin-bottom: 10px;">{{ \Carbon\Carbon::parse($pedido->datadaretirada)->format('d/m/Y') }}
                </div>

                <div style="font-weight: bold; font-size: 12px;">Data do Evento</div>
                <div>{{ \Carbon\Carbon::parse($pedido->datadoevento)->format('d/m/Y') }}</div>
            </td>

            <!-- Pagamento -->
            <td style="vertical-align: top; border: 1px solid #ccc; border-radius: 8px; padding: 16px;">
                <h3 style="margin-bottom: 12px;">Informações de Pagamento</h3>
                <div style="font-weight: bold; font-size: 12px;">Valor Total</div>
                <div style="margin-bottom: 10px;">R$ {{ number_format($pedido->valor_total_itens, 2, ',', '.') }}</div>

                <div style="font-weight: bold; font-size: 12px;">Valor Pago</div>
                <div style="margin-bottom: 10px;">R$ {{ number_format($pedido->valor_total_pago, 2, ',', '.') }}</div>

                <div style="font-weight: bold; font-size: 12px;">Valor Restante</div>
                <div style="margin-bottom: 10px;">R$ {{ number_format($pedido->valor_restante, 2, ',', '.') }}</div>

                <div style="font-weight: bold; font-size: 12px;">Métodos de Pagamento Utilizados</div>
                <ul style="margin-top: 5px; font-size: 11px; padding-left: 16px;">
                    @foreach ($metodosAgrupados as $metodo => $valor)
                        <li>{{ $metodo }}: R$ {{ number_format($valor, 2, ',', '.') }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
    </table>


    <!-- Itens do Pedido -->
    <div class="section-title">Itens do Pedido</div>
    <table>
        <thead>
            <tr>
                <th>Descrição</th>
                <th style="width: 120px;">Valor</th>
            </tr>
        </thead>
        <tbody>
            @php
                $descricoes = explode(',', $pedido->descricao_itens ?? '');
                $valores = explode(',', $pedido->valor_itens ?? '');
            @endphp
            @foreach ($descricoes as $i => $desc)
                <tr>
                    <td>{{ trim($desc) }}</td>
                    <td>R$ {{ number_format((float) ($valores[$i] ?? 0), 2, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>R$ {{ number_format($pedido->valor_total_itens, 2, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Padrinhos -->
    <div class="section-title">Padrinhos Vinculados ao Pedido</div>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Data de Retirada</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pedido->padrinhos as $padrinho)
                <tr>
                    <td>{{ $padrinho->nome }}</td>
                    <td>{{ $padrinho->telefone }}</td>
                    <td>{{ $padrinho->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($padrinho->data_retirada ?? $pedido->datadaretirada)->format('d/m/Y') }}
                    </td>
                    <td><span class="badge">{{ ucfirst($padrinho->status ?? 'Indefinido') }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum padrinho vinculado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Próximos Passos -->
    <div class="section-title">Próximos Passos</div>

    <table style="width: 100%; margin-bottom: 20px;">
        <tr>
            <td style="width: 33%; border: 1px solid #ccc; border-radius: 8px; padding: 12px; text-align: center;">
                <div style="font-weight: bold; font-size: 12px;">Segunda Prova</div>
                <div style="font-size: 10px; color: #666;">Agendada para</div>
                <div style="font-weight: bold; font-size: 12px; margin-top: 4px;">
                    {{ \Carbon\Carbon::parse($pedido->datadasegundaprova)->format('d/m/Y') }}
                </div>
            </td>

            <td style="width: 33%; border: 1px solid #ccc; border-radius: 8px; padding: 12px; text-align: center;">
                <div style="font-weight: bold; font-size: 12px;">Retirada</div>
                <div style="font-size: 10px; color: #666;">Agendada para</div>
                <div style="font-weight: bold; font-size: 12px; margin-top: 4px;">
                    {{ \Carbon\Carbon::parse($pedido->datadaretirada)->format('d/m/Y') }}
                </div>
            </td>

            <td style="width: 33%; border: 1px solid #ccc; border-radius: 8px; padding: 12px; text-align: center;">
                <div style="font-weight: bold; font-size: 12px;">Evento</div>
                <div style="font-size: 10px; color: #666;">Agendado para</div>
                <div style="font-weight: bold; font-size: 12px; margin-top: 4px;">
                    {{ \Carbon\Carbon::parse($pedido->datadoevento)->format('d/m/Y') }}
                </div>
            </td>
        </tr>
    </table>

    <div style="margin-top: 60px; text-align: center;">
        <div style="border-top: 1px solid #333; width: 300px; margin: 0 auto; padding-top: 6px;">
            <span style="font-size: 12px; color: #555;">Assinatura do Responsável</span>
        </div>
    </div>

</body>

</html>
