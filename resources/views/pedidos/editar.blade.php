<x-app-layout>
    <div class="max-w-3xl w-full mx-auto p-4 bg-white rounded-lg shadow-md mt-10">
        <div class="mb-6">
            <a href="{{ route('pedidos.list') }}" class="text-gray-600 hover:text-black font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Voltar
            </a>
            <h1 class="text-2xl font-semibold mt-4">Editar Pedido</h1>
        </div>

        <ul class="flex border-b mb-6" id="tabs">
            <li class="mr-1">
                <a href="#tab-pessoal" class="inline-block py-2 px-4 font-semibold text-black">Informações Gerais</a>
            </li>
            <li class="mr-1">
                <a href="#tab-padrinhos" class="inline-block py-2 px-4 text-gray-600 hover:text-black">Padrinhos</a>
            </li>
            <li class="mr-1">
                <a href="#tab-itens" class="inline-block py-2 px-4 text-gray-600 hover:text-black">Itens do Pedido</a>
            </li>
            <li class="mr-1">
                <a href="#tab-pagamento" class="inline-block py-2 px-4 text-gray-600 hover:text-black">Pagamentos</a>
            </li>
        </ul>

        <form action="{{ route('pedidos.atualizar', $pedido->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div id="tab-content">
                <div id="tab-pessoal" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Informações Gerais</h2>
                    <p class="text-sm text-gray-500 mb-6">Edite as informações gerais do pedido.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="noivo_id" class="block text-sm font-medium text-gray-700">Noivo</label>
                            <select id="noivo_id" name="noivo_id"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Selecione o Noivo</option>
                                @foreach ($noivos as $noivo)
                                    <option value="{{ $noivo->id }}"
                                        {{ $pedido->noivo_id == $noivo->id ? 'selected' : '' }}>
                                        {{ $noivo->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status do
                                Pedido</label>
                            <select id="status" name="status"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="Ativo" {{ $pedido->status == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="Concluído" {{ $pedido->status == 'Concluído' ? 'selected' : '' }}>
                                    Concluído</option>
                                <option value="Cancelado" {{ $pedido->status == 'Cancelado' ? 'selected' : '' }}>
                                    Cancelado</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="datadalocacao" class="block text-sm font-medium text-gray-700">Data de
                                Locação</label>
                            <input type="date" id="datadalocacao" name="datadalocacao"
                                value="{{ \Carbon\Carbon::parse($pedido->datadalocacao)->format('Y-m-d') }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <div>
                            <label for="datadasegundaprova" class="block text-sm font-medium text-gray-700">Data da
                                Segunda Prova</label>
                            <input type="date" id="datadasegundaprova" name="datadasegundaprova"
                                value="{{ \Carbon\Carbon::parse($pedido->datadasegundaprova)->format('Y-m-d') }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="datadaretirada" class="block text-sm font-medium text-gray-700">Data de
                                Retirada</label>
                            <input type="date" id="datadaretirada" name="datadaretirada"
                                value="{{ \Carbon\Carbon::parse($pedido->datadaretirada)->format('Y-m-d') }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <div>
                            <label for="datadoevento" class="block text-sm font-medium text-gray-700">Data do
                                Evento</label>
                            <input type="date" id="datadoevento" name="datadoevento"
                                value="{{ \Carbon\Carbon::parse($pedido->datadoevento)->format('Y-m-d') }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="status_pagamento" class="block text-sm font-medium text-gray-700">Status do
                                Pagamento</label>
                            <select id="status_pagamento" name="status_pagamento"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="" disabled>Selecione o status</option>
                                <option value="Pendente"
                                    {{ $pedido->status_pagamento == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="Pago" {{ $pedido->status_pagamento == 'Pago' ? 'selected' : '' }}>Pago
                                </option>
                                <option value="Parcial" {{ $pedido->status_pagamento == 'Parcial' ? 'selected' : '' }}>
                                    Parcial</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                        <textarea id="observacoes" name="observacoes" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" rows="4"
                            placeholder="Observações sobre o pedido...">{{ $pedido->observacoes }}</textarea>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('pedidos.list') }}"
                            class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>
                        <button type="submit"
                            class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </div>

                <div id="tab-padrinhos" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Padrinhos Vinculados</h2>
                    <p class="text-sm text-gray-500 mb-6">Selecione os padrinhos que fazem parte deste pedido.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @php $padrinhos = \App\Models\Padrinho::all(); @endphp
                        @foreach ($padrinhos as $padrinho)
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="padrinhos[]" id="padrinho_{{ $padrinho->id }}"
                                    value="{{ $padrinho->id }}"
                                    {{ in_array($padrinho->id, $pedido->padrinhos->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label for="padrinho_{{ $padrinho->id }}">{{ $padrinho->nome }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 d-flex justify-between items-center">
                        <span id="selectedPadrinhos" class="text-lg font-semibold">0 padrinho(s) selecionado(s)</span>
                        <button type="button" class="btn btn-link" id="limparSelecao">Limpar seleção</button>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('pedidos.list') }}"
                            class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>
                        <button type="submit"
                            class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </div>

                <div id="tab-itens" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Itens do Pedido</h2>
                    <p class="text-sm text-gray-500 mb-6">Adicione ou edite os itens do pedido.</p>

                    <div id="itensContainer">
                        @php
                            $descricaoItens = explode(',', $pedido->descricao_itens ?? '');
                            $valoresItens = explode(',', $pedido->valor_itens ?? '');
                        @endphp

                        @foreach ($descricaoItens as $index => $descricao)
                            <div class="item mb-3 d-flex align-items-center">
                                <input type="text" name="descricao[]" class="form-control me-2"
                                    value="{{ trim($descricao) }}" placeholder="Descrição" required>

                                <input type="number" name="valor[]" class="form-control me-2 valor"
                                    value="{{ isset($valoresItens[$index]) ? number_format((float) $valoresItens[$index], 2, '.', '') : '' }}"
                                    step="0.01" min="0" required>

                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="removeItem(this)">Excluir</button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-outline-primary mt-3" onclick="addItem()">+ Adicionar
                        Item</button>

                    <div class="mt-4">
                        <h6 class="font-weight-bold">Valor Total: <span id="span_valor_total_itens">R$ 0,00</span>
                        </h6>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('pedidos.list') }}"
                            class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>
                        <button type="submit"
                            class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </div>

                <div id="tab-pagamento" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Pagamentos</h2>
                    <p class="text-sm text-gray-500 mb-6">Gerencie os pagamentos do pedido.</p>

                    @php
                        $datasPagamentos = explode('|', $pedido->data_pagamento ?? '');
                        $valoresPagamentos = explode('|', $pedido->valor_itens ?? '');
                        $metodosPagamentos = explode('|', $pedido->metodo_pagamento ?? '');
                        $valoresPagamentos = explode('|', $pedido->valor_pagamentos ?? '');
                    @endphp

                    <div id="pagamentosContainer">
                        <input type="hidden" name="valor_total_itens" id="valor_total_itens"
                            value="{{ $pedido->valor_total_itens }}">
                        <input type="hidden" name="valor_total_pago" id="valor_total_pago"
                            value="{{ $pedido->valor_total_pago }}">
                        <input type="hidden" name="valor_restante" id="valor_restante"
                            value="{{ $pedido->valor_restante }}">

                        @foreach ($datasPagamentos as $index => $data)
                            <div class="payment-item mb-3 d-flex align-items-center">
                                <input type="date" name="data_pagamento[]" class="form-control me-2"
                                    value="{{ trim($data) }}" required>

                                <input type="number" name="valor_pagamento[]" class="form-control me-2"
                                    value="{{ isset($valoresPagamentos[$index]) ? number_format((float) $valoresPagamentos[$index], 2, '.', '') : '' }}"
                                    step="0.01" min="0" required>

                                <select name="metodo_pagamento[]" class="form-control me-2" required>
                                    <option value="Cartão de Crédito"
                                        {{ isset($metodosPagamentos[$index]) && trim($metodosPagamentos[$index]) == 'Cartão de Crédito' ? 'selected' : '' }}>
                                        Cartão de Crédito</option>
                                    <option value="Cartão de Débito"
                                        {{ isset($metodosPagamentos[$index]) && trim($metodosPagamentos[$index]) == 'Cartão de Débito' ? 'selected' : '' }}>
                                        Cartão de Débito</option>
                                    <option value="Pix"
                                        {{ isset($metodosPagamentos[$index]) && trim($metodosPagamentos[$index]) == 'Pix' ? 'selected' : '' }}>
                                        Pix</option>
                                </select>

                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="removePayment(this)">Excluir</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-outline-primary mt-3" onclick="addPayment()">+ Adicionar
                        Pagamento</button>

                    <div class="mt-4">
                        <h6 class="font-weight-bold">Valor Total: <span id="span_valor_total_itens_pagamento">R$
                                0,00</span></h6>

                        <h6 class="font-weight-bold">Valor Total Pago: <span id="span_valor_pago">R$ 0,00</span>
                        </h6>
                        <h6 class="font-weight-bold">Valor Restante: <span id="span_valor_restante">R$ 0,00</span>
                        </h6>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('pedidos.list') }}"
                            class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>
                        <button type="submit"
                            class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </div>
            </div>

    </div>

    </form>
    </div>
    <script>
        const tabs = document.querySelectorAll('#tabs a');
        const panes = document.querySelectorAll('.tab-pane');

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                tabs.forEach(t => t.classList.remove('font-semibold', 'text-black'));
                panes.forEach(p => p.classList.add('hidden'));

                this.classList.add('font-semibold', 'text-black');
                const target = document.querySelector(this.getAttribute('href'));
                target.classList.remove('hidden');
            });
        });

        if (tabs.length > 0) tabs[0].click();

        function addItem() {
            const container = document.getElementById('itensContainer');
            const div = document.createElement('div');
            div.classList.add('item', 'mb-3', 'd-flex', 'align-items-center');
            div.innerHTML = `
                <input type="text" name="descricao[]" class="form-control me-2" placeholder="Descrição" required>
                <input type="number" name="valor[]" class="form-control me-2 valor" placeholder="0.00" step="0.01" min="0" required>
                <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.remove()">Excluir</button>
            `;
            container.appendChild(div);
        }

        function atualizarTotalItens() {
            let total = 0;
            const campos = document.querySelectorAll('input[name="valor[]"]');

            campos.forEach(input => {
                const val = parseFloat(input.value.replace(',', '.')) || 0;
                total += val;
            });

            document.getElementById('span_valor_total_itens').textContent = total.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

            const inputTotalHidden = document.getElementById('valor_total_itens');
            if (inputTotalHidden) {
                inputTotalHidden.value = total.toFixed(2);
            }

            // ⬇️ Chamada adicional que sincroniza com a aba de pagamentos
            atualizarPagamentos();
        }


        function atualizarPagamentos() {
            const totalItens = parseFloat(document.getElementById('valor_total_itens')?.value || 0);
            let totalPago = 0;

            const inputsPagamento = document.querySelectorAll('input[name="valor_pagamento[]"]');
            inputsPagamento.forEach(input => {
                const valor = parseFloat(input.value.replace(',', '.')) || 0;
                totalPago += valor;
            });

            const restante = totalItens - totalPago;

            document.getElementById('span_valor_total_itens_pagamento').textContent = totalItens.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

            document.getElementById('span_valor_pago').textContent = totalPago.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

            document.getElementById('span_valor_restante').textContent = restante.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

            // Atualiza também os inputs hidden
            document.getElementById('valor_total_pago').value = totalPago.toFixed(2);
            document.getElementById('valor_restante').value = restante.toFixed(2);
        }

        // Atualizar quando o usuário digitar
        document.addEventListener('input', function(e) {
            if (e.target.matches('input[name="valor_pagamento[]"]')) {
                atualizarPagamentos();
            }
        });

        document.addEventListener('DOMContentLoaded', atualizarPagamentos);

        // Sempre que um campo de valor for alterado
        document.addEventListener('input', function(e) {
            if (e.target.matches('input[name="valor[]"]')) {
                atualizarTotalItens();
            }
        });

        // Atualiza ao carregar a página também
        document.addEventListener('DOMContentLoaded', atualizarTotalItens);

        function addPayment() {
            const container = document.getElementById('pagamentosContainer');
            const div = document.createElement('div');
            div.classList.add('payment-item', 'mb-3', 'd-flex', 'align-items-center');
            div.innerHTML = `
                <input type="date" name="data_pagamento[]" class="form-control me-2" required>
                <input type="number" name="valor_pagamento[]" class="form-control me-2" placeholder="R$ 0,00" step="0.01" min="0" required>
                <select name="metodo_pagamento[]" class="form-control me-2" required>
                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                    <option value="Cartão de Débito">Cartão de Débito</option>
                    <option value="Pix">Pix</option>
                </select>
                <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.remove()">Excluir</button>
            `;
            container.appendChild(div);
        }

        document.addEventListener('DOMContentLoaded', function() {
            function formatar(valor) {
                return parseFloat(valor).toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
            }

            const totalItens = document.getElementById('valor_total_itens')?.value || 0;
            const totalPago = document.getElementById('valor_total_pago')?.value || 0;
            const restante = document.getElementById('valor_restante')?.value || 0;

            // Atualiza os valores nos <span>
            document.getElementById('valorTotalItens').textContent = formatar(totalItens);
            document.getElementById('valorTotalPagamento').textContent = formatar(totalItens);
            document.getElementById('valorPago').textContent = formatar(totalPago);
            document.getElementById('valorRestante').textContent = formatar(restante);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const formatar = valor => parseFloat(valor || 0).toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

            const totalItens = document.getElementById('valor_total_itens')?.value || 0;
            const totalPago = document.getElementById('valor_total_pago')?.value || 0;
            const restante = document.getElementById('valor_restante')?.value || 0;

            const spanItens = document.getElementById('span_valor_itens');
            const spanPago = document.getElementById('span_valor_total_pago');
            const spanRestante = document.getElementById('span_valor_restante');

            if (spanItens) spanItens.textContent = formatar(totalItens);
            if (spanPago) spanPago.textContent = formatar(totalPago);
            if (spanRestante) spanRestante.textContent = formatar(restante);
        });
    </script>
</x-app-layout>
