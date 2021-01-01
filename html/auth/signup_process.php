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
$password_confirmation = get_post('password_confirmation');

$db = get_db_connect();

$validator = new Validator();
if (!$validator->signup($name, $password, $password_confirmation, $db)) {
    set_error('ユーザー登録に失敗しました。');
    redirect_to(SIGNUP);
}

try {
    User::store($db, $name, $password);
} catch (PDOException $e) {
    set_error('ユーザー登録に失敗しました。');
    redirect_to(SIGNUP);
}

set_message('ユーザー登録が完了しました。');
Auth::login($db, $name, $password);
redirect_to(MYPAGE);