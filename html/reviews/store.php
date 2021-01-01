<?php
require_once '../../conf/autoload.php';

session_start();

if (!Auth::check()) {
    redirect_to(LOGIN);
}

if (!is_valid_csrf_token($_POST['csrf_token'])) {
    die('不正なアクセスが行われました。');
}

$review = get_post('review');
$shop_id = get_post('shop_id');

$db = get_db_connect();

$validator = new Validator();
if (!$validator->store_review($review, $shop_id, $db)) {
    set_error('レビュー投稿に失敗しました。');
    redirect_to(REVIEWS_CREATE. '?shop_id=' . $shop_id);
}

$user = Auth::user($db);
try {
    $review_store_service = new ReviewStoreService();
    $review_store_service->execute($db, $review, $shop_id, $user->id);
} catch (PDOException $e) {
    set_error('レビュー投稿に失敗しました。');
    redirect_to(REVIEWS_CREATE. '?shop_id=' . $shop_id);
}

set_message('レビュー投稿しました。');
// TODO: レビュー詳細に遷移する
redirect_to(SHOPS);