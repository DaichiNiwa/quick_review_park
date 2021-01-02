<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>レビュー詳細</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header_login.php'; ?>
<div class="container">
    <h3>レビュー詳細</h3>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <p>店舗名：
        <a class="text-decoration-none" href="<?= h(SHOPS_SHOW . "?id=" . $shop->id); ?>"><?= h($shop->name); ?></a>
    </p>
    <p>ユーザー名：<?= h($user->name) ?></p>
    <p>投稿日時：<?= h($review->created_at) ?></p>
    <p>合計スコア：<?= h($review->formatted_total_score()) ?></p>

    <table class="table table-bordered">
        <thead class="thead-lignt">
        <tr>
            <th>文</th>
            <th class="col-2">スコア</th>
        </tr>
        <?php foreach ($review->contents as $content) { ?>
        <tr>
            <td><?= $content->body ?></td>
            <td><?= $content->score ?></td>
        </tr>
        <?php } ?>
        </thead>
    </table>
</div>
</body>
</html>