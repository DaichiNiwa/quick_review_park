<?php
require_once '../../conf/autoload.php';

session_start();

if (!Auth::check()) {
    redirect_to(LOGIN);
}

$shop_id = (int)get_get('shop_id');
$db = get_db_connect();

$user = Auth::user($db);
$shop = Shop::find($db, $shop_id);

include_once '../../view/shops/show.php';
