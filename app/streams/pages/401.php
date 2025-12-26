<?php

# 401 Unauthorized

header('HTTP/1.1 401 Unauthorized');

$title	= 'Não autorizado';
$message = 'Recurso de acesso restrito';
$footer = '<a href="' . $site . '" target="_blank">' . $mark . ' &copy;</a>';
$gray 	= '100%';

include APP . 'views/blank.php';
exit;
