<x-app-layout>
    <div class="container py-6 mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Pedidos</h1>
            <a href="{{ route('pedidos.criar') }}" class="bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800">
                + Novo Pedido
            </a>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md">
            <div class="relative mb-4">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
                <input type="text" id="searchInput" placeholder="Pesquisar pedido..."
                    class="form-control ps-5 border-0 border-bottom border-secondary-subtle rounded-0 shadow-none bg-transparent"
                    placeholder="Digite para buscar..." style="font-size: 0.95rem;">
            </div>

            <div class="overflow-x-auto">
                <table id="pedidoTable" class="min-w-full text-sm text-gray-700">
                    <thead class="border-b">
                        <tr class="text-gray-600">
                            <th class="py-3 px-4 text-start sortable">Nº Pedido</th>
                            <th class="py-3 px-4 text-start">Noivo</th>
                            <th class="py-3 px-4 text-center">Padrinhos</th>
                            <th class="py-3 px-4 text-start sortable">Data de Locação</th>
                            <th class="py-3 px-4 text-start">Data de Retirada</th>
                            <th class="py-3 px-4 text-start sortable">Valor</th>
                            <th class="py-3 px-4 text-start">Pagamento</th>
                            <th class="py-3 px-4 text-start">Status</th>
                            <th class="py-3 px-4 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold">#{{ $pedido->id }}</td>
                                <td class="py-3 px-4">{{ $pedido->noivo->nome ?? 'Sem Noivo' }}</td>
                                <td class="py-3 px-4 text-center">
                                    <span
                                        class="inline-flex items-center justify-center w-6 h-6 border rounded-full text-xs">
                                        {{ $pedido->padrinhos->count() }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    {{ \Carbon\Carbon::parse($pedido->datadalocacao)->format('d/m/Y') }}</td>
                                <td class="py-3 px-4">
                                    {{ \Carbon\Carbon::parse($pedido->datadaretirada)->format('d/m/Y') }}</td>
                                <td class="py-3 px-4">R$ {{ number_format($pedido->valor_total_itens, 2, ',', '.') }}
                                </td>
                                <td class="py-3 px-4">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full 
                                        @if ($pedido->status_pagamento == 'Pago') bg-green-500 text-white
                                        @elseif($pedido->status_pagamento == 'Parcial') bg-yellow-500 text-white
                                        @else bg-gray-400 text-white @endif">
                                        {{ $pedido->status_pagamento }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full 
                                        @if ($pedido->status == 'Ativo') bg-blue-500 text-white
                                        @elseif($pedido->status == 'Concluído') bg-green-500 text-white
                                        @else bg-red-500 text-white @endif">
                                        {{ $pedido->status }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <div class="relative inline-block text-left">
                                        <button type="button" class="text-gray-600 hover:text-black"
                                            data-bs-toggle="dropdown">
                                            &#8942;
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end text-sm shadow-sm rounded-md mt-2">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('pedidos.show', $pedido->id) }}">Ver detalhes</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('pedidos.editar', $pedido->id) }}">Editar</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('pedidos.status', ['pedido' => $pedido->id, 'status' => 'concluido']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-green-600">Marcar como concluído</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('pedidos.status', ['pedido' => $pedido->id, 'status' => 'cancelado']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-red-600">Cancelar pedido</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('pedidos.destroy', $pedido->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Tem certeza que deseja excluir este pedido? Esta ação não pode ser desfeita.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        Excluir pedido
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-center text-gray-500 text-sm">
                {{ $pedidos->total() }} pedido(s) encontrado(s).
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('pedidoTable').getElementsByTagName('tbody')[0];
            const rows = table.getElementsByTagName('tr');

            searchInput.addEventListener('input', function() {
                const value = searchInput.value.replace('#', '').trim();
                for (let i = 0; i < rows.length; i++) {
                    const pedidoId = rows[i].querySelector('td').innerText.replace('#', '').trim();
                    rows[i].style.display = pedidoId.includes(value) ? '' : 'none';
                }
            });

            document.querySelectorAll('th.sortable').forEach(th => {
                th.style.cursor = 'pointer';
                th.addEventListener('click', function() {
                    const tableEl = th.closest('table');
                    const tbody = tableEl.querySelector('tbody');
                    Array.from(tbody.querySelectorAll('tr'))
                        .sort((a, b) => {
                            const aText = a.cells[th.cellIndex].innerText.replace('R$ ', '')
                                .replace('.', '').replace(',', '.');
                            const bText = b.cells[th.cellIndex].innerText.replace('R$ ', '')
                                .replace('.', '').replace(',', '.');
                            return parseFloat(aText) - parseFloat(bText);
                        })
                        .forEach(tr => tbody.appendChild(tr));
                });
            });
        });
    </script>
</x-app-layout>
