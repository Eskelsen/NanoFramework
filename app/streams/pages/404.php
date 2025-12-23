<?php

# 404 Not Found

header('HTTP/1.1 404 Not Found');

$title	= 'Não encontrado';
$message = 'Recurso não encontrado no sistema';
$footer = '<a href="' . $site . '">' . $mark . ' &copy;</a>';
$gray 	= '100%';

include APP . 'views/default.php';
exit;
