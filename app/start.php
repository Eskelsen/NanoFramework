<?php

include WEB . 'vendor/autoload.php';
include WEB . 'app/config.php';
include APP . 'functions/helpers.php';

App\Core\Access::init();

App\Core\Session::start();

$stream = App\Core\Web::match();

include $stream;
