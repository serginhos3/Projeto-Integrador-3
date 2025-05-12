<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800 leading-tight">
            {{ __('Minha Conta') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- Informações do Perfil --}}
            <div class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-4xl mx-auto">
                <h3 class="text-xl font-semibold text-gray-900 mb-1">Informações do Perfil</h3>
                <p class="text-sm text-gray-600 mb-6">Atualize seu nome e e-mail cadastrado.</p>

                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Atualizar Senha --}}
            <div class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-4xl mx-auto">
                <h3 class="text-xl font-semibold text-gray-900 mb-1">Atualizar Senha</h3>
                <p class="text-sm text-gray-600 mb-6">Certifique-se de usar uma senha longa e aleatória para permanecer seguro.</p>

                @include('profile.partials.update-password-form')
            </div>

            {{-- Excluir Conta --}}
            <div class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-4xl mx-auto">
                <h3 class="text-xl font-semibold text-red-700 mb-1">Excluir Conta</h3>
                <p class="text-sm text-gray-600 mb-6">Essa ação é irreversível. Todos os dados da conta serão permanentemente excluídos.</p>

                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
