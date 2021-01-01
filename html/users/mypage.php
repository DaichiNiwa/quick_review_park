<?php
require_once '../../conf/autoload.php';

session_start();

if (!Auth::check()) {
    redirect_to(LOGIN);
}

$db = get_db_connect();

$user = Auth::user($db);

include_once '../../view/users/mypage.php';
