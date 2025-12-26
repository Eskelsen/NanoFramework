<?php

use App\Core\Session;

if (Session::on()) {
    redirect('test');
}

$hash = $_GET['hash'] ?? null;

$footer = '<a href="' . $site . '" target="_blank">' . $mark . ' &copy;</a>';
$gray 	= '100%';

if (!$hash) {
	$title 	 = 'Hash ausente';
	$message = 'Para o login é necessário um hash de acesso.';
    include APP . 'views/blank.php';
    exit;
}

$chash = sha1($hash);

$data = ['hash' => '356a192b7913b04c54574d18c28d46e6395428ab', 'hash_time' => time() + 1]; // get hash + hash_time # tmp
// $data = false;

if (empty($data['hash_time'])) {
	$title 	 = 'Hash não reconhecido';
	$message = 'Hash de acesso não encontrado no sistema.';
	include APP . 'views/blank.php';
	exit;
}

if (time()>=$data['hash_time']) {
	$title 	 = 'Hash expirado';
	$message = 'Obtenha um novo hash de acesso.';
    include APP . 'views/blank.php';
    exit;
}

if ($chash!==$data['hash']) {
	$title   = 'Hash não reconhecido.';
	$message = 'Para acessar é necessário um hash válido.';
    include APP . 'views/blank.php';
    exit;
}

$user = ['id' => 1, 'name' => 'Daniel Eskelsen', 'email' => 'eskelsen@yahoo.com', 'role' => 'master', 'public' => 1, 'active' => 1]; // data from user # tmp

$user['acc'] = $user['id'];

Session::regenerate();
Session::load($user);

error_log("[access/access] #$user[id] $user[name]: login via hash");

$title   = 'Sinta-se em casa!';
$gray    = false;
$message = 'Redirecionando...';
$blink 	 = 'blink_me';

// update('mf_users',['hash_time' => time()],'id=?',[$data['id']]); // marcar hash como usado # tmp

refresh('/', 3);
include APP . 'views/blank.php';
exit;
