<x-app-layout>
    <div class="container py-4">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
            <h2 class="fw-bold">Dashboard</h2>
            <div>
                <a href="{{ route('noivos.cadastrar') }}" class="btn btn-dark me-2">+ Novo Noivo</a>
                <a href="{{ route('padrinhos.cadastrar') }}" class="btn btn-outline-dark">+ Novo Padrinho</a>
            </div>
        </div>

        <!-- Cards principais -->
        <div class="row mb-4">
            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">{{ $totalNoivos }}</h4>
                                <small>{{ count($proximosEventos) }} eventos próximos</small>
                            </div>
                            <i class="bi bi-person fs-3"></i>
                        </div>
                        <div class="mt-2 fw-semibold">Total de Noivos</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">{{ $totalPadrinhos }}</h4>
                                <small>Média de {{ number_format($mediaPadrinhosPorNoivo, 1) }} por noivo</small>
                            </div>
                            <i class="bi bi-people fs-3"></i>
                        </div>
                        <div class="mt-2 fw-semibold">Total de Padrinhos</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">{{ $eventosHoje }}</h4>
                                <small>Nenhum evento hoje</small>
                            </div>
                            <i class="bi bi-calendar-day fs-3"></i>
                        </div>
                        <div class="mt-2 fw-semibold">Eventos Hoje</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">{{ $proximosEventosCount }}</h4>
                                <small>Nos próximos 30 dias</small>
                            </div>
                            <i class="bi bi-calendar-event fs-3"></i>
                        </div>
                        <div class="mt-2 fw-semibold">Próximos Eventos</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Próximos Eventos e Padrinhos Recentes -->
        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">Próximos Eventos</h5>
                        <p class="text-muted mb-3">Eventos agendados para os próximos meses</p>

                        @foreach ($proximosEventos as $evento)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar3 me-2 fs-5"></i>
                                    <div>
                                        <div class="fw-semibold">{{ $evento->nome }}</div>
                                        <small>{{ \Carbon\Carbon::parse($evento->datadoevento)->format('d/m/Y') }}</small>
                                    </div>
                                </div>
                                <span class="badge bg-light text-dark">{{ $evento->padrinhos_count }} padrinhos</span>
                                <a href="{{ route('noivos.show', $evento->id) }}"
                                    class="btn btn-sm btn-outline-dark">Ver</a>
                            </div>
                        @endforeach

                        <a href="{{ route('noivos.list') }}" class="btn btn-outline-secondary w-100 mt-3">Ver Todos os
                            Eventos</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">Padrinhos Recentes</h5>
                        <p class="text-muted mb-3">Últimos padrinhos cadastrados no sistema</p>

                        @foreach ($padrinhosRecentes as $padrinho)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle me-2 fs-5"></i>
                                    <div>
                                        <div class="fw-semibold">{{ $padrinho->nome }}</div>
                                        <small>
                                            Noivo:
                                            @if ($padrinho->noivo)
                                                {{ $padrinho->noivo->nome }}
                                            @else
                                                <span class="text-muted">Não vinculado</span>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <small
                                    class="text-muted">Retirada<br>{{ \Carbon\Carbon::parse($padrinho->datadaretirada)->format('d/m/Y') }}</small>
                                <a href="{{ route('padrinhos.show', $padrinho->id) }}"
                                    class="btn btn-sm btn-outline-dark">Ver</a>
                            </div>
                        @endforeach

                        <a href="{{ route('padrinhos.list') }}" class="btn btn-outline-secondary w-100 mt-3">Ver Todos
                            os
                            Padrinhos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
