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

    <div class="border-bottom py-2">
        <p><?= h($shop->detail) ?></p>
        <p>平均スコア: <?= h($shop->average_score) ?>　　</p>
        <p>レビュー数: <?= h($shop->total_reviews) ?></p>
    </div>
    <a class="btn btn-secondary my-3" href="<?= h(REVIEWS_CREATE . '?shop_id=' . $shop->id); ?>">レビュー投稿</a>
</div>
</body>
</html>