<?php

# Functions

function vd($in){
	echo '<pre>';
	if (func_num_args()==1) {
		var_dump($in);
		echo '</pre>';
		return;
	}
	foreach (func_get_args() as $in) {
		var_dump($in);
	}
    echo '</pre>';
}

function mrk(){
	$_ENV['mrk'] = empty($_ENV['mrk']) ? 1 : ($_ENV['mrk'] + 1);
	echo PHP_EOL . $_ENV['mrk'] . PHP_EOL;
}

function redirect($in = '/'){
	header('Location: /' . ltrim($in, '/'));
	exit;
}

function refresh($in = '/', $time = 3){
	header("Refresh: $time; /" . ltrim($in, '/'));
}

function img($in){
	return url($in) . '?t=' . time();
}

function url($path = ''){
	return rtrim(SITE,'/') . '/' . ltrim($path,'/');
}

function url_query($path, $add_query){
	$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY) ?? '';
	parse_str($query, $old_data);
	$data = array_merge($old_data, $add_query);
	return url($path) . '?' . http_build_query($data);
}

function rel($path){
    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $levels = $uri === '' ? 0 : substr_count($uri, '/') + 1;
    return str_repeat('../', $levels) . ltrim($path, '/');
}

function completeRequest(){
    return urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}

function dinamicUrl($path = ''){
    return $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] . '/' . ltrim($path,'/');
}

function ip(): string {
    foreach (['HTTP_CF_CONNECTING_IP','HTTP_X_REAL_IP','HTTP_X_FORWARDED_FOR','REMOTE_ADDR'] as $k) {
        if (!empty($_SERVER[$k])) {
            $ip = $_SERVER[$k];
            if ($k === 'HTTP_X_FORWARDED_FOR' && str_contains($ip, ',')) {
                $ip = trim(explode(',', $ip)[0]);
            }
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
    return '0.0.0.0';
}

function get($in){
	$out = $_GET[$in] ?? null;
	return filter($out);
}

function post($in){
	$out = $_POST[$in] ?? null;
	return filter($out);
}

function session($key, $value = false){
	if ($value) {
		$_SESSION[$key] = filter($value);
	}
	return $_SESSION[$key] ?? null;
}

function filter($in){
	$in = is_string($in) ? trim($in) : $in;
	return $in ? htmlspecialchars($in, ENT_QUOTES, 'UTF-8') : $in;
}
