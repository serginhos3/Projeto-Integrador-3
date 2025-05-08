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
            <h1 class="text-2xl font-bold">Editar Padrinho e Pais</h1>
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

        <form method="POST" action="{{ route('padrinhos.atualizar', $padrinho->id) }}">
            @csrf
            @method('PUT')

            <div id="tab-content">
                {{-- Informações Pessoais --}}
                <div id="tab-pessoal" class="tab-pane">
                    <h2 class="text-xl font-bold mb-1">Informações Pessoais</h2>
                    <p class="text-sm text-gray-500 mb-6">Preencha os dados pessoais do padrinho.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome"
                                value="{{ old('nome', $padrinho->nome) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone"
                                value="{{ old('telefone', $padrinho->telefone) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $padrinho->email) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            <p id="emailError" class="mt-1 text-sm text-red-600 hidden">E-mail inválido</p>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="ativo" {{ $padrinho->status == 'ativo' ? 'selected' : '' }}>Ativo
                                </option>
                                <option value="inativo" {{ $padrinho->status == 'inativo' ? 'selected' : '' }}>Inativo
                                </option>
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                            <textarea name="observacoes" id="observacoes" rows="3" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('observacoes', $padrinho->observacoes) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Informações do Evento --}}
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
                                        {{ $padrinho->noivo_id == $noivo->id ? 'selected' : '' }}>
                                        {{ $noivo->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="datadalocacao" class="block mb-1 font-medium">Data de Locação</label>
                            <input type="date" name="datadalocacao" id="datadalocacao"
                                value="{{ old('datadalocacao', \Carbon\Carbon::parse($padrinho->datadalocacao)->format('Y-m-d')) }}"
                                class="w-full border rounded-lg px-3 py-2">
                        </div>

                        <div>
                            <label for="datadaretirada" class="block mb-1 font-medium">Data de Retirada</label>
                            <input type="date" name="datadaretirada" id="datadaretirada"
                                value="{{ old('datadaretirada', \Carbon\Carbon::parse($padrinho->datadaretirada)->format('Y-m-d')) }}"
                                class="w-full border rounded-lg px-3 py-2">
                        </div>

                        <div class="md:col-span-2">
                            <label for="observacoesevento" class="block text-sm font-medium text-gray-700">Observações
                                do Evento</label>
                            <textarea name="observacoesevento" id="observacoesevento" rows="3"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('observacoesevento', $padrinho->observacoesevento ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Medidas do Terno --}}
                <div id="tab-medidas" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Medidas do Terno</h2>
                    <p class="text-sm text-gray-500 mb-6">Informe as medidas para o traje do padrinho.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (['paleto', 'calca', 'camisa', 'colete', 'manga', 'barra_calca', 'modelo_terno', 'cor_terno'] as $campo)
                            <div>
                                <label for="{{ $campo }}"
                                    class="block text-sm font-medium text-gray-700">{{ ucfirst(str_replace('_', ' ', $campo)) }}</label>
                                <input type="text" name="{{ $campo }}" id="{{ $campo }}"
                                    value="{{ old($campo, $padrinho->$campo) }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 md:col-span-2">
                        <label for="observacoes_medidas"
                            class="block text-sm font-medium text-gray-700">Observações</label>
                        <textarea name="observacoes_medidas" id="observacoes_medidas" rows="3"
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('observacoes_medidas', $padrinho->observacoes_medidas) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 gap-4">
                <a href="{{ route('padrinhos.list') }}"
                    class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>
                <button type="submit"
                    class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                    <i class="fas fa-save"></i> Salvar Alterações
                </button>
            </div>
        </form>
    </div>

    {{-- Scripts iguais ao cadastro --}}
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

        document.getElementById('email').addEventListener('blur', function() {
            const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value.trim());
            document.getElementById('emailError').classList.toggle('hidden', emailValido || this.value.trim() ===
                '');
            this.classList.toggle('border-red-500', !emailValido && this.value.trim() !== '');
        });

        const campos = ['paleto', 'calca', 'camisa', 'colete', 'manga', 'barra_calca' ];
        campos.forEach(id => {
            const input = document.getElementById(id);
            input.addEventListener('keypress', function(e) {
                const char = String.fromCharCode(e.which);
                if (!/[0-9.,]/.test(char)) e.preventDefault();
            });
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9.,]/g, '');
            });
        });
    </script>
</x-app-layout>
