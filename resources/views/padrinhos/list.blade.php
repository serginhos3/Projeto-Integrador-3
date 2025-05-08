<x-app-layout>
    <div class="container py-6 mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Padrinhos</h1>
            <a href="{{ route('padrinhos.cadastrar') }}"
                class="bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Novo Padrinho
            </a>
        </div>


        <div class="bg-white p-4 rounded-lg shadow-md overflow-x-auto">

            <div class="relative mb-4">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
                <input type="text" id="searchField" placeholder="Pesquisar padrinho..."
                    class="form-control ps-5 border-0 border-bottom border-secondary-subtle rounded-0 shadow-none bg-transparent"
                    style="font-size: 0.95rem;">
            </div>

            <table id="padrinhosTable" class="min-w-full text-sm text-gray-700">
                <thead class="border-b">
                    <tr class="text-gray-600">
                        <th class="py-3 px-4 text-start">Nome</th>
                        <th class="py-3 px-4 text-start">Telefone</th>
                        <th class="py-3 px-4 text-start">Email</th>
                        <th class="py-3 px-4 text-start">Noivo</th>
                        <th class="py-3 px-4 text-start">Data de Locação</th>
                        <th class="py-3 px-4 text-start">Data de Retirada</th>
                        <th class="py-3 px-4 text-start">Status</th>
                        <th class="py-3 px-4 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($padrinhos as $padrinho)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 font-semibold">{{ $padrinho->nome }}</td>
                            <td class="py-3 px-4">{{ $padrinho->telefone }}</td>
                            <td class="py-3 px-4">{{ $padrinho->email }}</td>
                            <td class="py-3 px-4">{{ $padrinho->noivo->nome ?? '-' }}</td>
                            <td class="py-3 px-4">{{ optional($padrinho->datadalocacao)->format('d/m/Y') }}</td>
                            <td class="py-3 px-4">{{ optional($padrinho->datadaretirada)->format('d/m/Y') }}</td>
                            <td class="py-3 px-4">
                                @if (strtolower($padrinho->status) === 'ativo')
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-200 text-gray-800">Ativo</span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-gray-300 text-gray-700">Inativo</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="text-gray-600 hover:text-black"
                                        data-bs-toggle="dropdown">
                                        &#8942;
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end text-sm shadow-sm rounded-md mt-2">
                                        <li><a class="dropdown-item"
                                                href="{{ route('padrinhos.show', $padrinho->id) }}">Ver detalhes</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('padrinhos.editar', $padrinho->id) }}">Editar</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($padrinhos->isEmpty())
                <div class="text-center text-gray-400 py-4">Nenhum padrinho encontrado.</div>
            @endif
        </div>

        <div class="flex justify-end mt-6">
            {{ $padrinhos->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchField = document.getElementById('searchField');
            const table = document.getElementById('padrinhosTable').getElementsByTagName('tbody')[0];
            const rows = table.getElementsByTagName('tr');

            searchField.addEventListener('input', function() {
                const value = searchField.value.toLowerCase();
                for (let i = 0; i < rows.length; i++) {
                    const padrinhoNome = rows[i].querySelector('td').innerText.toLowerCase();
                    rows[i].style.display = padrinhoNome.includes(value) ? '' : 'none';
                }
            });
        });
    </script>
</x-app-layout>
