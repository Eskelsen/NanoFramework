<?php

# Verificações e acesso

// if (logged()) {
// 	redirect('dashboard');
// 	exit;
// }

// if (!empty($_GET['constructor'])) {
// 	$_SESSION['constructor'] = true;
// }

// if (DEV AND empty($_SESSION['constructor'])) {
// 	exit('This is a construction site');
// }

// $name	= $_POST['name'] ?? '';
// $email  = $_POST['email'] ?? '';
// $phone  = $_POST['phone'] ?? '';
// $psw	= $_POST['psw'] ?? '';

// $fc = fc_ctrl();

// if ($fc AND $name AND $email AND $phone AND $psw) {
	
// 	debug('[access/onboarding] psw: ' . $psw);
	
// 	$test = $_SESSION['constructor'] ?? false;
	
// 	if ($test) {
// 		logfy('[access/onboarding] Onboarding de teste iniciado');
// 	}
	
// 	$c['title'] 	= 'Erro na criação de conta!';
// 	$c['off'] 		= '100';
// 	$c['header'] 	= $c['title'];
// 	$c['blink'] 	= 'p';
	
// 	include PACKS . 'stringfy.php';
	
// 	$name = formatName($name);
	
//     $email = filter_var($email, FILTER_SANITIZE_EMAIL);
	
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
// 		logfy("[access/onboarding] Falha na criação de conta via onboarding: $name <$email> $phone [e-mail inválido]");
// 		$c['message'] = 'Endereço de e-mail inválido.';
// 		include VIEWS . 'empty.php';
// 		exit;
//     }
	
// 	$phone_treated = ltrim(filterNumbers($phone),'0');
	
// 	$len = strlen($phone_treated);

// 	if ($len==10 OR $len==11) {
// 		$phone_treated = '55' . $phone_treated;
// 	}
	
// 	$len = strlen($phone_treated);
	
// 	if ($len<12 OR $len>13) {
// 		logfy("[access/onboarding] Falha na criação de conta via onboarding: $name <$email> $phone [número inválido]");
// 		$c['message'] = 'Número inválido.';
// 		include VIEWS . 'empty.php';
// 		exit;
// 	}

// 	# Important Code
// 	$already = ($test) ? false : selectRow('mf_users','*','WHERE email=?',[$email]);
	
// 	if ($already) {
// 		logfy("[access/onboarding] Falha na criação de conta via onboarding: $name <$email> [e-mail já cadastrado]");
// 		$c['message'] = 'E-mail já cadastrado.';
// 		include VIEWS . 'empty.php';
// 		exit;
// 	}
	
// 	$values = [
// 		'name' 		=> $name,
// 		'psw' 		=> sha1($psw),
// 		'access'	=> 'user',
// 		'phone' 	=> $phone_treated,
// 		'email' 	=> $email,
// 		'hash' 		=> sha1(uniqid()),
// 		'hash_time'	=> 4294967295,
// 		'created'   => date('Y-m-d H:i:s'),
// 		'public'    => 1,
// 		'active'    => 1
// 	];
	
// 	if (!($id = insert('mf_users',$values))) {
// 		logfy("[access/onboarding] Falha na criação de conta via onboarding: $name <$email> $phone [erro desconhecido]");
// 		$c['message'] = 'Entre em contato conosco.';
// 		include VIEWS . 'empty.php';
// 		exit;
// 	}
	
// 	# Referral
// 	if (!empty($_SESSION['referral'])) {
// 		$referral_data = [
// 			'created'   	=> date('Y-m-d H:i:s'),
// 			'referral_code'	=> $_SESSION['referral'],
// 			'acc_id'		=> $id
// 		];
// 		insert('uny_referrals',$referral_data);
// 	}
	
// 	# Sources
// 	if (!empty($_SESSION['source_id'])) {
// 		$source_data = [
// 			'updated' => date('Y-m-d H:i:s'),
// 			'acc_id'  => $id
// 		];
// 		update('uny_sources',$source_data,'id=?',[$_SESSION['source_id']]);
// 	}

// 	$data = selectRow('mf_users','*','WHERE id=?',[$id]);
	
// 	# Send welcome + 3 days trial
// 	include FUNCTIONS . '_systemMsgs.php';
	
// 	$trial_added = _addDays($id, 'trial', 7);
	
// 	if ($trial_added) {
// 		$userdata['name'] = explode(' ', $name)[0];
// 		$message['message'] = "Olá $name, receba as nossas boas-vindas à plataforma Unotify. Esperamos que tenha uma boa experiência.\n\nUm período de testes de 7 dias foi adicionado a sua conta."; # [tmp] 2025-04-06 Sunday: erase it
// 		_mailSendMsg($email,'Boas-vindas :: Unotify','80d41b75',$userdata);
// 		_mailSendMsg('eskelsen@yahoo.com','Unotify :: Onboarding',"Período de testes adicionado a nova conta *#$id*, $name");
// 	} else {
// 		_mailSendMsg('eskelsen@yahoo.com','',"Falha ao adicionar período de testes a nova conta *#$id*, $name");
// 	}
	
// 	# Login
// 	login($data);
	
// 	logfy("[access/onboarding] #$data[id] $data[name]: primeiro login via onboarding");
	
// 	$c['title'] 	= 'Sinta-se em casa!';
// 	$c['off'] 		= '0';
// 	$c['header'] 	= $c['title'];
// 	$c['blink'] 	= 'p class="blink_me"';
// 	$c['message'] 	= 'Redirecionando...';
// 	refresh('dashboard', 3);
// 	include VIEWS . 'empty.php';
// 	exit;
// }

// if (!empty($_SESSION['source'])) {
// 	if (empty($_SESSION['source_id'])) {
// 		$source_data = [
// 			'created' => date('Y-m-d H:i:s'),
// 			'source'  => $_SESSION['source']
// 		];
// 		if ($source_id = insert('uny_sources',$source_data)) {
// 			$_SESSION['source_id'] = $source_id;
// 		}
// 	}
// }

// $c['title'] = 'Criar conta » ' . $c['name'];

// include __DIR__ .  '/sheetviews/onboarding_form.php';
// exit;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <meta name="description" content="Registrar">
    
    <meta name="author" content="Daniel Eskelsen">
    <meta name="theme-color" content="#4482A1">
    <meta property="og:url" content="<?= url('registrar'); ?>">
    <link rel="icon" href="<?= rel('ups/icon.png'); ?>">

    <title>Criar Conta » <?= $app; ?></title>

    <link rel="canonical" href="<?= url('registrar'); ?>">

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
        a {
            color: #6c757d;
            text-decoration: none;
        }

        a:hover {
            color: #54595eff;
            text-decoration: none;
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
            margin-bottom: 0.6rem;
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

        .hr-muted {
            border: none;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>

<div class="card">
    <form method="post" action="registrar">
        <a href=""><img class="mb-4" src="<?= rel('ups/icon.png'); ?>" alt="" width="120"></a>
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
        <p class="mt-3 mb-5 text-muted">Já possui conta? <a href="login">Acessar</a></p>
    </form>
    <hr class="mt-5 hr-muted">
    <p class="mt-4 pt-2 text-muted small">
        <a href="<?= $site; ?>" target="_blank">
            &copy; <?= $mark . ' ' . date('Y'); ?>
        </a>
    </p>
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