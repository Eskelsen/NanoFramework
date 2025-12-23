
<?php

use App\Core\Session;

if (Session::on()) {
    redirect('test');
}

vd($_SESSION);
vd($_POST);

// $msg = '<div class="alert alert-danger" role="alert">E-mail inexistente na base de dados. 3 tentativa(s) restante(s)</div>';;
// $msg = '<div class="alert alert-danger" role="alert">E-mail inexistente na base de dados. 3 tentativa(s) restante(s)</div>';;

$email = post('email');

if (!empty($_SESSION['requested'])) {
  if ($_SESSION['requested']<=time()) {
    unset($_SESSION['requested']);
  }
}

if (!empty($_SESSION['failure'])) {
	if ($_SESSION['failure']<=time()) {
		unset($_SESSION['failure']);
	}
}

$attempts = 1; # tmp

$fc = true; # tmp

$title   = 'Acesso a área administrativa';
$message = '';
$footer  = '<a href="' . $site . '">' . $mark . ' &copy;</a>';

if ($fc AND $email AND empty($_SESSION['requested'])) {
	// $data = selectRow('mf_users', '*', 'WHERE email=?', [$email]);
    $data = ['name' => 'Daniel Eskelsen']; # tmp
	if (!$data) {
		$remaining = 4 - $attempts;
		$message = '<div class="alert alert-danger" role="alert">E-mail inexistente na base de dados. ' . $remaining . ' tentativa(s) restante(s)</div>';
		// attempt('recovery');
		// attemptsStatus('recovery');
	} else {
		$hash  = sha1(uniqid());
		$chash = sha1($hash);
		$link  = url("acesso/$hash");
		$sent  = true;
		if ($sent) {
			$title = 'Link de acesso :: ' . $app;
			$html  = 'Olá, ' . explode(" ", $data['name'])[0] . '<br><br>Seu link de acesso é <a href="' . $link . '">' . $link . '</a>';
			$sent = mail($email,$title,$html,"From: NanoFramework <nano@mfwks.com>\r\n");
		}
		$status = ($sent) ? 'requested' : 'failure';
		$_SESSION[$status] = time() + 60;
	}
}

if (!empty($_SESSION['failure'])) {
	$title	='Falha na recuperação.';
    $message = 'Falha ao enviar e-mail de recuperação. Entre em contato com o administrador do sistema.';
    $gray = '100%';
	include APP . 'views/default.php';
	exit;
}

if (!empty($_SESSION['requested'])) {
	$title	='Solicitação recebida.';
	$message = 'Em breve você receberá um link de recuperação em seu e-mail.';
    include APP . 'views/default.php';
	exit;
}

$email = $_GET['email'] ?? $email;

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Recuperar acesso">
    
    <meta name="author" content="Daniel Eskelsen">
    <meta name="theme-color" content="#4482A1">
    <meta property="og:url" content="<?= url('recuperar-acesso'); ?>">
    <link rel="icon" href="<?= rel('ups/icon.png'); ?>">

    <title>Recuperar acesso » <?= $app; ?></title>

    <link rel="canonical" href="<?= url('recuperar-acesso'); ?>">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
    
    <style>
	
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      
    textarea, table {
        width: 100%;
        height: 100%; 
        box-sizing: border-box;
    }
    
    a {
        color: #6c757d;
        text-decoration: none;
    }

    a:hover {
        color: #54595eff;
        text-decoration: none;
    }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      
    .disappear {
        animation: hide 6s linear 2s 1 forwards;
    }

    @keyframes hide {
        to {
            opacity: 0;
        }
    }
	
	form i { z-index:200; margin-left: 120px; margin-top: 8px; margin-bottom: 2px; font-weight: 700; font-size: 18px; position: absolute; cursor: pointer; } 
    
	</style>
  </head>

  <body class="text-center">
  
      <form class="form-signin" method="post">
      <img class="mb-4" src="<?= rel('ups/icon.png'); ?>" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Recuperar acesso</h1>
	  <p>Acesso a área administrativa</p>
	  
	  <input type="hidden" id="fc" name="fc" value="4d0a99a1">

      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" name="email" class="form-control mb-2" placeholder="E-mail" value="<?= $email; ?>" required>
	  
      <?= empty($msg) ? '' : $msg; ?>
	  	  
      <button class="btn btn-lg btn-primary btn-block" type="submit">Recuperar</button>
      <p class="mt-3 mb-2 text-muted"><a href="registrar">Criar conta</a> | <a href="login">Acessar conta</a></p>
      <p class="mt-5 mb-3 text-muted"><a href="<?= $site; ?>" target="_blank">&copy; <?= $mark . ' ' . date('Y'); ?></a></p>
    </form>	
  </body>
</html>