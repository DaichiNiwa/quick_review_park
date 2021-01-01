<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>店舗一覧</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header_login.php'; ?>
<div class="container">
    <h3>店舗一覧</h3>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <a class="btn btn-secondary mb-3" href="<?= h(SHOPS_CREATE); ?>">店舗登録</a>

    <?php if (count($shops) > 0) { ?>
            <?php foreach ($shops as $shop) { ?>
                <div class="border-bottom py-2">
                    <a class="text-decoration-none" href="<?= h(SHOPS_SHOW . "?shop_id=" . $shop->id); ?>"><?= h($shop->name); ?></a>
                    <p class="pl-2 my-2">
                        <small>平均スコア: <?= h($shop->average_score); ?>　　</small>
                        <small>レビュー数: <?= h($shop->total_reviews); ?></small>
                    </p>
                </div>
            <?php } ?>
    <?php } ?>
</div>
</body>
</html>