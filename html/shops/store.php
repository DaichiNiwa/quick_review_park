<?php
require_once '../../conf/autoload.php';

session_start();

if (!Auth::check()) {
    redirect_to(LOGIN);
}

if (!is_valid_csrf_token($_POST['csrf_token'])) {
    die('不正なアクセスが行われました。');
}

$name = get_post('name');
$detail = get_post('detail');

$db = get_db_connect();

$validator = new Validator();
if (!$validator->store_shop($name, $detail, $db)) {
    set_error('店舗登録に失敗しました。');
    redirect_to(SHOPS_CREATE);
}

try {
    Shop::store($db, $name, $detail);
} catch (PDOException $e) {
    set_error('店舗登録に失敗しました。');
    redirect_to(SHOPS_CREATE);
}

set_message('店舗登録しました。');
redirect_to(SHOPS);