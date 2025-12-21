<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Criar Conta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f9f9f9;
        }
        .card {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 380px;
            text-align: center;
        }
        .card h2 {
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 500;
        }
        .form-group {
            margin-bottom: 1.2rem;
            position: relative;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            padding-right: 2.8rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .form-group .toggle-pass {
            position: absolute;
            top: 50%;
            right: 0.8rem;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            font-size: 1.2rem;
        }
        .btn-submit {
            width: 100%;
            padding: 0.8rem;
            background: #007bff;
            border: none;
            color: white;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
        }
        .btn-submit:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="card">
    <form method="post" action="registrando">
        <a href=""><img class="mb-4" src="<?=  url('ups/icon.png'); ?>" alt="" width="120"></a>
        <!-- Chemistry icons created by Freepik - Flaticon in https://www.flaticon.com/free-icons/chemistry -->

        <h2>Crie sua conta</h2>

        <div class="form-group">
            <input type="text" id="nome" placeholder="Nome completo" required>
        </div>

        <div class="form-group">
            <input type="email" id="email" placeholder="E-mail principal" required>
        </div>

        <div class="form-group">
            <input type="password" id="senha" placeholder="Senha" required>
            <i class="bi bi-eye-slash toggle-pass" data-target="senha"></i>
        </div>

        <div class="form-group">
            <input type="password" id="confirmaSenha" placeholder="Confirme sua senha" required>
            <i class="bi bi-eye-slash toggle-pass" data-target="confirmaSenha"></i>
        </div>

        <button type="submit" class="btn-submit">Cadastrar</button>
    </form>
</div>

<script>
document.querySelectorAll('.toggle-pass').forEach(icon => {
    icon.addEventListener('click', () => {
        const input = document.getElementById(icon.dataset.target);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            input.type = "password";
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    });
});
</script>

</body>
</html>