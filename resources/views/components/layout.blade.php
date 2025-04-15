<!-- resources/views/components/layout.blade.php -->
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pais e Padrinhos</title>
        <!-- Coloque aqui os links de CSS ou outras coisas no <head> -->
    </head>
    <body>
        <div class="container">
            {{ $slot }} <!-- O conteúdo será injetado aqui -->
        </div>
    </body>
</html>
