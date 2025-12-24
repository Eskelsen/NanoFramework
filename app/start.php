<?php

# Start

if (!is_file(WEB . 'vendor/autoload.php')) {
    exit('Instalação pendente' . PHP_EOL);
}

include WEB . 'vendor/autoload.php';
include WEB . 'app/config.php';
include APP . 'functions/helpers.php';

App\Core\Session::start();

$stream = App\Core\Web::match();

include $stream;
