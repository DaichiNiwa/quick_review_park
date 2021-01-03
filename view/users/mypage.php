<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>マイページ</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header_login.php'; ?>
<div class="container">
    <h3>マイページ</h3>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <p><?= h($user->name); ?></p>

    <h4>レビュー一覧</h4>
    <table class="table table-bordered">
        <thead class="thead-lignt">
        <tr>
            <th>店舗名</th>
            <th class="col-2">スコア</th>
            <th>投稿日時</th>
            <th>詳細</th>
        </tr>
        <?php foreach ($reviews as $review) { ?>
            <tr>
                <td><a class="text-decoration-none" href="<?= h(SHOPS_SHOW . "?id=" . $review->shop_id); ?>"><?= h($review->shop_name) ?></a></td>
                <td><?= h($review->formatted_total_score()) ?></td>
                <td><?= h($review->created_at) ?></td>
                <td><a class="btn btn-secondary" href="<?= h(REVIEWS_SHOW . "?id=" . $review->id); ?>">詳細</a></td>
            </tr>
        <?php } ?>
        </thead>
    </table>

</div>
</body>
</html>