<?php

# Start

use App\Core\Session;

if (!is_file(WEB . 'vendor/autoload.php')) {
    exit('Instalação pendente');
}

include WEB . 'vendor/autoload.php';
include WEB . 'app/config.php';
include APP . 'functions.php';

$session = new Session();

$session::start();

App\Core\Session::start();

App\Core\Web::match();
