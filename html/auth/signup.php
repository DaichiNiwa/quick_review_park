<?php
require_once '../../conf/autoload.php';

session_start();

if(Auth::check()){
    redirect_to(MYPAGE);
}

$token = get_csrf_token();

include_once '../../view/auth/signup.php';