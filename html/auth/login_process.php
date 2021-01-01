<?php
require_once '../../conf/autoload.php';

session_start();

if (Auth::check()) {
    redirect_to(MYPAGE);
}

if (!is_valid_csrf_token($_POST['csrf_token'])) {
    die('不正なアクセスが行われました。');
}

$name = get_post('name');
$password = get_post('password');

$db = get_db_connect();

$user = Auth::login($db, $name, $password);
if(!$user){
    set_error('ログインに失敗しました。');
    redirect_to(LOGIN);
}

set_message('ログインしました。');
redirect_to(MYPAGE);