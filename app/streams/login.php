
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema gestão de arquivos, controle de acessos e distribuição de notificações e mensageria">
    <meta name="author" content="Daniel Eskelsen">
    <meta name="generator" content="Microframework version 0.7.0">
	<meta name="theme-color" content="#4482A1">
	<meta property="og:url" content="https://unotify.mfwks.com/">
    <link rel="icon" href="https://unotify.mfwks.com/assets/icon.png">

    <title>Login » Unotify</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
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
        color: #6c757d
    }

    a:hover {
        text-decoration: none;
        color: #54595eff
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
      <a href=""><img class="mb-4" src="<?=  url('ups/icon.png'); ?>" alt="" width="120"></a>
      <!-- Chemistry icons created by Freepik - Flaticon in https://www.flaticon.com/free-icons/chemistry -->
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
	  <p>Acesso a área administrativa</p>
	  
	  <input type="hidden" id="fc" name="fc" value="3e783c8b">

      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" name="email" class="form-control mb-2" placeholder="E-mail" value="" required autofocus>
	  <label for="inputPassword" class="sr-only">Senha</label>
	  <i class="bi bi-eye-slash" id="togglePassword"></i>
      <input type="password" id="inputPassword" name="password" class="form-control mb-2" placeholder="Senha" required>
	  
	  	  
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <p class="mt-3 mb-2 text-muted"><a href="registrar">Criar conta</a> | <a href="recuperar">Esqueci a senha</a></p>
      <p class="mt-5 mb-3 text-muted"><a href="<?=  $site; ?>" target="_blank">&copy; <?=  $mark . ' ' . date('Y'); ?></a></p>
    </form>
	<script type="text/javascript">
	const togglePassword = document.querySelector("#togglePassword");
	const password = document.querySelector("#inputPassword");
	togglePassword.addEventListener("click", function () {
		const type = password.getAttribute("type") === "password" ? "text" : "password";
		password.setAttribute("type", type);
		this.classList.toggle("bi-eye");
	});
	</script>	
  </body>
</html>