<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido em Aberto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #2c3e50;
        }
        p, ul {
            line-height: 1.6;
        }
        .logo {
            max-width: 150px; /* Ajuste conforme necessário */
            margin-bottom: 20px;
        }
        .valor {
            font-size: 1.2em;
            font-weight: bold;
            color: #e74c3c; /* Cor vermelha para destacar o valor */
        }
    </style>
</head>
<body>
    <h1>Pedido em Aberto</h1>
    <p>Prezado(a),</p>
    <p>Esperamos que esta mensagem o(a) encontre bem. Gostaríamos de lembrá-lo(a) que o pedido referente a <strong>Avaliação do dia:</strong> {{ $pedido->created_at->format('d/m/Y') }} está em aberto há mais de <strong>30 dias</strong>. Abaixo, seguem as informações detalhadas sobre o pedido:</p>
    <ul>
        <li><strong>Status:</strong> {{ $pedido->status }}</li>
        <li><strong>Última Atualização:</strong> {{ $pedido->updated_at->format('d/m/Y') }}</li>
        <li><strong>Valor em Aberto:</strong> <span class="valor">R$ {{ number_format($pedido->valor, 2, ',', '.') }}</span></li>
    </ul>
    <p>Estamos abertos a negociações e ajustes que possam melhor atender às suas necessidades. Se houver alguma dúvida, ou se desejar discutir alterações, por favor, não hesite em entrar em contato conosco. Estamos à disposição para encontrar a melhor solução para você.</p>
    <p>Agradecemos pela sua atenção e aguardamos seu retorno.</p>
    <p>Atenciosamente,</p>
    <p>Ateliê do Noivo</p>
</body>
</html>
