<?php
function h($word){
    return htmlspecialchars($word, ENT_QUOTES, 'UTF-8');
}

function dd($var){
    var_dump($var);
    exit();
}

function redirect_to($url){
    header('Location: ' . $url);
    exit;
}

function get_get($name, $default = ''){
    if(isset($_GET[$name]) === true){
        return $_GET[$name];
    };
    return $default;
}

function get_post($name){
    if(isset($_POST[$name]) === true){
        return $_POST[$name];
    };
    return '';
}

function get_session($name){
    if(isset($_SESSION[$name]) === true){
        return $_SESSION[$name];
    };
    return '';
}

function set_session($name, $value){
    $_SESSION[$name] = $value;
}

function set_error($error){
    $_SESSION['__errors'][] = $error;
}

function get_errors(){
    $errors = get_session('__errors');
    if($errors === ''){
        return [];
    }
    set_session('__errors',  []);
    return $errors;
}

function has_error(){
    return isset($_SESSION['__errors']) && count($_SESSION['__errors']) !== 0;
}

function set_message($message){
    $_SESSION['__messages'][] = $message;
}

function get_messages(){
    $messages = get_session('__messages');
    if($messages === ''){
        return [];
    }
    set_session('__messages',  []);
    return $messages;
}

function get_csrf_token(){
    $token = get_random_string(TOKEN_LENGTH);
    set_session('csrf_token', $token);

    return $token;
}

function get_random_string($length = 20){
    return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}

function is_valid_csrf_token($token){
    if($token === ''){
        return false;
    }
    return $token === get_session('csrf_token');
}