<?php

# Quit

if (empty($_SESSION['role'])) {
	redirect('/');
	return;
}

// $data = user();

// logfy("[access/quit] #$data[id] $data[name]: checkout");

session_destroy();

$title	= 'Acesso encerrado!';
$footer = '<a href="' . $site . '">' . $mark . ' &copy;</a>';

refresh('/', 4);

include APP . 'views/default.php';
exit;
