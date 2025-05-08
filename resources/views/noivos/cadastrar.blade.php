<x-app-layout>
    <div class="max-w-3xl w-full mx-auto p-4 bg-white rounded-lg shadow-md mt-10">
        <div class="flex items-center mb-6">
            <a href="{{ route('noivos.list') }}"
                class="mr-4 text-gray-500 hover:text-black transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold">Cadastro de Noivo</h1>
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

        <form method="POST" action="{{ route('noivos.store') }}">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger rounded p-3">
                    <strong>Por favor, corrija os erros abaixo:</strong>
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div id="tab-content">

                <div id="tab-pessoal" class="tab-pane">
                    <h2 class="text-xl font-bold mb-1">Informações Pessoais</h2>
                    <p class="text-sm text-gray-500 mb-6">Preencha os dados pessoais do noivo para cadastro no sistema.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                            <input type="text" name="nome" id="nome" 
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('nome') is-invalid @enderror"
                                value="{{ old('nome') }}" placeholder="Nome completo do noivo">
                            @error('nome')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black sm:text-sm @error('telefone') is-invalid @enderror"
                                value="{{ old('telefone') }}" placeholder="(00) 00000-0000">
                            @error('telefone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="email@exemplo.com">
                            <p id="emailError" class="mt-1 text-sm text-red-600 hidden">E-mail inválido</p>
                        </div>

                        <div>
                            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <input type="text" name="endereco" id="endereco"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Endereço completo">
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
                            <textarea name="observacoesnoivo" id="observacoesnoivo" rows="3"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Observações adicionais sobre o noivo"></textarea>
                        </div>
                    </div>
                </div>


                <div id="tab-evento" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Informações do Evento</h2>
                    <p class="text-sm text-gray-500 mb-6">Detalhes sobre o evento e datas importantes.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="datadoevento" class="block text-sm font-medium text-gray-700">Data do
                                Evento</label>
                            <input type="date" name="datadoevento" id="datadoevento"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('datadoevento') is-invalid @enderror"
                                value="{{ old('datadoevento') }}">
                            @error('datadoevento')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="localevento" class="block text-sm font-medium text-gray-700">Local do
                                Evento</label>
                            <input type="text" name="localevento" id="localevento"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Local onde será realizado o evento">
                        </div>

                        <div>
                            <label for="datadalocacao" class="block text-sm font-medium text-gray-700">Data de
                                Locação</label>
                            <input type="date" name="datadalocacao" id="datadalocacao"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('datadalocacao') is-invalid @enderror"
                                value="{{ old('datadalocacao') }}">
                            @error('datadalocacao')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="datadasegundaprova" class="block text-sm font-medium text-gray-700">Data da
                                Segunda Prova</label>
                            <input type="date" name="datadasegundaprova" id="datadasegundaprova"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('datadasegundaprova') is-invalid @enderror"
                                value="{{ old('datadasegundaprova') }}">
                            @error('datadasegundaprova')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="datadaretirada" class="block text-sm font-medium text-gray-700">Data de
                                Retirada</label>
                            <input type="date" name="datadaretirada" id="datadaretirada"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('datadaretirada') is-invalid @enderror"
                                value="{{ old('datadaretirada') }}">
                            @error('datadaretirada')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="observacoesevento" class="block text-sm font-medium text-gray-700">Observações
                                do Evento</label>
                            <textarea name="observacoesevento" id="observacoesevento" rows="3"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Observações adicionais sobre o evento"></textarea>
                        </div>
                    </div>
                </div>


                <div id="tab-medidas" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Medidas do Terno</h2>
                    <p class="text-sm text-gray-500 mb-6">Informe os detalhes exatos para o terno do noivo.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="paleto" class="block text-sm font-medium text-gray-700">Paletó</label>
                            <input type="text" name="paleto" id="paleto" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('paleto') is-invalid @enderror"
                                value="{{ old('paleto') }}" placeholder="Tamanho do paletó">
                            @error('paleto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="calca" class="block text-sm font-medium text-gray-700">Calça</label>
                            <input type="text" name="calca" id="calca" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('calca') is-invalid @enderror"
                                value="{{ old('calca') }}" placeholder="Tamanho da calça">
                            @error('calca')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="camisa" class="block text-sm font-medium text-gray-700">Camisa</label>
                            <input type="text" name="camisa" id="camisa" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('camisa') is-invalid @enderror"
                                value="{{ old('camisa') }}" placeholder="Tamanho da camisa">
                            @error('camisa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="colete" class="block text-sm font-medium text-gray-700">Colete</label>
                            <input type="text" name="colete" id="colete" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('colete') is-invalid @enderror"
                                value="{{ old('colete') }}" placeholder="Tamanho do colete">
                            @error('colete')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="manga" class="block text-sm font-medium text-gray-700">Manga</label>
                            <input type="text" name="manga" id="manga" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('manga') is-invalid @enderror"
                                value="{{ old('manga') }}" placeholder="Comprimento da manga">
                            @error('manga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="barra_calca" class="block text-sm font-medium text-gray-700">Barra da
                                Calça</label>
                            <input type="text" name="barra_calca" id="barra_calca" inputmode="decimal"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('barra_calca') is-invalid @enderror"
                                value="{{ old('barra_calca') }}" placeholder="Altura da barra da calça">
                            @error('barra_calca')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div>
                        <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                        <input type="text" name="modelo" id="modelo"
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('modelo') is-invalid @enderror"
                            value="{{ old('modelo') }}" placeholder="Modelo do terno">
                        @error('modelo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label for="cor" class="block text-sm font-medium text-gray-700">Cor</label>
                        <input type="text" name="cor" id="cor"
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm @error('cor') is-invalid @enderror"
                            value="{{ old('cor') }}" placeholder="Cor do terno">
                        @error('cor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="observacoesmedidas"
                            class="block text-sm font-medium text-gray-700">Observações</label>
                        <textarea name="observacoesmedidas" id="observacoesmedidas" rows="3"
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Observações adicionais sobre as medidas"></textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 gap-4">
                <a href="{{ route('noivos.list') }}"
                    class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>

                <button type="submit"
                    class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                    <i class="fas fa-save"></i> Salvar
                </button>
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
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value;
            const emailError = document.getElementById('emailError');
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!regex.test(email)) {
                emailError.classList.remove('hidden');
            } else {
                emailError.classList.add('hidden');
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
