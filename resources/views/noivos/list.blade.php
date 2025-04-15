<x-app-layout>
    <div class="container py-6">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h1 class="fw-bold fs-3 text-dark-emphasis m-0">📋 Noivos</h1>
            <a href="{{ route('noivos.cadastrar') }}"
                class="btn btn-outline-dark d-flex align-items-center gap-2 shadow-sm rounded-pill px-4 py-2">
                <i class="bi bi-plus-lg"></i> <span>Adicionar Noivo</span>
            </a>
        </div>

        <div class="mb-4 position-relative">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
            <input type="text" id="myInputTextField"
                class="form-control ps-5 border-0 border-bottom border-secondary-subtle rounded-0 shadow-none bg-transparent"
                placeholder="Digite para buscar..." style="font-size: 0.95rem;">
        </div>

        <div class="table-responsive shadow rounded-4 border border-light-subtle"
            style="overflow-x: auto;">
            <table id="noivosTable" class="table align-middle mb-0">
                <thead class="bg-light text-secondary text-uppercase small">
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th><i class="bi bi-calendar3"></i> Evento</th>
                        <th><i class="bi bi-people"></i> Padrinhos</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($noivos as $noivo)
                        <tr>
                            <td class="fw-semibold">{{ $noivo->nome }}</td>
                            <td>{{ $noivo->telefone }}</td>
                            <td>{{ $noivo->email }}</td>
                            <td>{{ $noivo->datadoevento->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light border text-secondary"
                                        style="width: 28px; height: 28px; font-size: 0.85rem;">
                                        {{ $noivo->padrinhos_count }}
                                    </span>
                                    <a href="{{ route('padrinhos.list', ['noivo' => $noivo->id]) }}"
                                        class="text-primary text-decoration-none" style="font-size: 0.9rem;">
                                        Ver todos
                                    </a>
                                </div>
                            </td>
                            <td>
                                @php $status = strtolower($noivo->status ?? 'ativo'); @endphp
                                @if ($status === 'ativo')
                                    <span class="badge bg-dark-subtle text-dark-emphasis px-3 rounded-pill">Ativo</span>
                                @elseif ($status === 'concluido')
                                    <span class="badge bg-success-subtle text-success-emphasis px-3 rounded-pill">Concluído</span>
                                @elseif ($status === 'cancelado')
                                    <span class="badge bg-danger-subtle text-danger-emphasis px-3 rounded-pill">Cancelado</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis px-3 rounded-pill">{{ ucfirst($status) }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm py-2 px-1 rounded-3">
                                        <li class="px-3 py-1 fw-bold text-dark" style="font-size: 0.95rem;">Ações</li>
                                        <li><a href="{{ route('noivos.show', $noivo->id) }}"
                                                class="dropdown-item px-3">Ver detalhes</a></li>
                                        <li><a href="{{ route('noivos.editar', $noivo->id) }}"
                                                class="dropdown-item px-3">Editar</a></li>
                                        <li><a href="{{ route('padrinhos.list', ['noivo' => $noivo->id]) }}"
                                                class="dropdown-item px-3">Adicionar padrinho</a></li>
                                        <li>
                                            <hr class="dropdown-divider my-1">
                                        </li>
                                        <li>
                                            <form action="{{ route('noivos.status', ['noivo' => $noivo->id, 'status' => 'concluido']) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-success px-3">Marcar como concluído</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('noivos.status', ['noivo' => $noivo->id, 'status' => 'cancelado']) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger px-3">Cancelar evento</button>
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
                <div class="text-center text-muted py-4">Nenhum noivo encontrado.</div>
            @endif
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $noivos->links() }}
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#noivosTable').DataTable({
                paging: false,
                info: false,
                searching: true,
                language: {
                    search: "",
                    searchPlaceholder: "Pesquisar noivos..."
                },
                responsive: true
            });

            $('#myInputTextField').on('keyup', function() {
                $('#noivosTable').DataTable().search(this.value).draw();
            });
        });
    </script>

    <style>
        .dropdown-menu {
            min-width: 180px;
            font-size: 0.92rem;
            border-radius: 0.75rem;
            border: 1px solid #e2e6ea;
        }

        .dropdown-item {
            padding-top: 6px;
            padding-bottom: 6px;
            border-radius: 0.375rem;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-divider {
            border-top: 1px solid #e9ecef;
        }

        @media (max-width: 576px) {
            th, td {
                white-space: nowrap;
            }

            .table-responsive {
                border: none;
            }

            .btn {
                font-size: 0.875rem;
            }

            .fs-3 {
                font-size: 1.25rem !important;
            }
        }
    </style>
</x-app-layout>
