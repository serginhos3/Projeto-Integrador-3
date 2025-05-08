<x-app-layout>
    <div class="container py-6 mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Noivos</h1>
            <a href="{{ route('noivos.cadastrar') }}"
                class="bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Adicionar Noivo
            </a>
        </div>


        <div class="bg-white p-4 rounded-lg shadow-md overflow-x-auto">
            <div class="relative mb-4">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
                <input type="text" id="searchInput" placeholder="Pesquisar noivo..."
                    class="form-control ps-5 border-0 border-bottom border-secondary-subtle rounded-0 shadow-none bg-transparent"
                    style="font-size: 0.95rem;">
            </div>

            <table id="noivosTable" class="min-w-full text-sm text-gray-700">
                <thead class="border-b">
                    <tr class="text-gray-600">
                        <th class="py-3 px-4 text-start">Nome</th>
                        <th class="py-3 px-4 text-start">Telefone</th>
                        <th class="py-3 px-4 text-start">Email</th>
                        <th class="py-3 px-4 text-start">Evento</th>
                        <th class="py-3 px-4 text-center">Padrinhos</th>
                        <th class="py-3 px-4 text-start">Status</th>
                        <th class="py-3 px-4 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($noivos as $noivo)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 font-semibold">{{ $noivo->nome }}</td>
                            <td class="py-3 px-4">{{ $noivo->telefone }}</td>
                            <td class="py-3 px-4">{{ $noivo->email }}</td>
                            <td class="py-3 px-4">{{ $noivo->datadoevento->format('d/m/Y') }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <span
                                        class="inline-flex items-center justify-center w-6 h-6 border rounded-full text-xs text-gray-700">
                                        {{ $noivo->padrinhos_count }}
                                    </span>
                                    <a href="{{ route('padrinhos.list', ['noivo' => $noivo->id]) }}"
                                        class="text-blue-600 text-xs hover:underline">Ver todos</a>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                @php $status = strtolower($noivo->status ?? 'ativo'); @endphp
                                @if ($status === 'ativo')
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-200 text-gray-800">Ativo</span>
                                @elseif ($status === 'concluido')
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-green-200 text-green-800">Concluído</span>
                                @elseif ($status === 'cancelado')
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-red-200 text-red-800">Cancelado</span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-gray-300 text-gray-700">{{ ucfirst($status) }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="text-gray-600 hover:text-black"
                                        data-bs-toggle="dropdown">
                                        &#8942;
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end text-sm shadow-sm rounded-md mt-2">
                                        <li><a class="dropdown-item" href="{{ route('noivos.show', $noivo->id) }}">Ver
                                                detalhes</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('noivos.editar', $noivo->id) }}">Editar</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('padrinhos.list', ['noivo' => $noivo->id]) }}">Adicionar
                                                padrinho</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form
                                                action="{{ route('noivos.status', ['noivo' => $noivo->id, 'status' => 'concluido']) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-green-600">Marcar como
                                                    concluído</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form
                                                action="{{ route('noivos.status', ['noivo' => $noivo->id, 'status' => 'cancelado']) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-red-600">Cancelar
                                                    evento</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($noivos->isEmpty())
                <div class="text-center text-gray-400 py-4">Nenhum noivo encontrado.</div>
            @endif
        </div>

        <div class="flex justify-end mt-6">
            {{ $noivos->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('noivosTable').getElementsByTagName('tbody')[0];
            const rows = table.getElementsByTagName('tr');

            searchInput.addEventListener('input', function() {
                const value = searchInput.value.toLowerCase();
                for (let i = 0; i < rows.length; i++) {
                    const nomeNoivo = rows[i].querySelector('td').innerText.toLowerCase();
                    rows[i].style.display = nomeNoivo.includes(value) ? '' : 'none';
                }
            });
        });
    </script>
</x-app-layout>
