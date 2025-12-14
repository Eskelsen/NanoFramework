<?php

namespace App\Core;

class Web
{
    public static function match()
    {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), BASE);
        $filepath = $path === '' ? 'streams/home.php' : 'streams/' . $path . '.php';
        $filepath = is_file(APP . $filepath) ? $filepath : 'streams/pages/404.php';
        require APP . $filepath;
    }
}