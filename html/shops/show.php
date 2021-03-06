<?php
require_once '../../conf/autoload.php';

session_start();

if (!Auth::check()) {
    redirect_to(LOGIN);
}

$shop_id = (int)get_get('id');
$db = get_db_connect();

$validator = new Validator();
if (!$validator->is_existing_shop_id($db, $shop_id)) {
    set_error('不正なリクエストです。');
    redirect_to(MYPAGE);
}

$user = Auth::user($db);
$shop = Shop::find($db, $shop_id);
$reviews = $shop->fetch_reviews($db);

include_once '../../view/shops/show.php';
