<x-app-layout>
    <div class="container py-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold fs-3 text-dark-emphasis">👔 Padrinhos</h1>
            <a href="{{ route('padrinhos.cadastrar') }}"
                class="btn btn-dark d-flex align-items-center gap-2 shadow-sm rounded-pill px-4 py-2">
                <i class="bi bi-plus-lg"></i> <span>Novo Padrinho</span>
            </a>
        </div>

        <div class="mb-4 position-relative">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
            <input type="text" id="searchField"
                class="form-control ps-5 border-0 border-bottom border-secondary-subtle rounded-0 shadow-none bg-transparent"
                placeholder="Pesquisar padrinhos..." style="font-size: 0.95rem;">
        </div>

        <div class="table-responsive shadow rounded-4 border border-light-subtle" style="overflow: visible;">
            <table id="padrinhosTable" class="table align-middle mb-0">
                <thead class="bg-light text-secondary text-uppercase small">
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Noivo</th>
                        <th>Data de Locação</th>
                        <th>Data de Retirada</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($padrinhos as $padrinho)
                        <tr>
                            <td class="fw-semibold">{{ $padrinho->nome }}</td>
                            <td>{{ $padrinho->telefone }}</td>
                            <td>{{ $padrinho->email }}</td>
                            <td>{{ $padrinho->noivo->nome ?? '-' }}</td>
                            <td>{{ $padrinho->data_locacao?->format('d/m/Y') }}</td>
                            <td>{{ $padrinho->data_retirada?->format('d/m/Y') }}</td>
                            <td>
                                @php $status = strtolower($padrinho->status ?? 'ativo'); @endphp
                                @if ($status === 'ativo')
                                    <span class="badge rounded-pill bg-dark text-white px-3">Ativo</span>
                                @else
                                    <span class="badge rounded-pill bg-light text-secondary px-3">Inativo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <h6 class="dropdown-header fs-6 fw-bold text-dark">Ações</h6>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('padrinhos.show', $padrinho->id) }}">
                                                <i class="bi bi-eye me-2"></i> Ver detalhes
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('padrinhos.editar', $padrinho->id) }}">
                                                <i class="bi bi-pencil me-2"></i> Editar
                                            </a>
                                        </li>
                                        {{-- <li>
                                            <a class="dropdown-item text-danger d-flex align-items-center"
                                                href="{{ route('padrinhos.desativar', $padrinho->id) }}">
                                                <i class="bi bi-x-circle me-2"></i> Desativar
                                            </a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($padrinhos->isEmpty())
                <div class="text-center text-muted py-4">Nenhum padrinho encontrado.</div>
            @endif
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $padrinhos->links() }}
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#tabela-padrinhos').DataTable({
                searching: false, // 👈 Isso desativa a busca automática do DataTables
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
                },
                // Outras opções, se tiver
            });
        });
    </script>
    

    <style>
        .dropdown-menu {
            min-width: 180px;
            font-size: 0.9rem;
            border-radius: 0.75rem;
            padding: 0.5rem 0;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s ease;
            padding: 0.5rem 1rem;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-header {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
    </style>

</x-app-layout>
