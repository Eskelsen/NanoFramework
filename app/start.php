<?php

# Start

if (!is_file(WEB . 'vendor/autoload.php')) {
    exit('Instalação pendente');
}

include WEB . 'vendor/autoload.php';
include WEB . 'app/config.php';

use App\Core\Web;

Web::match();
