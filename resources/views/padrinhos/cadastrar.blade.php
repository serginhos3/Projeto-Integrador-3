<x-app-layout>
    <div class="max-w-3xl w-full mx-auto p-4 bg-white rounded-lg shadow-md mt-10">
        <div class="flex items-center mb-6">
            <a href="{{ route('padrinhos.list') }}"
                class="mr-4 text-gray-500 hover:text-black transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold">Cadastro de Padrinho e Pais</h1>
        </div>


        <ul class="flex border-b mb-6" id="tabs">
            <li class="mr-1">
                <a href="#tab-pessoal"
                    class="inline-block py-2 px-4 font-semibold border-b-2 border-black text-black">Informações
                    Pessoais</a>
            </li>
            <li class="mr-1">
                <a href="#tab-evento" class="inline-block py-2 px-4 text-gray-600 hover:text-black">Informações do
                    Evento</a>
            </li>
            <li class="mr-1">
                <a href="#tab-medidas" class="inline-block py-2 px-4 text-gray-600 hover:text-black">Medidas do
                    Terno</a>
            </li>
        </ul>

        <form method="POST" action="{{ route('padrinhos.store') }}">
            @csrf

            <div id="tab-content">

                <div id="tab-pessoal" class="tab-pane">
                    <h2 class="text-xl font-bold mb-1">Informações Pessoais</h2>
                    <p class="text-sm text-gray-500 mb-6">Preencha os dados pessoais do padrinho.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Nome completo do padrinho">
                        </div>

                        <div class="mb-4">
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black sm:text-sm"
                                placeholder="(00) 00000-0000">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="email@exemplo.com">
                            <p id="emailError" class="mt-1 text-sm text-red-600 hidden">E-mail inválido</p>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                            <textarea name="observacoes" id="observacoes" rows="3" class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Observações adicionais sobre o padrinho/pai"></textarea>
                        </div>
                    </div>
                </div>


                <div id="tab-evento" class="tab-pane hidden">
                    <h2 class="text-xl font-semibold mb-1">Informações do Evento</h2>
                    <p class="text-sm text-gray-500 mb-4">Preencha os dados do evento do padrinho.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="noivo_id" class="block mb-1 font-medium">Noivo</label>
                            <select name="noivo_id" id="noivo_id" class="w-full border rounded-lg px-3 py-2" required>
                                <option value="">Selecione</option>
                                @foreach ($noivos as $noivo)
                                    <option value="{{ $noivo->id }}"
                                        {{ old('noivo_id') == $noivo->id ? 'selected' : '' }}>
                                        {{ $noivo->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="data_locacao" class="block mb-1 font-medium">Data de Locação</label>
                            <input type="date" name="data_locacao" id="data_locacao"
                                value="{{ old('data_locacao') }}" class="w-full border rounded-lg px-3 py-2">
                        </div>

                        <div>
                            <label for="data_retirada" class="block mb-1 font-medium">Data de Retirada</label>
                            <input type="date" name="data_retirada" id="data_retirada"
                                value="{{ old('data_retirada') }}" class="w-full border rounded-lg px-3 py-2">
                        </div>
                        <div class="md:col-span-2">
                            <label for="observacoes_evento" class="block text-sm font-medium text-gray-700">Observações
                                do Evento</label>
                            <textarea name="observacoes_evento" id="observacoes_evento" rows="3"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Observações adicionais sobre o evento"></textarea>
                        </div>
                    </div>
                </div>


                <div id="tab-medidas" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Medidas do Terno</h2>
                    <p class="text-sm text-gray-500 mb-6">Informe as medidas para o traje do padrinho.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="paleto" class="block text-sm font-medium text-gray-700">Paletó</label>
                            <input type="text" name="paleto" id="paleto" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Tamanho do paletó">
                        </div>

                        <div>
                            <label for="calca" class="block text-sm font-medium text-gray-700">Calça</label>
                            <input type="text" name="calca" id="calca" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Tamanho da calça">
                        </div>

                        <div>
                            <label for="camisa" class="block text-sm font-medium text-gray-700">Camisa</label>
                            <input type="text" name="camisa" id="camisa" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Tamanho da camisa">
                        </div>

                        <div>
                            <label for="colete" class="block text-sm font-medium text-gray-700">Colete</label>
                            <input type="text" name="colete" id="colete" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Tamanho do colete">
                        </div>

                        <div>
                            <label for="manga" class="block text-sm font-medium text-gray-700">Manga</label>
                            <input type="text" name="manga" id="manga" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Comprimento da manga">
                        </div>

                        <div>
                            <label for="barra_calca" class="block text-sm font-medium text-gray-700">Barra da
                                Calça</label>
                            <input type="text" name="barra_calca" id="barra_calca" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Altura da barra da calça">
                        </div>
                    </div>


                    <div>
                        <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                        <input type="text" name="modelo" id="modelo"
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Modelo do terno">
                    </div>

                    <div>
                        <label for="cor" class="block text-sm font-medium text-gray-700">Cor</label>
                        <input type="text" name="cor" id="cor"
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Cor do terno">
                    </div>

                    <div class="md:col-span-2">
                        <label for="observacoes_medidas"
                            class="block text-sm font-medium text-gray-700">Observações</label>
                        <textarea name="observacoes_medidas" id="observacoes_medidas" rows="3"
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Observações adicionais sobre as medidas"></textarea>
                    </div>
                </div>
            </div>


            <div class="flex justify-end mt-8 gap-4">
                <a href="{{ route('padrinhos.list') }}"
                    class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>
                <button type="submit"
                    class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                    <i class="fas fa-save"></i> Salvar
                </button>
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

                tabs.forEach(t => t.classList.remove('border-black', 'text-black', 'font-semibold'));
                panes.forEach(p => p.classList.add('hidden'));

                this.classList.add('border-black', 'text-black', 'font-semibold');
                const target = document.querySelector(this.getAttribute('href'));
                target.classList.remove('hidden');
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#telefone').mask('(00) 00000-0000');
        });
    </script>

    <script>
        document.getElementById('email').addEventListener('blur', function() {
            const emailInput = this.value.trim();
            const emailError = document.getElementById('emailError');

            const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput);

            if (!emailValido && emailInput !== '') {
                emailError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                emailError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });
    </script>

    <script>
        const campos = ['paleto', 'calca', 'camisa', 'colete', 'manga', 'barra_calca'];

        campos.forEach(id => {
            const input = document.getElementById(id);

            input.addEventListener('keypress', function(e) {
                const char = String.fromCharCode(e.which);

                // Aceita apenas número, ponto ou vírgula
                if (!/[0-9.,]/.test(char)) {
                    e.preventDefault();
                }
            });

            input.addEventListener('input', function() {
                // Remove tudo que não for número, ponto ou vírgula
                this.value = this.value.replace(/[^0-9.,]/g, '');
            });
        });
    </script>


</x-app-layout>
