<?php

use App\Core\Session;

if (empty($_SESSION['role'])) {
	redirect('/');
}

$data = Session::data();

error_log("[access/quit] #$data[id] $data[name]: checkout");

$data = Session::exit();


$title	= 'Acesso encerrado!';
$message = 'Você será redirecionado.';
$footer = '<a href="' . $site . '">' . $mark . ' &copy;</a>';

refresh('/', 4);

include APP . 'views/default.php';
exit;
