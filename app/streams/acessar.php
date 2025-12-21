<?php

# Access by Hash

$hash = $_GET['hash'] ?? null;

$footer = '<a href="' . $site . '">' . $mark . ' &copy;</a>';
$gray 	= '100%';

if (!$hash) {
	$title 	 = 'Hash ausente';
	$message = 'Para o login é necessário um hash de acesso.';
    include APP . 'views/default.php';
    exit;
}

// $chash = sha1($hash);

// $data = false;

// if (empty($data['hash_time'])) {
// 	$title 	 = 'Hash não reconhecido';
// 	$message = 'Entre em contato com o administrador do sistema.';
// 	include APP . 'views/default.php';
// 	exit;
// }

// if (time()>=$data['hash_time']) {
// 	$title 	 = 'Hash expirado';
// 	$message = 'Obtenha um novo hash de acesso.';
//     include APP . 'views/default.php';
//     exit;
// }

// if ($chash!==$data['hash']) {
// 	$title   = 'Hash não reconhecido.';
// 	$message = 'Para acessar é necessário um hash válido.';
//     include APP . 'views/default.php';
//     exit;
// }

// login($data);

// logfy("[access/access] #$data[id] $data[name]: login via hash");

$title   = 'Sinta-se em casa!';
$gray    = false;
$message = 'Redirecionando...';
$blink 	 = 'blink_me';

// selectRow('mf_users', '*', 'WHERE hash=?', [$chash]);

// update('mf_users',['hash_time' => time()],'id=?',[$data['id']]);

refresh('dashboard', 3);
include APP . 'views/default.php';
exit;
