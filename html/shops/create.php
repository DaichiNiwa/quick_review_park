<?php
require_once '../../conf/autoload.php';

session_start();

if (!Auth::check()) {
    redirect_to(LOGIN);
}

$token = get_csrf_token();
$db = get_db_connect();

$user = Auth::user($db);

include_once '../../view/shops/create.php';
