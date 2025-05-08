<x-app-layout>
    <div class="container py-4">
        <div class="row">
            <!-- Botão de Voltar, Título e Botão de Editar -->
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-start align-items-center">
                    <!-- Botão Voltar -->
                    <a href="{{ route('noivos.list') }}"
                        class="mr-4 text-gray-500 hover:text-black transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <!-- Título -->
                    <h1 class="mb-0 ms-3" style="font-size: 1.5rem; font-weight: bold;">Detalhes do Noivo</h1>

                    <!-- Botão Editar Estilizado -->
                    <a href="{{ route('noivos.editar', $noivo->id) }}"
                        class="btn btn-outline-dark d-flex align-items-center ms-auto">
                        <i class="bi bi-pencil" style="font-size: 1.25rem;"></i>
                        <span class="ms-2">Editar</span>
                    </a>
                </div>
            </div>

            <!-- CARD LATERAL -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 80px; height: 80px; font-size: 24px;">
                            {{ strtoupper(substr($noivo->nome, 0, 2)) }}
                        </div>
                        <h5 class="card-title">{{ $noivo->nome }}</h5>
                        <p class="text-muted">{{ $noivo->email }}</p>
                        <p><i class="bi bi-telephone me-1"></i>{{ $noivo->telefone }}</p>

                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <h6>{{ $noivo->padrinhos_ativos ?? 0 }}</h6>
                                <small class="text-muted">Padrinhos Ativos</small>
                            </div>
                            <div>
                                <h6>{{ $noivo->padrinhos_inativos ?? 0 }}</h6>
                                <small class="text-muted">Padrinhos Inativos</small>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Observações</h6>
                            <p>{{ $noivo->observacoesnoivo ?? 'Nenhuma observação cadastrada.' }}</p>
                        </div>

                        <a href="#" class="btn btn-outline-primary mt-3 w-100">
                            + Adicionar Padrinho
                        </a>
                    </div>
                </div>
            </div>

            <!-- CONTEÚDO DAS ABAS -->
            <div class="col-md-8">
                <!-- ABAS -->
                <ul class="nav nav-tabs mb-3" id="tabsNoivo" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#evento" type="button"
                            role="tab">Informações do Evento</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#medidas" type="button"
                            role="tab">Medidas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#padrinhos" type="button"
                            role="tab">Padrinhos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pedido" type="button"
                            role="tab">Pedido</button>
                    </li>
                </ul>

                <!-- CONTEÚDO DAS ABAS -->
                <div class="tab-content bg-white p-4 shadow-sm border rounded-4" id="tabContentNoivo">
                    <!-- Evento -->
                    <div class="tab-pane fade show active" id="evento" role="tabpanel">
                        <h5 class="mb-4 fw-bold">Detalhes do Evento</h5>
                        <div class="border rounded-4 p-4">
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <h6 class="text-muted mb-1">Data e Hora</h6>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-event me-2"></i>
                                        <div>
                                            <strong>{{ \Carbon\Carbon::parse($noivo->datadoevento)->format('d/m/Y') }}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h6 class="text-muted mb-1">Local</h6>
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-geo-alt me-2 mt-1"></i>
                                        <div>
                                            <strong>{{ $noivo->localevento }}</strong><br>
                                            <small class="text-muted">{{ $noivo->localevento }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h6 class="text-muted mb-1">Observações</h6>
                                <p>{{ $noivo->observacoesevento ?? 'Nenhuma observação cadastrada.' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Medidas -->
                    <div class="tab-pane fade" id="medidas" role="tabpanel">
                        <h5 class="mb-4 fw-bold">Medidas do Terno</h5>
                        <div class="border rounded-4 p-4 bg-light">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="mb-3">
                                        <small class="text-muted">Cor do Terno</small>
                                        <div class="fw-semibold">{{ $noivo->cor ?? '-' }}</div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="mb-3">
                                        <small class="text-muted">Paletó</small>
                                        <div class="fw-semibold">{{ $noivo->paleto ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted">Calça</small>
                                        <div class="fw-semibold">{{ $noivo->calca ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted">Camisa</small>
                                        <div class="fw-semibold">{{ $noivo->camisa ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="mb-3">
                                        <small class="text-muted">Modelo do Terno</small>
                                        <div class="fw-semibold">{{ $noivo->modelo ?? '-' }}</div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="mb-3">
                                        <small class="text-muted">Colete</small>
                                        <div class="fw-semibold">{{ $noivo->colete ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted">Manga</small>
                                        <div class="fw-semibold">{{ $noivo->manga ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted">Barra da Calça</small>
                                        <div class="fw-semibold">{{ $noivo->barra_calca ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted">Observações</h6>
                            <p class="fw-medium">{{ $noivo->observacoesmedidas ?? 'Nenhuma observação cadastrada.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Padrinhos -->
                    <div class="tab-pane fade" id="padrinhos" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0 fw-bold">Padrinhos</h5>
                            <a href="{{ route('padrinhos.cadastrar') }}" class="btn btn-primary">+ Novo Padrinho</a>
                        </div>
                        <div class="border rounded-4 p-4 shadow-sm bg-light">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="text-muted">
                                        <tr>
                                            <th>Nome</th>
                                            <th>Telefone</th>
                                            <th>Data de Locação</th>
                                            <th>Data de Retirada</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($noivo->padrinhos && $noivo->padrinhos->count() > 0)
                                            @foreach ($noivo->padrinhos as $padrinho)
                                                <tr>
                                                    <td>{{ $padrinho->nome }}</td>
                                                    <td>{{ $padrinho->telefone }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($padrinho->datadalocacao)->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($padrinho->datadaretirada)->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $padrinho->status == 'Ativo' ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                                                            {{ $padrinho->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('padrinhos.show', $padrinho->id) }}"
                                                            class="btn btn-outline-primary btn-sm">Ver
                                                            detalhes</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Nenhum padrinho
                                                    cadastrado para este noivo.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Pedido -->
                    <div class="tab-pane fade" id="pedido" role="tabpanel">
                        @if ($noivo->pedido)
                            <h5>Pedido</h5>
                            <p><strong>Descrição:</strong> {{ $noivo->pedido->descricao }}</p>
                            <p><strong>Valor:</strong> R$ {{ number_format($noivo->pedido->valor, 2, ',', '.') }}</p>
                        @else
                            <p class="text-muted">Pedido não cadastrado.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
