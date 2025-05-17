<x-app-layout>
    <div class="container py-4">
        <div class="row">
           
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-start align-items-center">
                   
                    <a href="{{ route('noivos.list') }}"
                        class="mr-4 text-gray-500 hover:text-black transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    
                    <h1 class="mb-0 ms-3" style="font-size: 1.5rem; font-weight: bold;">Detalhes do Noivo</h1>

                    
                    <a href="{{ route('noivos.editar', $noivo->id) }}"
                        class="btn btn-outline-dark d-flex align-items-center ms-auto">
                        <i class="bi bi-pencil" style="font-size: 1.25rem;"></i>
                        <span class="ms-2">Editar</span>
                    </a>
                </div>
            </div>

            
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4 bg-white">
                    <div class="card-body text-center py-5 px-4">
                        
                        <div class="rounded-circle bg-gradient-to-br from-indigo-500 to-blue-600 text-white fw-bold d-flex align-items-center justify-content-center mx-auto mb-3 shadow"
                            style="width: 70px; height: 70px; font-size: 22px;">
                            {{ strtoupper(substr($noivo->nome, 0, 2)) }}
                        </div>

                        
                        <h5 class="card-title mb-1">{{ $noivo->nome }}</h5>
                        <p class="text-muted mb-1 small">{{ $noivo->email }}</p>
                        <p class="text-muted mb-3"><i class="bi bi-telephone me-1"></i>{{ $noivo->telefone }}</p>

                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-around">
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $noivo->padrinhos_ativos ?? 0 }}</h6>
                                    <small class="text-muted">Padrinhos Ativos</small>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $noivo->padrinhos_inativos ?? 0 }}</h6>
                                    <small class="text-muted">Padrinhos Inativos</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-start bg-light p-3 rounded mb-3 shadow-sm">
                            <h6 class="text-muted mb-1">Observações</h6>
                            <p class="mb-0 small">{{ $noivo->observacoesnoivo ?? 'Nenhuma observação cadastrada.' }}</p>
                        </div>

                        
                        <a href="{{ route('padrinhos.cadastrar') }}"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-person-plus-fill"></i>
                            <span>Adicionar Padrinho</span>
                        </a>
                    </div>
                </div>
            </div>


           
            <div class="col-md-8">
               
                <ul class="nav nav-tabs mb-3 border-0" id="tabsNoivo" role="tablist">
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link active d-flex align-items-center gap-2 px-4 py-2 rounded-pill shadow-sm"
                            data-bs-toggle="tab" data-bs-target="#evento" type="button" role="tab"
                            style="background-color: white; border: 1px solid #dee2e6;">
                            <i class="bi bi-calendar-event text-primary"></i>
                            <span class="fw-medium text-dark">Evento</span>
                        </button>
                    </li>
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link d-flex align-items-center gap-2 px-4 py-2 rounded-pill shadow-sm"
                            data-bs-toggle="tab" data-bs-target="#medidas" type="button" role="tab"
                            style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                            <i class="bi bi-rulers text-success"></i>
                            <span class="fw-medium text-dark">Medidas</span>
                        </button>
                    </li>
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link d-flex align-items-center gap-2 px-4 py-2 rounded-pill shadow-sm"
                            data-bs-toggle="tab" data-bs-target="#padrinhos" type="button" role="tab"
                            style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                            <i class="bi bi-people-fill text-info"></i>
                            <span class="fw-medium text-dark">Padrinhos</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center gap-2 px-4 py-2 rounded-pill shadow-sm"
                            data-bs-toggle="tab" data-bs-target="#pedido" type="button" role="tab"
                            style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                            <i class="bi bi-receipt-cutoff text-warning"></i>
                            <span class="fw-medium text-dark">Pedido</span>
                        </button>
                    </li>
                </ul>

              
                <div class="tab-content bg-white p-4 shadow-sm border rounded-4" id="tabContentNoivo">
                   
                    <div class="tab-pane fade show active" id="evento" role="tabpanel">
                        <h5 class="mb-4 fw-bold d-flex align-items-center gap-2">
                            Detalhes do Evento
                        </h5>

                        <div class="border rounded-4 p-4 bg-light shadow-sm">
                            <div class="row mb-4">
                               
                                <div class="col-md-6 mb-3">
                                    <div class="bg-white rounded p-3 shadow-sm h-100">
                                        <h6 class="text-muted mb-2 d-flex align-items-center gap-2">
                                            <i class="bi bi-calendar-event-fill text-primary"></i>
                                            Data do Evento
                                        </h6>
                                        <p class="mb-0 fw-semibold fs-6">
                                            {{ \Carbon\Carbon::parse($noivo->datadoevento)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>

                                
                                <div class="col-md-6 mb-3">
                                    <div class="bg-white rounded p-3 shadow-sm h-100">
                                        <h6 class="text-muted mb-2 d-flex align-items-center gap-2">
                                            <i class="bi bi-geo-alt-fill text-danger"></i>
                                            Local do Evento
                                        </h6>
                                        <p class="mb-1 fw-semibold">{{ $noivo->localevento }}</p>
                                        <p class="mb-0 small text-muted">{{ $noivo->enderecoevento }}</p>
                                    </div>
                                </div>
                            </div>

                           
                            <div class="mt-3">
                                <div class="bg-white rounded p-3 shadow-sm">
                                    <h6 class="text-muted mb-2 d-flex align-items-center gap-2">
                                        <i class="bi bi-chat-left-text-fill text-secondary"></i>
                                        Observações
                                    </h6>
                                    <p class="mb-0 text-dark fw-medium">
                                        {{ $noivo->observacoesevento ?? 'Nenhuma observação cadastrada.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                  
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

                 
                    <div class="tab-pane fade" id="padrinhos" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                                <i class="bi bi-people-fill text-primary fs-5"></i> Padrinhos
                            </h5>
                            <a href="{{ route('padrinhos.cadastrar') }}" class="btn btn-dark rounded-pill shadow-sm">
                                + Novo Padrinho
                            </a>
                        </div>

                        <div class="bg-white border rounded-4 p-4 shadow-sm">
                            <div class="table-responsive">
                                <table class="table align-middle table-hover">
                                    <thead class="bg-light text-muted text-uppercase small">
                                        <tr>
                                            <th>Nome</th>
                                            <th>Telefone</th>
                                            <th>Locação</th>
                                            <th>Retirada</th>
                                            <th>Status</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($noivo->padrinhos && $noivo->padrinhos->count() > 0)
                                            @foreach ($noivo->padrinhos as $padrinho)
                                                <tr>
                                                    <td class="fw-semibold">{{ $padrinho->nome }}</td>
                                                    <td>{{ $padrinho->telefone }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($padrinho->datadalocacao)->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($padrinho->datadaretirada)->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge rounded-pill {{ $padrinho->status == 'Ativo' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $padrinho->status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('padrinhos.show', $padrinho->id) }}"
                                                            class="btn btn-sm btn-outline-dark rounded-pill d-flex align-items-center justify-content-center gap-2 px-3">
                                                            <i class="bi bi-eye-fill"></i> Ver detalhes
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">Nenhum padrinho
                                                    cadastrado para este noivo.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                
                    <div class="tab-pane fade" id="pedido" role="tabpanel">
                        @if ($noivo->pedido)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="text-muted">
                                        <tr>
                                            <th>Nº Pedido</th>
                                            <th>Noivo</th>
                                            <th>Padrinhos</th>
                                            <th>Data de Locação</th>
                                            <th>Data de Retirada</th>
                                            <th>Valor</th>
                                            <th>Pagamento</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>#{{ $noivo->pedido->id }}</strong></td>
                                            <td>{{ $noivo->nome }}</td>
                                            <td>
                                                <span class="border rounded-circle px-2 text-muted">
                                                    {{ $noivo->pedido->padrinhos->count() }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($noivo->pedido->datadalocacao)->format('d/m/Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($noivo->pedido->datadaretirada)->format('d/m/Y') }}
                                            </td>
                                            <td>R$ {{ number_format($noivo->pedido->valor_total_itens, 2, ',', '.') }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-warning text-white px-3 rounded-pill">Parcial</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary px-3 rounded-pill">Ativo</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm text-muted" type="button"
                                                        data-bs-toggle="dropdown">
                                                        &#8942;
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a href="{{ route('pedidos.show', $noivo->pedido->id) }}"
                                                                class="dropdown-item">Ver detalhes</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('pedidos.editar', $noivo->pedido->id) }}"
                                                                class="dropdown-item">Editar</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">Pedido não cadastrado.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
