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

function cli($msg, $savelog = false){
    if (PHP_SAPI=='cli') {
        echo $msg . PHP_EOL;
        if ($savelog) {
            error_log($msg);
        }
    }
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

function slugify(string $text, string $sep = '-', ?int $limit = null): string{
    $text = trim($text);
    if (function_exists('transliterator_transliterate')) {
        $text = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; Lower()',
            $text
        );
    } else {
        $text = strtolower(html_entity_decode(
            preg_replace(
                '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i',
                '$1',
                htmlentities($text, ENT_QUOTES, 'UTF-8')
            ),
            ENT_QUOTES,
            'UTF-8'
        ));
    }
    $sepRegex = preg_quote($sep, '~');
    $text = preg_replace('~[^a-z0-9]+~i', $sep, $text);
    $text = preg_replace("~{$sepRegex}{2,}~", $sep, $text);
    $text = trim($text, $sep);
    if ($limit !== null) {
        $text = substr($text, 0, $limit);
        $text = rtrim($text, $sep);
    }
    return strtolower($text);
}

function utf8Filter($in){
    $regex = '/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u';
    return preg_replace($regex,' ', $in);
}

function distance($in, $list){
    foreach ($list as $line) {
        $n[$line] = levenshtein($in, $line);
    }
    return $n ?? [];
}

function relevanTerms($terms) {
    $terms = array_filter(array_map(function($a) { 
        return (strlen($a)>3) ? $a : null;
    },$terms));
    return $terms;
}

function stringFilter($in){
    $in = preg_replace('/[\x{1F600}-\x{1F64F}]/u', '', $in); # Emoticons
    $in = preg_replace('/[\x{1F300}-\x{1F5FF}]/u', '', $in); # Symbols & Pictographs
    $in = preg_replace('/[\x{1F680}-\x{1F6FF}]/u', '', $in); # Transport & Map Symbols
    $in = preg_replace('/[\x{1F700}-\x{1F77F}]/u', '', $in); # Alphabetic Presentation Forms
    $in = preg_replace('/[\x{1F780}-\x{1F7FF}]/u', '', $in); # Geometric Shapes Extended
    return $in;
}

function formatName($name){
    $name = preg_replace('/[^\p{L}\p{N}\s\'-]/u', '', $name);
    $name = mb_strtolower($name);
    $prepositions = ['de', 'da', 'do', 'dos', 'das', 'e', 'del', 'la', 'las', 'los', 'di', 'du', 'der', 'den', 'des', 'von', 'van', 'of', 'af'];
    $words = explode(' ', $name);
    $capitalized = array_map(function($word) use ($prepositions) {
        return in_array($word, $prepositions) ? $word : self::capName($word);
    }, $words);
    $name = implode(' ', $capitalized);
    return preg_replace_callback('/(?:^|[-\'])(\p{L})/u', function ($matches) {
        return mb_strtoupper($matches[0]);
    }, $name);
}

function capName($name){
    return mb_strtoupper(mb_substr($name, 0, 1, 'utf-8'), 'utf-8') . mb_substr($name, 1, null, 'utf-8');
}

# Refresh Control
function rc(){
    return  '<input type="hidden" name="rc" value="' . IDEMPOTENCY . '">' . PHP_EOL;
}

function rc_get(){
    return App\Core\Access::request_get();
}

function rc_set(){
    App\Core\Access::request_set() ;
}

# Time Control
function tc_set($time){
    $_SESSION['tc'] = time() + $time;
}

function tc_get(){
    if (empty($_SESSION['tc'])) {
        return false;
    }
    if ($_SESSION['tc']<=time()) {
        unset($_SESSION['tc']);
        return false;
    }
    return true;
}

# Cross-Site Request Forgery (CSRF)
function csrf(){
    return  '<input type="hidden" name="csrf" value="' . $_SESSION['csrf'] . '">' . PHP_EOL;
}

function csrf_check(){
    return hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '');
}
