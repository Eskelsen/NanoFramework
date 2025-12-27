<?php

use App\Core\Session;
use App\Core\Data;

if (Session::on()) {
    redirect('test');
}

if (!empty($_GET['constructor'])) {
	$_SESSION['constructor'] = true;
}

if (DEV AND empty($_SESSION['constructor'])) {
	exit('This is a construction site');
}

$name       = post('name');
$email      = post('email');
$psw        = post('psw');
$confpsw    = post('confpsw');

if ($rc = rc_get()) { # el
    exit('Solicitação repetida.').
    extract($rc); // tmp
	include APP . 'streams/blank.php';
	exit;
}

if ($tc = tc_get()) { # el
    $message = '<div class="alert alert-warning" role="alert">Aguarde um momento para a próxima solicitação.</div>';
    return;
}

if (!($name && $email && $psw && $confpsw)) {
    $message = '<div class="alert alert-warning" role="alert">Será necessário confirmar seu e-mail.</div>';
    return;
}

if (!verifySize($psw,8) OR !verifySize($confpsw,8)) {
    $message = '<div class="alert alert-warning" role="alert">A senha precisa ter mais de 8 caracteres.</div>';
    return;
}

if (!($psw_ok = ($psw===$confpsw))) {
    $message = '<div class="alert alert-warning" role="alert">As senhas precisam ser iguais.</div>';
    return;
}

tc_set(30); # el
rc_set(); # el

$test = $_SESSION['constructor'] ?? false;

if ($test) {
    error_log('[access/onboarding] Onboarding de teste iniciado');
}

$name = formatName($name);

$email = filter_var($email, FILTER_SANITIZE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    error_log("[access/onboarding] Falha na criação de conta via onboarding: $name <$email> [e-mail inválido]");
    $message = '<div class="alert alert-warning" role="alert">Endereço de e-mail inválido.</div>';
    return;
}

$already = ($test) ? false : Data::one('SELECT * FROM nano_users WHERE email=?',[$email]);

if ($already) {
    error_log("[access/onboarding] Falha na criação de conta via onboarding: $name <$email> [e-mail já cadastrado]");
    $message = '<div class="alert alert-warning" role="alert">E-mail já cadastrado. Faça <a href="login?email=' . $email . '">login</a>.</div>';
    return;
}

$values = [
    'name' 		 => $name,
    'email' 	 => $email,
    'password'   => sha1($psw),
    'created_at' => date('Y-m-d H:i:s')
];

$id = Data::insert('nano_users',$values);

if (!$id) {
    error_log("[access/onboarding] Falha na criação de conta via onboarding: $name <$email> [erro desconhecido]");
    $message = '<div class="alert alert-warning" role="alert">Erro ao criar conta. Entre em contato conosco.</div>';
    return;
}

include_once APP . 'functions/mail.php';

$firstname = explode(' ', $name)[0];
$message = "Olá $firstname, receba as nossas boas-vindas à plataforma Unotify. Esperamos que tenha uma boa experiência.\n\nUm período de testes de 7 dias foi adicionado a sua conta."; # [tmp] 2025-04-06 Sunday: erase it
sendMail($email,$firstname,'Boas-vindas :: ' . $app,$message);
sendMail('eskelsen@yahoo.com','Eskelsen','Unotify :: Onboarding',"Período de testes adicionado a nova conta *#$id*, $name");

$title	= 'Solicitação efetuada!';
$message = 'Confirme seu e-mail para continuar o processo.';
include APP . 'views/blank.php';
exit;
