<?php

# Start

if (!is_file(WEB . 'vendor/autoload.php')) {
    exit('Instalação pendente');
}

include WEB . 'vendor/autoload.php';
include WEB . 'app/config.php';
include APP . 'functions.php';

App\Core\Web::match();
