<div class="flex">

    <!-- Botão Hamburguer (visível somente no mobile) -->
    <button id="toggleSidebar"
        class="md:hidden fixed top-4 left-4 z-50 bg-gray-800 text-white p-2 rounded-md shadow-md focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed top-0 left-0 bottom-0 w-64 bg-gray-800 text-white border-r border-gray-700 p-6 shadow-xl transform transition-transform duration-300 ease-in-out md:translate-x-0 -translate-x-full md:flex md:flex-col z-40"
        style="height: 100vh;">

        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex justify-center mb-6 mt-4">
            <img src="{{ asset('/img/lotoateliepng.png') }}" alt="Logo" class="block h-20 w-auto" />
        </a>

        <hr class="my-4 border-gray-600">

        <!-- Menu de Navegação -->
        <ul class="space-y-4 flex-grow">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 rounded-lg text-gray-200 hover:text-white hover:bg-gray-700 transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : '' }}">
                    <svg class="bi pe-none me-2" width="20" height="20"><use xlink:href="#home" /></svg>
                    <span>Início</span>
                </a>
            </li>
            <li>
                <a href="{{ route('noivos.list') }}"
                    class="flex items-center p-2 rounded-lg text-gray-200 hover:text-white hover:bg-gray-700 transition duration-200 {{ request()->routeIs('noivos.list') ? 'bg-gray-700 text-white' : '' }}">
                    <svg class="bi pe-none me-2" width="20" height="20"><use xlink:href="#people-circle" /></svg>
                    <span>Noivos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('padrinhos.list') }}"
                    class="flex items-center p-2 rounded-lg text-gray-200 hover:text-white hover:bg-gray-700 transition duration-200 {{ request()->routeIs('padrinhos.list') ? 'bg-gray-700 text-white' : '' }}">
                    <svg class="bi pe-none me-2" width="20" height="20"><use xlink:href="#people-circle" /></svg>
                    <span>Pais e Padrinhos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pedidos.list') }}"
                    class="flex items-center p-2 rounded-lg text-gray-200 hover:text-white hover:bg-gray-700 transition duration-200 {{ request()->routeIs('pedidos.list') ? 'bg-gray-700 text-white' : '' }}">
                    <svg class="bi pe-none me-2" width="20" height="20"><use xlink:href="#clipboard" /></svg>
                    <span>Pedidos</span>
                </a>
            </li>
        </ul>

        <hr class="my-4 border-gray-600">

        <!-- Conta e Logout -->
        <div class="mt-auto">
            <a href="{{ route('profile.edit') }}"
                class="flex items-center p-2 rounded-lg text-gray-200 hover:text-white hover:bg-gray-700 transition duration-200 w-full mb-4">
                <svg class="bi pe-none me-2" width="20" height="20"><use xlink:href="#person-circle" /></svg>
                <span>Minha conta</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center p-2 rounded-lg text-gray-200 hover:text-white hover:bg-gray-700 transition duration-200 w-full">
                    <svg class="bi pe-none me-2" width="20" height="20"><use xlink:href="#box-arrow-right" /></svg>
                    <span>Sair</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Script para Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    });
</script>
