<x-app-layout>
    <div class="container py-6 mx-auto">


        <div
            class="mb-6 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <a href="{{ route('pedidos.list') }}"
                    class="mr-4 text-gray-500 hover:text-black transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-2xl font-bold">Detalhes do Pedido #{{ $pedido->id }}</h1>
            </div>
            <div>
                <a href="{{ route('pedidos.pdf', $pedido->id) }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-file-pdf"></i> Imprimir
                </a>
                <a href="{{ route('pedidos.editar', $pedido->id) }}" class="btn btn-dark">Editar</a>
            </div>
        </div>


        <div class="bg-white p-4 rounded-lg flex items-center justify-between shadow mb-6">
            <div class="flex flex-col items-start space-y-1">
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 text-sm font-semibold text-white bg-blue-500 rounded-full">
                        Pedido {{ $pedido->status }}
                    </span>
                    <span class="px-3 py-1 text-sm font-semibold text-white bg-green-600 rounded-full">
                        {{ $pedido->status_pagamento }}
                    </span>
                </div>
                <div class="text-xs text-gray-500 mt-1">
                    <span class="mr-4">Status do Pedido</span>
                    <span>Status do Pagamento</span>
                </div>
            </div>

            <div class="text-2xl font-bold text-gray-800">
                R$ {{ number_format($pedido->valor_total_itens, 2, ',', '.') }}
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="fas fa-user"></i> Informações do Cliente
                </h2>
                <div class="mb-3">
                    <p class="text-sm text-gray-500">Nome do Noivo</p>
                    <p class="text-base font-semibold">{{ $pedido->noivo->nome }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-sm text-gray-500">Telefone</p>
                    <p class="text-base font-semibold">{{ $pedido->noivo->telefone }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="text-base font-semibold">{{ $pedido->noivo->email }}</p>
                </div>

                <a href="{{ route('noivos.show', $pedido->noivo->id) }}"
                    class="w-full block mt-4 text-center text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 rounded-md font-medium">
                    Ver Detalhes do Noivo
                </a>
            </div>


            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="fas fa-calendar-alt"></i> Datas Importantes
                </h2>
                <div class="mb-3">
                    <p class="text-sm text-gray-500">Data de Locação</p>
                    <p class="text-base font-semibold">
                        {{ \Carbon\Carbon::parse($pedido->datadalocacao)->format('d/m/Y') }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-sm text-gray-500">Data da Segunda Prova</p>
                    <p class="text-base font-semibold">
                        {{ \Carbon\Carbon::parse($pedido->datadasegundaprova)->format('d/m/Y') }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-sm text-gray-500">Data de Retirada</p>
                    <p class="text-base font-semibold">
                        {{ \Carbon\Carbon::parse($pedido->datadaretirada)->format('d/m/Y') }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-sm text-gray-500">Data do Evento</p>
                    <p class="text-base font-semibold">
                        {{ \Carbon\Carbon::parse($pedido->datadoevento)->format('d/m/Y') }}</p>
                </div>
            </div>


            @php
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
            @endphp

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="fas fa-dollar-sign"></i> Informações de Pagamento
                </h2>

                <div class="mb-3">
                    <p class="text-sm text-gray-500">Valor Total</p>
                    <p class="text-base font-semibold">R$ {{ number_format($pedido->valor_total_itens, 2, ',', '.') }}
                    </p>
                </div>
                <div class="mb-3">
                    <p class="text-sm text-gray-500">Valor Pago</p>
                    <p class="text-base font-semibold">R$ {{ number_format($pedido->valor_total_pago, 2, ',', '.') }}
                    </p>
                </div>
                <div class="mb-3">
                    <p class="text-sm text-gray-500">Valor Restante</p>
                    <p class="text-base font-semibold">R$ {{ number_format($pedido->valor_restante, 2, ',', '.') }}</p>
                </div>

                @if (count($metodosAgrupados))
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Métodos de Pagamento Utilizados</p>
                        <ul class="text-base font-semibold list-disc list-inside text-gray-800">
                            @foreach ($metodosAgrupados as $metodo => $total)
                                <li>{{ $metodo }}: R$ {{ number_format($total, 2, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

        </div>


        <div class="row mt-6 g-4">

            <div class="col-12">
                <div class="p-4 bg-white rounded-lg shadow-sm">
                    <h4 class="text-lg font-semibold mb-4 flex items-center gap-2"> Itens do Pedido</h4>

                    @php
                        $itens = explode(',', $pedido->descricao_itens ?? '');
                        $valores = explode(',', $pedido->valor_itens ?? '');
                    @endphp

                    <div class="divide-y">
                        @foreach ($itens as $index => $item)
                            <div class="d-flex justify-content-between py-2">
                                <span>{{ trim($item) }}</span>
                                <span class="fw-bold">
                                    R$ {{ number_format(floatval($valores[$index] ?? 0), 2, ',', '.') }}
                                </span>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-between pt-2 fw-bold">
                            <span>Total</span>
                            <span>R$ {{ number_format($pedido->valor_total_itens, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="p-4 bg-white rounded-lg shadow-sm">
                    <h4 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <i class="fas fa-user-friends"></i> Padrinhos Vinculados ao Pedido
                    </h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <p class="text-sm text-gray-500">Nome</p>
                                </th>
                                <th>
                                    <p class="text-sm text-gray-500">Telefone</p>
                                </th>
                                <th>
                                    <p class="text-sm text-gray-500">Email</p>
                                </th>
                                <th>
                                    <p class="text-sm text-gray-500">Data de retirada</p>
                                </th>
                                <th>
                                    <p class="text-sm text-gray-500">Status</p>
                                </th>
                                <th>
                                    <p class="text-sm text-gray-500">Ações</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedido->padrinhos as $padrinho)
                                <tr>
                                    <td>{{ $padrinho->nome }}</td>
                                    <td>{{ $padrinho->telefone }}</td>
                                    <td>{{ $padrinho->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pedido->datadaretirada)->format('d/m/Y') }}</td>
                                    <td><span class="badge bg-primary">Ativo</span></td>
                                    <td>
                                        <a href="{{ route('padrinhos.show', $padrinho->id) }}"
                                            class="btn btn-light btn-sm">Ver detalhes</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="col-12">
                <div class="p-4 bg-white rounded-lg shadow-sm">
                    <h5 class="font-bold mb-3">Observações</h5>
                    <p>{{ $pedido->observacoes ?? 'Nenhuma observação.' }}</p>
                </div>
            </div>


            <div class="col-12">
                <div class="p-4 bg-white rounded-lg shadow-sm">
                    <h4 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <i class="fas fa-clock"></i> Próximos Passos
                    </h4>
                    <div class="row text-center">
                        <div class="col">
                            <div class="p-3 border rounded">
                                <p class="font-bold">Segunda Prova</p>
                                <small>Agendada para</small><br>
                                <span
                                    class="fw-bold">{{ \Carbon\Carbon::parse($pedido->datadasegundaprova)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border rounded">
                                <p class="font-bold">Retirada</p>
                                <small>Agendada para</small><br>
                                <span
                                    class="fw-bold">{{ \Carbon\Carbon::parse($pedido->datadaretirada)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border rounded">
                                <p class="font-bold">Evento</p>
                                <small>Agendado para</small><br>
                                <span
                                    class="fw-bold">{{ \Carbon\Carbon::parse($pedido->datadoevento)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
