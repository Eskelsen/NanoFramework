<?php

namespace App\Core;

class Web
{
    public static function match()
    {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), BASE);
        $filepath = $path === '' ? 'streams/home.php' : 'streams/' . $path . '.php';
        if (!is_file(APP . $filepath)) {
            require APP . 'streams/pages/404.php';
            return;
        }
        self::redirect();
        require APP . $filepath;
    }

    private static function redirect()
    {
        if (!empty($_SESSION['redirect_to'])) {
            $url = $_SESSION['redirect_to'];
            unset($_SESSION['redirect_to']);
            redirect($url);
            exit;
        }
    }
}