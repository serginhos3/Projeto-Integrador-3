<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/img/minilogo.png') }}" type="image/png">
    <title>Ateliê do Noivo</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Aplica a imagem de fundo à página inteira */
        html, body {
            height: 100%; /* Garantir que a altura cubra toda a página */
            margin: 0; /* Remove margens padrão */
        }

        body {
            background-image: url('/img/gravata2.png'); /* Caminho correto para a imagem de fundo */
            background-size: cover; /* Faz a imagem cobrir todo o fundo */
            background-position: center; /* Centraliza a imagem */
            background-repeat: no-repeat; /* Evita que a imagem se repita */
            font-family: 'Poppins', sans-serif;
            color: #333; /* Cor mais suave para o texto */
        }

        /* Container geral, alinhamento centralizado e com espaçamento */
        .container {
            display: flex;
            justify-content: center; /* Centraliza os itens horizontalmente */
            align-items: center; /* Alinha os itens verticalmente */
            height: 100%; /* Garante que ocupe toda a altura da tela */
            padding: 0 20px; /* Padding nas laterais */
        }

        /* Agrupa logo e card com espaçamento e centraliza */
        .content-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center; /* Centraliza o logo e o card */
            gap: 30px; /* Aumenta o espaçamento entre o logo e o card */
            background-color: rgba(255, 255, 255, 0.85); /* Fundo mais opaco para um contraste suave */
            padding: 40px;
            border-radius: 20px; /* Bordas mais suaves para o card */
            max-width: 600px; /* Limita a largura para manter o layout elegante */
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Adiciona sombra suave */
        }

        /* Card com os campos de formulário */
        .content-container {
            background-color: transparent; /* Fundo branco para o card */
            padding: 20px;
            border-radius: 12px; /* Bordas arredondadas para suavizar */
            width: 100%; /* O card ocupa toda a largura disponível */
        }

        /* Logo */
        .content-wrapper img {
            width: 180px; /* Aumenta o tamanho da logo para maior destaque */
            height: auto;
            transition: transform 0.3s ease; /* Efeito sutil ao passar o mouse */
        }

        .content-wrapper img:hover {
            transform: scale(1.05); /* Sutil aumento de tamanho ao passar o mouse */
        }

        /* Estilo dos campos de formulário */
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            background-color: #f8f8f8;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #6c63ff; /* Cor de foco elegante */
            background-color: #fff; /* Fundo branco no foco */
        }

        button {
            background-color: #6c63ff; /* Cor principal */
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #5752e1; /* Cor de hover mais escura */
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="container">
        <div class="content-wrapper">
            <div>
                <a href="/">
                    <img src="/img/lotoateliepng.png" alt="Ateliê do Noivo"> <!-- Ajuste o tamanho conforme necessário -->
                </a>
            </div>

            <div class="content-container">
                {{ $slot }} <!-- Campos do formulário aqui -->
            </div>
        </div>
    </div>
</body>

</html>
