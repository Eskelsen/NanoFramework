<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Um outro exemplo</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 
                         "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #2f2f2f;
        }

        .container {
            text-align: center;
            max-width: 600px;
            padding: 24px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 12px;
        }

        p {
            line-height: 1;
            color: #3a3a3a;
        }

        a {
            color: #0a0;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Um outro exemplo</h1>
        <p>Esta rota web é gerada pela própria estrutura de pastas.</p>
        <p>&nbsp;</p>
        <p><a href="<?= url('exemplos'); ?>">Voltar</a></p>
    </div>

</body>
</html>