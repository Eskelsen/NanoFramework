<?php

namespace App\Core;

class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            self::tenacity();
            return;
        }

        session_name('nano');

        session_set_cookie_params([
            'lifetime' => 0,
            'path'     => '/',
            'domain'   => '',
            'secure'   => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');

        ini_set('session.gc_probability', '1');
        ini_set('session.gc_divisor', '10');
        ini_set('session.gc_maxlifetime', '604800');

        session_start();

        $_SESSION['_last_regeneration'] = time();
    }

    public static function regenerate(): void
    {
        session_regenerate_id(true);
        $_SESSION['_last_regeneration'] = time();
    }

    public static function tenacity(): void
    {
        if (time() - $_SESSION['_last_regeneration'] > 1800) {
            self::regenerate();
        }
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function set($key,$value)
    {
        $_SESSION[$key] = $value;
    }
}
