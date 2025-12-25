<?php

$rc = rc_get();

if ($rc) {
    // vd($rc); extract + others
	$title	='Aguarde';
    $message = 'Requisição já efetuada.';
    $gray = '100%';
	include APP . 'views/blank.php';
    exit;
}
