<x-app-layout>
    <div class="container py-4">

        <div class="row">
            <!-- CARD LATERAL -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-size: 24px;">
                            {{ strtoupper(substr($padrinho->nome, 0, 2)) }}
                        </div>
                        <h5 class="card-title">{{ $padrinho->nome }}</h5>
                        <p class="text-muted">{{ $padrinho->email }}</p>
                        <p><i class="bi bi-telephone me-1"></i>{{ $padrinho->telefone }}</p>

                        <a href="{{ route('padrinhos.editar', $padrinho->id) }}" class="btn btn-outline-primary mt-3 w-100">
                            Editar Padrinho
                        </a>
                    </div>
                </div>
            </div>

            <!-- ÁREA DE CONTEÚDO PRINCIPAL COM TABS -->
            <div class="col-md-8">
                <ul class="nav nav-tabs mb-3" id="tabsPadrinho" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Informações Pessoais</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#evento" type="button" role="tab">Informações do Evento</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#medidas" type="button" role="tab">Medidas do Terno</button>
                    </li>
                </ul>

                <div class="tab-content bg-white p-4 shadow-sm border rounded-4" id="tabContentPadrinho">
                    <!-- Informações Pessoais -->
                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                        <h5>Dados Pessoais</h5>
                        <p><strong>Nome:</strong> {{ $padrinho->nome }}</p>
                        <p><strong>Email:</strong> {{ $padrinho->email }}</p>
                        <p><strong>Telefone:</strong> {{ $padrinho->telefone }}</p>
                        <p><strong>Status:</strong> 
                            @if($padrinho->status == 'ativo')
                                <span class="badge bg-success">Ativo</span>
                            @else
                                <span class="badge bg-secondary">Inativo</span>
                            @endif
                        </p>
                    </div>

                    <!-- Informações do Evento -->
                    <div class="tab-pane fade" id="evento" role="tabpanel">
                        <h5>Informações do Evento</h5>
                        <p><strong>Noivo:</strong> {{ $padrinho->noivo->nome ?? 'Não vinculado' }}</p>
                        <p><strong>Data da Locação:</strong> {{ $padrinho->data_locacao ? \Carbon\Carbon::parse($padrinho->data_locacao)->format('d/m/Y') : '-' }}</p>
                        <p><strong>Data da Retirada:</strong> {{ $padrinho->data_retirada ? \Carbon\Carbon::parse($padrinho->data_retirada)->format('d/m/Y') : '-' }}</p>
                    </div>

                    <!-- Medidas -->
                    <div class="tab-pane fade" id="medidas" role="tabpanel">
                        <h5>Medidas do Terno</h5>
                        <p><strong>Paletó:</strong> {{ $padrinho->paleto ?? '-' }}</p>
                        <p><strong>Calça:</strong> {{ $padrinho->calca ?? '-' }}</p>
                        <p><strong>Camisa:</strong> {{ $padrinho->camisa ?? '-' }}</p>
                        <p><strong>Colete:</strong> {{ $padrinho->colete ?? '-' }}</p>
                        <p><strong>Manga:</strong> {{ $padrinho->manga ?? '-' }}</p>
                        <p><strong>Barra da Calça:</strong> {{ $padrinho->barra_calca ?? '-' }}</p>
                        <p><strong>Modelo:</strong> {{ $padrinho->modelo ?? '-' }}</p>
                        <p><strong>Cor:</strong> {{ $padrinho->cor ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
