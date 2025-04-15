<x-app-layout>
    <div class="max-w-3xl w-full mx-auto p-4 bg-white rounded-lg shadow-md mt-10">
        <div class="flex items-center mb-6">
            <a href="{{ route('noivos.list') }}" class="mr-4 text-gray-500 hover:text-black transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>            
            <h1 class="text-2xl font-bold">Editar Noivo</h1>
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

        <form method="POST" action="{{ route('noivos.atualizar', $noivo->id) }}">
            @csrf
            @method('PUT')


            <div id="tab-content">

                <div id="tab-pessoal" class="tab-pane">
                    <h2 class="text-xl font-bold mb-1">Informações Pessoais</h2>
                    <p class="text-sm text-gray-500 mb-6">Atualize os dados pessoais do noivo.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome', $noivo->nome) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Nome completo do noivo">
                        </div>

                        <div>
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone"
                                value="{{ old('telefone', $noivo->telefone) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="(00) 00000-0000">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $noivo->email) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="email@exemplo.com">
                        </div>

                        <div>
                            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <input type="text" name="endereco" id="endereco"
                                value="{{ old('endereco', $noivo->endereco) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Endereço completo">
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                            <textarea name="observacoes" id="observacoes" rows="3" class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Observações adicionais sobre o noivo">{{ old('observacoes', $noivo->observacoes) }}</textarea>
                        </div>
                    </div>
                </div>


                <div id="tab-evento" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Informações do Evento</h2>
                    <p class="text-sm text-gray-500 mb-6">Detalhes sobre o evento e datas importantes.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="data_evento" class="block text-sm font-medium text-gray-700">Data do
                                Evento</label>
                            <input type="date" name="data_evento" id="data_evento"
                                value="{{ old('data_evento', $noivo->data_evento) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label for="local_evento" class="block text-sm font-medium text-gray-700">Local do
                                Evento</label>
                            <input type="text" name="local_evento" id="local_evento"
                                value="{{ old('local_evento', $noivo->local_evento) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Local onde será realizado o evento">
                        </div>

                        <div>
                            <label for="data_locacao" class="block text-sm font-medium text-gray-700">Data de
                                Locação</label>
                            <input type="date" name="data_locacao" id="data_locacao"
                                value="{{ old('data_locacao', $noivo->data_locacao) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label for="data_prova" class="block text-sm font-medium text-gray-700">Data da
                                Prova</label>
                            <input type="date" name="data_prova" id="data_prova"
                                value="{{ old('data_prova', $noivo->data_prova) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label for="data_segunda_prova" class="block text-sm font-medium text-gray-700">Data da
                                Segunda Prova</label>
                            <input type="date" name="data_segunda_prova" id="data_segunda_prova"
                                value="{{ old('data_segunda_prova', $noivo->data_segunda_prova) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label for="data_retirada" class="block text-sm font-medium text-gray-700">Data de
                                Retirada</label>
                            <input type="date" name="data_retirada" id="data_retirada"
                                value="{{ old('data_retirada', $noivo->data_retirada) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div class="md:col-span-2">
                            <label for="observacoes_evento"
                                class="block text-sm font-medium text-gray-700">Observações do Evento</label>
                            <textarea name="observacoes_evento" id="observacoes_evento" rows="3"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Observações adicionais sobre o evento">{{ old('observacoes_evento', $noivo->observacoes_evento) }}</textarea>
                        </div>
                    </div>
                </div>


                <div id="tab-medidas" class="tab-pane hidden">
                    <h2 class="text-xl font-bold mb-1">Medidas do Terno</h2>
                    <p class="text-sm text-gray-500 mb-6">Preencha ou atualize as medidas do terno do noivo.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="ombro" class="block text-sm font-medium text-gray-700">Ombro (cm)</label>
                            <input type="text" name="ombro" id="ombro"
                                value="{{ old('ombro', $noivo->ombro) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Ex: 45">
                        </div>

                        <div>
                            <label for="torax" class="block text-sm font-medium text-gray-700">Tórax (cm)</label>
                            <input type="text" name="torax" id="torax"
                                value="{{ old('torax', $noivo->torax) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Ex: 100">
                        </div>

                        <div>
                            <label for="cintura" class="block text-sm font-medium text-gray-700">Cintura (cm)</label>
                            <input type="text" name="cintura" id="cintura"
                                value="{{ old('cintura', $noivo->cintura) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Ex: 85">
                        </div>

                        <div>
                            <label for="quadril" class="block text-sm font-medium text-gray-700">Quadril (cm)</label>
                            <input type="text" name="quadril" id="quadril"
                                value="{{ old('quadril', $noivo->quadril) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Ex: 95">
                        </div>

                        <div>
                            <label for="manga" class="block text-sm font-medium text-gray-700">Manga (cm)</label>
                            <input type="text" name="manga" id="manga"
                                value="{{ old('manga', $noivo->manga) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Ex: 60">
                        </div>

                        <div>
                            <label for="comprimento_calca" class="block text-sm font-medium text-gray-700">Comprimento
                                da Calça (cm)</label>
                            <input type="text" name="comprimento_calca" id="comprimento_calca"
                                value="{{ old('comprimento_calca', $noivo->comprimento_calca) }}"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Ex: 105">
                        </div>

                        <div class="md:col-span-2">
                            <label for="observacoes_medidas"
                                class="block text-sm font-medium text-gray-700">Observações das Medidas</label>
                            <textarea name="observacoes_medidas" id="observacoes_medidas" rows="3"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="Observações adicionais sobre as medidas">{{ old('observacoes_medidas', $noivo->observacoes_medidas) }}</textarea>
                        </div>
                    </div>
                </div>



                <div class="flex justify-end mt-8 gap-4">
                    <a href="{{ route('noivos.list') }}"
                        class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Cancelar</a>
                    <button type="submit"
                        class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-gray-900">
                        <i class="fas fa-save"></i> Atualizar Noivo
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
</x-app-layout>
