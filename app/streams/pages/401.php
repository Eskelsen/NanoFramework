<?php

# 401 Unauthorized

header('HTTP/1.1 401 Unauthorized');

$title	= 'Não autorizado';
$footer = '<a href="' . $site . '">' . $mark . ' &copy;</a>';
$gray 	= '100%';

include APP . 'views/default.php';
exit;
