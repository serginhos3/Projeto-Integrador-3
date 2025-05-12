<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ateliê do noivo</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Ícones e Estilos externos -->
    <link rel="icon" href="{{ asset('/img/minilogo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Scripts externos -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Compilado com Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Estilos customizados -->
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(to bottom, white 0%, #dcdcdc00 100%);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(to bottom, white 0%, #dcdcdc00 100%);
        }

        #noivosTable_filter {
            display: none !important;
        }

        select {
            background-image: initial !important;
        }

        @media (max-width:800px) {
            #sidebar-container {
                position: fixed;
                top: 0;
                z-index: 2;
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-row">
        @include('layouts.navigation')

        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 transition-all duration-300 ease-in-out">
            <button id="menu-toggle" class="text-white text-3xl absolute top-6 left-6 z-10">
                &#9776;
            </button>
            {{ $slot }}
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const button = document.querySelector("#menu-toggle");

        button.addEventListener("click", () => {
            const navbar = document.querySelector("#sidebar-container");
            navbar.classList.toggle("hidden");
        });
    </script>
</body>

</html>
