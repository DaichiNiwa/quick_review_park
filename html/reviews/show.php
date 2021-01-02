<?php
require_once '../../conf/autoload.php';

session_start();

if (!Auth::check()) {
    redirect_to(LOGIN);
}

$review_id = (int)get_get('id');
$db = get_db_connect();

$validator = new Validator();
if (!$validator->is_existing_review_id($db, $review_id)) {
    set_error('不正なリクエストです。');
    redirect_to(MYPAGE);
}

$user = Auth::user($db);
$review = Review::find_with_contents($db, $review_id);
$shop = Shop::find($db, $review->shop_id);

include_once '../../view/reviews/show.php';
