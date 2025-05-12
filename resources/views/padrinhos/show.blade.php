<x-app-layout>
    <div class="container py-4">
        <div class="row">
            <!-- Botão de Voltar, Título e Botão de Editar -->
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-start align-items-center">
                    <!-- Botão Voltar -->
                    <a href="{{ route('padrinhos.list') }}"
                        class="mr-4 text-gray-500 hover:text-black transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <!-- Título -->
                    <h1 class="mb-0 ms-3" style="font-size: 1.5rem; font-weight: bold;">Detalhes do Padrinho</h1>

                    <!-- Botão Editar Estilizado -->
                    <a href="{{ route('padrinhos.editar', $padrinho->id) }}"
                        class="btn btn-outline-dark d-flex align-items-center ms-auto">
                        <i class="bi bi-pencil" style="font-size: 1.25rem;"></i>
                        <span class="ms-2">Editar</span>
                    </a>
                </div>
            </div>

            <!-- CARD LATERAL -->
            <div class="col-md-4 mb-4">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body text-center p-4">
                        <div class="mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center shadow"
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #6b73ff, #000dff); color: white; font-size: 24px; font-weight: bold;">
                            {{ strtoupper(substr($padrinho->nome, 0, 2)) }}
                        </div>

                        <h5 class="card-title fw-semibold">{{ $padrinho->nome }}</h5>
                        <p class="text-muted mb-1"><i class="bi bi-envelope me-1"></i>{{ $padrinho->email }}</p>
                        <p class="text-muted"><i class="bi bi-telephone me-1"></i>{{ $padrinho->telefone }}</p>

                        <div class="d-flex justify-content-center gap-4 my-4">
                            <div>
                                @php
                                    $status = strtolower($padrinho->status ?? '');
                                    $statusClass = match ($status) {
                                        'ativo' => 'bg-success text-white',
                                        'inativo' => 'bg-secondary text-white',
                                        'pendente' => 'bg-warning text-dark',
                                        default => 'bg-light text-dark',
                                    };
                                @endphp
                                <span class="badge px-3 py-2 rounded-pill shadow-sm {{ $statusClass }}">
                                    {{ ucfirst($status) ?: 'Sem Status' }}
                                </span>
                                <small class="d-block text-muted mt-1">Status</small>
                            </div>
                        </div>

                        <a href="{{ route('padrinhos.editar', $padrinho->id) }}"
                            class="btn btn-dark w-100 shadow-sm rounded-pill fw-semibold">
                            Editar Padrinho
                        </a>
                    </div>
                </div>
            </div>


            <!-- CONTEÚDO DAS ABAS -->
            <div class="col-md-8">
                <!-- ABAS -->
                <ul class="nav nav-tabs mb-3 border-0" id="tabsPadrinho" role="tablist">
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link active d-flex align-items-center gap-2 px-4 py-2 rounded-pill shadow-sm"
                            data-bs-toggle="tab" data-bs-target="#informacoes" type="button" role="tab"
                            style="background-color: white; border: 1px solid #dee2e6;">
                            <i class="bi bi-person-circle text-primary"></i>
                            <span class="fw-medium text-dark">Informações</span>
                        </button>
                    </li>
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link d-flex align-items-center gap-2 px-4 py-2 rounded-pill shadow-sm"
                            data-bs-toggle="tab" data-bs-target="#evento" type="button" role="tab"
                            style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                            <i class="bi bi-calendar2-week text-success"></i>
                            <span class="fw-medium text-dark">Evento</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center gap-2 px-4 py-2 rounded-pill shadow-sm"
                            data-bs-toggle="tab" data-bs-target="#medidas" type="button" role="tab"
                            style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                            <i class="bi bi-rulers text-info"></i>
                            <span class="fw-medium text-dark">Medidas</span>
                        </button>
                    </li>
                </ul>


                <!-- CONTEÚDO DAS ABAS -->
                <div class="tab-content bg-white p-4 shadow-sm border rounded-4" id="tabContentPadrinho">
                    <!-- Informações Pessoais -->
                    <div class="tab-pane fade show active" id="informacoes" role="tabpanel">
                        <h5 class="mb-4 fw-bold d-flex align-items-center gap-2">
                            <i class="bi bi-person-circle text-primary"></i> Informações Pessoais
                        </h5>

                        <div class="border rounded-4 p-4 bg-light shadow-sm">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <small class="text-muted">Nome</small>
                                    <div class="fw-semibold">{{ $padrinho->nome }}</div>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">Telefone</small>
                                    <div class="fw-semibold"><i
                                            class="bi bi-telephone me-1"></i>{{ $padrinho->telefone }}</div>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">Email</small>
                                    <div class="fw-semibold"><i class="bi bi-envelope me-1"></i>{{ $padrinho->email }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">Status</small>
                                    <div>
                                        @php
                                            $status = strtolower($padrinho->status);
                                        @endphp
                                        @if ($status === 'ativo')
                                            <span class="badge bg-success px-3 py-1 rounded-pill">Ativo</span>
                                        @elseif ($status === 'inativo')
                                            <span class="badge bg-secondary px-3 py-1 rounded-pill">Inativo</span>
                                        @else
                                            <span class="badge bg-light text-muted px-3 py-1 rounded-pill">Não
                                                definido</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <small class="text-muted">Observações</small>
                                    <p class="fw-medium mb-0">
                                        {{ $padrinho->observacoes ?? 'Nenhuma observação cadastrada.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Informações do Evento -->
                    <div class="tab-pane fade" id="evento" role="tabpanel">
                        <h5 class="mb-4 fw-bold d-flex align-items-center">
                            <i class="bi bi-calendar-event me-2 text-primary"></i> Informações do Evento
                        </h5>

                        <div class="border rounded-4 p-4 bg-light shadow-sm">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-calendar-check text-success me-2"></i>
                                        <div>
                                            <small class="text-muted">Data de Locação</small><br>
                                            <span
                                                class="fw-semibold">{{ \Carbon\Carbon::parse($padrinho->datadalocacao)->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-box-arrow-down text-warning me-2"></i>
                                        <div>
                                            <small class="text-muted">Data de Retirada</small><br>
                                            <span
                                                class="fw-semibold">{{ \Carbon\Carbon::parse($padrinho->datadaretirada)->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted mb-2">Observações</h6>
                            <p class="fw-medium mb-0">
                                {{ $padrinho->observacoesevento ?? 'Nenhuma observação cadastrada.' }}
                            </p>
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
                                        <div class="fw-semibold">{{ $padrinho->cor_terno ?? '-' }}</div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="mb-3">
                                        <small class="text-muted">Paletó</small>
                                        <div class="fw-semibold">{{ $padrinho->paleto ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted">Calça</small>
                                        <div class="fw-semibold">{{ $padrinho->calca ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted">Camisa</small>
                                        <div class="fw-semibold">{{ $padrinho->camisa ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="mb-3">
                                        <small class="text-muted">Modelo do Terno</small>
                                        <div class="fw-semibold">{{ $padrinho->modelo_terno ?? '-' }}</div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="mb-3">
                                        <small class="text-muted">Colete</small>
                                        <div class="fw-semibold">{{ $padrinho->colete ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted">Manga</small>
                                        <div class="fw-semibold">{{ $padrinho->manga ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted">Barra da Calça</small>
                                        <div class="fw-semibold">{{ $padrinho->barra_calca ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted">Observações</h6>
                            <p class="fw-medium">{{ $padrinho->observacoesmedidas ?? 'Nenhuma observação cadastrada.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
