<x-app-layout>
    <div class="container py-4">

        <div class="row">
            <!-- CARD LATERAL -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-size: 24px;">
                            {{ strtoupper(substr($noivo->nome, 0, 2)) }}
                        </div>
                        <h5 class="card-title">{{ $noivo->nome }}</h5>
                        <p class="text-muted">{{ $noivo->email }}</p>
                        <p><i class="bi bi-telephone me-1"></i>{{ $noivo->telefone }}</p>

                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <h6>{{ $noivo->padrinhos_ativos ?? 0 }}</h6>
                                <small class="text-muted">Padrinhos ativos</small>
                            </div>
                            <div>
                                <h6>{{ $noivo->padrinhos_inativos ?? 0 }}</h6>
                                <small class="text-muted">Inativos</small>
                            </div>
                        </div>

                        <a href="#" class="btn btn-outline-primary mt-3 w-100">
                            + Adicionar Padrinho
                        </a>
                    </div>
                </div>
            </div>

            <!-- ÁREA DE CONTEÚDO PRINCIPAL COM TABS -->
            <div class="col-md-8">
                <ul class="nav nav-tabs mb-3" id="tabsNoivo" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#evento" type="button" role="tab">Evento</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#medidas" type="button" role="tab">Medidas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pedido" type="button" role="tab">Pedido</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#padrinhos" type="button" role="tab">Padrinhos</button>
                    </li>
                </ul>

                <div class="tab-content bg-white p-4 shadow-sm border rounded-4" id="tabContentNoivo">
                    <!-- Evento -->
                    <div class="tab-pane fade show active" id="evento" role="tabpanel">
                        @if ($noivo->evento)
                            <h5>Informações do Evento</h5>
                            <p><strong>Data:</strong> {{ $noivo->evento->data_evento->format('d/m/Y') }}</p>
                            <p><strong>Local:</strong> {{ $noivo->evento->local }}</p>
                        @else
                            <p class="text-muted">Evento não cadastrado.</p>
                        @endif
                    </div>

                    <!-- Medidas -->
                    <div class="tab-pane fade" id="medidas" role="tabpanel">
                        @if ($noivo->pedido && $noivo->pedido->medidas)
                            <h5>Medidas do Terno</h5>
                            <p><strong>Paletó:</strong> {{ $noivo->pedido->medidas->paleto }}</p>
                            <p><strong>Calça:</strong> {{ $noivo->pedido->medidas->calca }}</p>
                            <p><strong>Sapato:</strong> {{ $noivo->pedido->medidas->sapato }}</p>
                        @else
                            <p class="text-muted">Medidas não cadastradas.</p>
                        @endif
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

                    <!-- Padrinhos -->
                    <div class="tab-pane fade" id="padrinhos" role="tabpanel">
                        @if ($noivo->padrinhos && $noivo->padrinhos->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach ($noivo->padrinhos as $padrinho)
                                    <li class="list-group-item">
                                        <strong>{{ $padrinho->nome_padrinho }}</strong> — {{ $padrinho->telefone }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Nenhum padrinho cadastrado.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
