<?php

namespace App\Core;

class Access
{
    public static function allow($list, $url = '/login'): void
    {
        $role = $_SESSION['role'] ?? 'guest';
        if (!(in_array($role, is_array($list) ? $list : array_map('trim',explode(',',$list)), true))) {
			redirect($url);
		}
    }

    public static function can($list): bool
    {
        $role = $_SESSION['role'] ?? 'guest';
        return in_array($role, is_array($list) ? $list : array_map('trim',explode(',',$list)), true);
    }

	public static function role()
    {	
        $role = $_SESSION['role'] ?? 'guest';
        
		$roles['master'] 	= 'Master';
		$roles['user']   	= 'Usuário';
		$roles['auditor']   = 'Auditor';
		$roles['analyst']   = 'Analista';
		$roles['support']   = 'Suporte';
		$roles['editor']   	= 'Editor';
		$roles['owner']   	= 'Proprietário';
		$roles['client']   	= 'Cliente';
		$roles['manager']	= 'Administrador';
		$roles['guest']	    = 'Visitante';
		
		return $roles[$role] ?? 'Indefinido';
	}

    public static function init()
    {
        self::access([
            'ip'         => ip(),
            'method'     => $_SERVER['REQUEST_METHOD'] ?? null,
            'path'       => $_SERVER['REQUEST_URI'] ?? 'none',
            'request_id' => IDEMPOTENCY,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public static function request_get()
    {
        if (empty($_REQUEST['rc'])) {
            return false;
        }
        $sql = "SELECT * FROM nano_requests WHERE request_id = ? LIMIT 1";
        return Data::one($sql, [$_REQUEST['rc']]);
    }

    public static function request_set()
    {
        $sql = "INSERT INTO nano_requests (request_id, created_at) VALUES (?, datetime('now'))";
        Data::query($sql, [$_REQUEST['rc']]);
    }

    private static function access(array $data)
    {
        $sql = "INSERT INTO nano_access (created_at, user_id, ip, method, path, request_id)
                VALUES (:created_at, :user_id, :ip, :method, :path, :request_id)";
        Data::query($sql, $data);
    }

    public static function rate(string $ip, int $limit = 10, int $seconds = 60): bool
    {
        $sql = "SELECT COUNT(*) AS c FROM nano_access WHERE ip = ? AND created_at > ?"; 
        $since = time() - $seconds;
        $res = Data::query($sql, [$ip, $since]);
        return ($res[0]['c'] ?? 0) >= $limit;
    }
}
