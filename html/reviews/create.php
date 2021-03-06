<?php
require_once '../../conf/autoload.php';

session_start();

if (!Auth::check()) {
    redirect_to(LOGIN);
}

$shop_id = (int)get_get('id');
$db = get_db_connect();
$token = get_csrf_token();

$user = Auth::user($db);
$shop = Shop::find($db, $shop_id);

include_once '../../view/reviews/create.php';
