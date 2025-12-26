<?php

# 429 Too Many Requests

header('HTTP/1.1 429 Too Many Requests');

$title	='Aguarde...';
$message = 'Muitas requisições.';
$gray = '100%';
$footer = '<a href="' . $site . '" target="_blank">' . $mark . ' &copy;</a>';
include APP . 'views/blank.php';
exit;
