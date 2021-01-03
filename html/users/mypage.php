<?php
require_once '../../conf/autoload.php';

session_start();

if (!Auth::check()) {
    redirect_to(LOGIN);
}

$db = get_db_connect();

$user = Auth::user($db);
$reviews = $user->fetch_reviews($db);

include_once '../../view/users/mypage.php';
