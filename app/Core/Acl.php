<?php

namespace App\Core;

class Acl
{
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
}
