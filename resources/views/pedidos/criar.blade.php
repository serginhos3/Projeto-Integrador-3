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
            <h1 class="text-2xl font-semibold mt-4">Novo Pedido</h1>
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

        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf
            <div id="tab-content">
                
                <!-- Informações Gerais -->

                <div id="tab-pessoal" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Informações Gerais</h2>
                    <p class="text-sm text-gray-500 mb-6">Edite as informações gerais do pedido.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="idnoivo" class="block text-sm font-medium text-gray-700">Noivo</label>
                            <select id="idnoivo" name="idnoivo"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Selecione o Noivo</option>
                                @foreach ($noivos as $noivo)
                                    <option value="{{ $noivo->id }}">{{ $noivo->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status do
                                Pedido</label>
                            <select id="status" name="status"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="Ativo">Ativo</option>
                                <option value="Concluído">Concluído</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="datadalocacao" class="block text-sm font-medium text-gray-700">Data de
                                Locação</label>
                            <input type="date" id="datadalocacao" name="datadalocacao"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <div>
                            <label for="datadasegundaprova" class="block text-sm font-medium text-gray-700">Data da
                                Segunda Prova</label>
                            <input type="date" id="datadasegundaprova" name="datadasegundaprova"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="datadaretirada" class="block text-sm font-medium text-gray-700">Data de
                                Retirada</label>
                            <input type="date" id="datadaretirada" name="datadaretirada"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <div>
                            <label for="datadoevento" class="block text-sm font-medium text-gray-700">Data do
                                Evento</label>
                            <input type="date" id="datadoevento" name="datadoevento"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="status_pagamento" class="block text-sm font-medium text-gray-700">Status do
                                Pagamento</label>
                            <select id="status_pagamento" name="status_pagamento"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Selecione o status</option>
                                <option value="Pendente">Pendente</option>
                                <option value="Pago">Pago</option>
                                <option value="Parcial">Parcial</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                        <textarea id="observacoes" name="observacoes" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" rows="4"
                            placeholder="Observações sobre o pedido..."></textarea>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('pedidos.list') }}"
                            class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>
                        <button type="submit"
                            class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                    </div>
                </div>

                <!-- Aba -->
                <div id="tab-padrinhos" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Padrinhos Vinculados</h2>
                    <p class="text-sm text-gray-500 mb-6">Selecione os padrinhos que fazem parte deste pedido.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($padrinhos as $padrinho)
                            <div class="flex items-center space-x-4 p-4 border rounded-lg shadow-md">
                                <input class="form-check-input" type="checkbox" value="{{ $padrinho->id }}"
                                    id="padrinho_{{ $padrinho->id }}" name="padrinhos[]">
                                <label for="padrinho_{{ $padrinho->id }}"
                                    class="text-lg font-semibold">{{ $padrinho->nome }}</label>
                                <a href="{{ route('padrinhos.show', $padrinho->id) }}"
                                    class="btn btn-outline-secondary btn-sm ms-2">Ver Detalhes</a>
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
                            <i class="fas fa-save"></i> Salvar
                        </button>
                    </div>
                </div>

                <!-- Aba -->
                <div id="tab-itens" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Itens do Pedido</h2>
                    <p class="text-sm text-gray-500 mb-6">Adicione ou edite os itens do pedido.<br>
                        <br>Exemplo: Aluguel de terno completo.</p>

                    <div id="itensContainer">
                        <div class="item mb-3 d-flex align-items-center">
                            <input type="text" name="descricao[]" class="form-control me-2"
                                placeholder="Descrição" required>
                            <input type="number" name="valor[]" class="form-control me-2 valor" placeholder="0.00"
                                step="0.01" min="0" required>
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="removeItem(this)">Excluir</button>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-primary mt-3" onclick="addItem()">+ Adicionar
                        Item</button>

                    <div class="mt-4">
                        <h6 class="font-weight-bold">Valor Total: <span id="valorTotalItens">R$ 0,00</span></h6>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('pedidos.list') }}"
                            class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>
                        <button type="submit"
                            class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                    </div>
                </div>

                <!-- Aba -->
                <div id="tab-pagamento" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Pagamentos</h2>
                    <p class="text-sm text-gray-500 mb-6">Gerencie os pagamentos do pedido.</p>

                    <div id="pagamentosContainer">
                        <div class="payment-item mb-3 d-flex align-items-center">
                            <input type="hidden" name="valor_total_itens" id="valor_total_itens" value="0">
                            <input type="hidden" name="valor_total_pago" id="valor_total_pago" value="0">
                            <input type="hidden" name="valor_restante" id="valor_restante" value="0">


                            <input type="date" name="data_pagamento[]" class="form-control me-2" required>
                            <input type="number" name="valor_pagamento[]" class="form-control me-2"
                                placeholder="R$ 0,00" step="0.01" min="0" required>
                            <select name="metodo_pagamento[]" class="form-control me-2" required>
                                <option value="Cartão de Crédito">Cartão de Crédito</option>
                                <option value="Cartão de Crédito">Cartão de Débito</option>
                                <option value="Pix">Pix</option>
                            </select>
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="removePayment(this)">Excluir</button>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-primary mt-3" onclick="addPayment()">+ Adicionar
                        Pagamento</button>

                    <div class="mt-4">
                        <h6 class="font-weight-bold">Valor Total do Pedido: <span id="valorTotalPagamento">R$
                                0,00</span></h6>
                        <h6 class="font-weight-bold">Valor Total Pago: <span id="valorPago">R$ 0,00</span></h6>
                        <h6 class="font-weight-bold">Valor Restante: <span id="valorRestante">R$ 0,00</span></h6>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('pedidos.list') }}"
                            class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>
                        <button type="submit"
                            class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                    </div>
                </div>

                <script>
                    document.getElementById('idnoivo').addEventListener('change', function() {
                        const noivoId = this.value;

                        if (noivoId) {
                            fetch(`/pedidos/obter-informacoes-noivo/${noivoId}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.error) {
                                        alert(data.error);
                                    } else {
                                        function formatDate(dateString) {
                                            return dateString ? dateString.slice(0, 10) : '';
                                        }

                                        document.getElementById('datadalocacao').value = formatDate(data.datadalocacao);
                                        document.getElementById('datadasegundaprova').value = formatDate(data
                                            .datadasegundaprova);
                                        document.getElementById('datadaretirada').value = formatDate(data.datadaretirada);
                                        document.getElementById('datadoevento').value = formatDate(data.datadoevento);
                                    }
                                })
                                .catch(error => {
                                    console.error('Erro ao buscar as informações do noivo:', error);
                                });
                        }
                    });

                    function addItem() {
                        const newItem = document.createElement('div');
                        newItem.classList.add('item', 'mb-3', 'd-flex', 'align-items-center');
                        newItem.innerHTML = `
                            <input type="text" name="descricao[]" class="form-control me-2" placeholder="Descrição" required>
                            <input type="number" name="valor[]" class="form-control me-2 valor" placeholder="0.00" step="0.01" min="0" required>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">Excluir</button>
                        `;
                        document.getElementById('itensContainer').appendChild(newItem);
                        updateTotal();
                    }

                    function removeItem(button) {
                        button.closest('.item').remove();
                        updateTotal();
                    }

                    function addPayment() {
                        const newPayment = document.createElement('div');
                        newPayment.classList.add('payment-item', 'mb-3', 'd-flex', 'align-items-center');
                        newPayment.innerHTML = `
                            <input type="date" name="data_pagamento[]" class="form-control me-2" required>
                            <input type="number" name="valor_pagamento[]" class="form-control me-2" placeholder="R$ 0,00" step="0.01" min="0" required>
                            <select name="metodo_pagamento[]" class="form-control me-2" required>
                                <option value="Cartão de Crédito">Cartão de Crédito</option>
                                <option value="Cartão de Débito">Cartão de Débito</option>
                                <option value="Pix">Pix</option>
                            </select>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removePayment(this)">Excluir</button>
                        `;
                        document.getElementById('pagamentosContainer').appendChild(newPayment);
                        updatePaymentValues();
                    }

                    function removePayment(button) {
                        button.closest('.payment-item').remove();
                        updatePaymentValues();
                    }

                    function updateTotal() {
                        let total = 0;
                        const valores = document.querySelectorAll('input[name="valor[]"]');
                        valores.forEach(function(input) {
                            const value = parseFloat(input.value);
                            if (!isNaN(value)) {
                                total += value;
                            }
                        });

                     
                        document.getElementById('valorTotalItens').textContent = 'R$ ' + total.toLocaleString('pt-BR', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });

                       
                        document.getElementById('valorTotalPagamento').textContent = 'R$ ' + total.toLocaleString('pt-BR', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });

                        const valorTotalItens = document.getElementById('valor_total_itens');
                        if (valorTotalItens) {
                            valorTotalItens.value = total.toFixed(2);
                        }

                        updatePaymentValues();
                    }

                    function updatePaymentValues() {
                        let totalPago = 0;
                        const pagamentos = document.querySelectorAll('input[name="valor_pagamento[]"]');
                        pagamentos.forEach(function(input) {
                            const value = parseFloat(input.value);
                            if (!isNaN(value)) {
                                totalPago += value;
                            }
                        });

                        const totalItens = parseFloat(document.getElementById('valor_total_itens').value) || 0;
                        const valorRestante = totalItens - totalPago;

                        document.getElementById('valorPago').textContent = 'R$ ' + totalPago.toLocaleString('pt-BR', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                        document.getElementById('valorRestante').textContent = 'R$ ' + valorRestante.toLocaleString('pt-BR', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });

                        document.getElementById('valor_total_pago').value = totalPago.toFixed(2);
                        document.getElementById('valor_restante').value = valorRestante.toFixed(2);
                    }

                    document.addEventListener('input', function(event) {
                        if (event.target.name === 'valor[]' || event.target.name === 'valor_pagamento[]') {
                            updateTotal();
                        }
                    });

                    document.querySelector('form').addEventListener('submit', function(e) {
                        updateTotal();
                    });

                    updateTotal();
                    updatePaymentValues();
                </script>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const tabs = document.querySelectorAll('#tabs a');
            const panes = document.querySelectorAll('.tab-pane');
            const form = document.querySelector('form');

            
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    tabs.forEach(t => t.classList.remove('font-semibold', 'border-black',
                        'text-black'));
                    panes.forEach(p => p.classList.add('hidden'));
                    this.classList.add('font-semibold', 'border-black', 'text-black');
                    const target = document.querySelector(this.getAttribute('href'));
                    target.classList.remove('hidden');
                });
            });

            
            document.querySelector('#tabs a').click();

            
            function updateSelectedCount() {
                const selectedCount = document.querySelectorAll('input[name="padrinhos[]"]:checked').length;
                document.getElementById('selectedPadrinhos').textContent =
                    `${selectedCount} padrinho(s) selecionado(s)`;
            }
            updateSelectedCount();
            document.querySelectorAll('input[name="padrinhos[]"]').forEach(cb => {
                cb.addEventListener('change', updateSelectedCount);
            });
            document.getElementById('limparSelecao').addEventListener('click', function() {
                document.querySelectorAll('input[name="padrinhos[]"]').forEach(cb => cb.checked = false);
                updateSelectedCount();
            });

          
            window.addItem = function() {
                const newItem = document.createElement('div');
                newItem.classList.add('item', 'mb-3', 'd-flex', 'align-items-center');
                newItem.innerHTML = `
                    <input type="text" name="descricao[]" class="form-control me-2" placeholder="Descrição" required>
                    <input type="number" name="valor[]" class="form-control me-2 valor" placeholder="0.00" step="0.01" min="0" required>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">Excluir</button>
                `;
                document.getElementById('itensContainer').appendChild(newItem);
                updateTotal();
            }

            window.removeItem = function(btn) {
                btn.closest('.item').remove();
                updateTotal();
            }

           
            window.addPayment = function() {
                const newPayment = document.createElement('div');
                newPayment.classList.add('payment-item', 'mb-3', 'd-flex', 'align-items-center');
                newPayment.innerHTML = `
                    <input type="date" name="data_pagamento[]" class="form-control me-2" required>
                    <input type="number" name="valor_pagamento[]" class="form-control me-2" placeholder="R$ 0,00" step="0.01" min="0" required>
                    <select name="metodo_pagamento[]" class="form-control me-2" required>
                        <option value="Cartão de Crédito">Cartão de Crédito</option>
                        <option value="Cartão de Débito">Cartão de Débito</option>
                        <option value="Pix">Pix</option>
                    </select>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removePayment(this)">Excluir</button>
                `;
                document.getElementById('pagamentosContainer').appendChild(newPayment);
            }

            window.removePayment = function(btn) {
                btn.closest('.payment-item').remove();
                updatePaymentValues();
            }

           
            function updateTotal() {
                let totalItens = 0;
                document.querySelectorAll('input[name="valor[]"]').forEach(input => {
                    const value = parseFloat(input.value) || 0;
                    totalItens += value;
                });

                document.getElementById('valorTotalItens').textContent = 'R$ ' + totalItens.toLocaleString(
                    'pt-BR', {
                        minimumFractionDigits: 2
                    });
                document.getElementById('valor_total_itens').value = totalItens.toFixed(2);

                updatePaymentValues();
            }

         
            function updatePaymentValues() {
                let totalPago = 0;
                document.querySelectorAll('input[name="valor_pagamento[]"]').forEach(input => {
                    const value = parseFloat(input.value) || 0;
                    totalPago += value;
                });

                const totalItens = parseFloat(document.getElementById('valor_total_itens').value) || 0;
                const restante = totalItens - totalPago;

                document.getElementById('valorPago').textContent = 'R$ ' + totalPago.toLocaleString('pt-BR', {
                    minimumFractionDigits: 2
                });
                document.getElementById('valorRestante').textContent = 'R$ ' + restante.toLocaleString('pt-BR', {
                    minimumFractionDigits: 2
                });

                document.getElementById('valor_total_pago').value = totalPago.toFixed(2);
                document.getElementById('valor_restante').value = restante.toFixed(2);
            }

           
            document.addEventListener('input', function(e) {
                if (e.target.matches('input[name="valor[]"], input[name="valor_pagamento[]"]')) {
                    updateTotal();
                }
            });

           
            form.addEventListener('submit', function(e) {
                updateTotal();
            });

            updateTotal();
        });
    </script>

</x-app-layout>
