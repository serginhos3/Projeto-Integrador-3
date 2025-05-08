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
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 80px; height: 80px; font-size: 24px;">
                            {{ strtoupper(substr($padrinho->nome_padrinho, 0, 2)) }}
                        </div>
                        <h5 class="card-title">{{ $padrinho->nome_padrinho }}</h5>
                        <p class="text-muted">{{ $padrinho->email }}</p>
                        <p><i class="bi bi-telephone me-1"></i>{{ $padrinho->telefone }}</p>

                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <h6>{{ $padrinho->status ?? 'N/A' }}</h6>
                                <small class="text-muted">Status</small>
                            </div>
                        </div>

                        <a href="{{ route('padrinhos.editar', $padrinho->id) }}"
                            class="btn btn-outline-primary mt-3 w-100">
                            Editar Padrinho
                        </a>
                    </div>
                </div>
            </div>

            <!-- CONTEÚDO DAS ABAS -->
            <div class="col-md-8">
                <!-- ABAS -->
                <ul class="nav nav-tabs mb-3" id="tabsPadrinho" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#informacoes"
                            type="button" role="tab">Informações Pessoais</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#evento" type="button"
                            role="tab">Informações do Evento</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#medidas" type="button"
                            role="tab">Medidas</button>
                    </li>
                </ul>

                <!-- CONTEÚDO DAS ABAS -->
                <div class="tab-content bg-white p-4 shadow-sm border rounded-4" id="tabContentPadrinho">
                    <!-- Informações Pessoais -->
                    <div class="tab-pane fade show active" id="informacoes" role="tabpanel">
                        <h5 class="mb-4 fw-bold">Informações Pessoais</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Nome</h6>
                                <p>{{ $padrinho->nome }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Telefone</h6>
                                <p>{{ $padrinho->telefone }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Email</h6>
                                <p>{{ $padrinho->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Status</h6>
                                <p>{{ $padrinho->status }}</p>
                            </div>
                        </div>
                        <h6 class="text-muted">Observações</h6>
                        <p class="fw-medium">{{ $padrinho->observacoes ?? 'Nenhuma observação cadastrada.' }}
                        </p>
                    </div>

                    <!-- Informações do Evento -->
                    <div class="tab-pane fade" id="evento" role="tabpanel">
                        <h5 class="mb-4 fw-bold">Informações do Evento</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Data de Locação</h6>
                                <p>{{ \Carbon\Carbon::parse($padrinho->datadalocacao)->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Data de Retirada</h6>
                                <p>{{ \Carbon\Carbon::parse($padrinho->datadaretirada)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <h6 class="text-muted">Observações</h6>
                        <p class="fw-medium">{{ $padrinho->observacoesevento ?? 'Nenhuma observação cadastrada.' }}
                        </p>
                    </div>

                    <!-- Medidas -->
                    <div class="tab-pane fade" id="medidas" role="tabpanel">
                        <h5 class="mb-4 fw-bold">Medidas do Padrinho</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Paletó</h6>
                                <p>{{ $padrinho->paleto ?? 'Não especificado' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Calça</h6>
                                <p>{{ $padrinho->calca ?? 'Não especificado' }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Camisa</h6>
                                <p>{{ $padrinho->camisa ?? 'Não especificado' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Colete</h6>
                                <p>{{ $padrinho->colete ?? 'Não especificado' }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Manga</h6>
                                <p>{{ $padrinho->manga ?? 'Não especificado' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Barra da Calça</h6>
                                <p>{{ $padrinho->barra_calca ?? 'Não especificado' }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Modelo</h6>
                                <p>{{ $padrinho->modelo_terno ?? 'Não especificado' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Cor</h6>
                                <p>{{ $padrinho->cor_terno ?? 'Não especificado' }}</p>
                            </div>
                        </div>
                        <h6 class="text-muted">Observações</h6>
                        <p class="fw-medium">{{ $padrinho->observacoes_medidas ?? 'Nenhuma observação cadastrada.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
