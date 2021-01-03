<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title><?= h($shop->name) ?></title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header_login.php'; ?>
<div class="container">
    <h3><?= h($shop->name) ?></h3>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="border-bottom py-3 my-3">
        <p><?= h($shop->detail) ?></p>
        <p>平均スコア: <?= h($shop->get_average_score($db)) ?>　　</p>
        <p>レビュー数: <?= h($shop->total_reviews) ?></p>
    <a class="btn btn-primary" href="<?= h(REVIEWS_CREATE . '?id=' . $shop->id); ?>">レビュー投稿</a>
    </div>

    <h4>レビュー一覧</h4>
    <table class="table table-bordered">
        <thead class="thead-lignt">
        <tr>
            <th>ユーザー名</th>
            <th class="col-2">スコア</th>
            <th>投稿日時</th>
            <th>詳細</th>
        </tr>
        <?php foreach ($reviews as $review) { ?>
            <tr>
                <td><?= h($review->user_name) ?></td>
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