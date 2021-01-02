<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>レビュー投稿</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header_login.php'; ?>
<div class="container">
    <h3>レビュー投稿</h3>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <p>店舗名：<?= h($shop->name) ?></p>
    <form method="post" action="store.php" class="mx-auto">
        <div class="form-group mt-2">
            <label for="review">レビュー(200文字以内): </label>
            <textarea class="form-control" type="text" name="review" id="review" rows="3" maxlength="200"></textarea>
        </div>
        <input type="hidden" name="id" value="<?= h($shop->id) ?>">
        <input type="hidden" name="csrf_token" value="<?= h($token) ?>">

        <input type="submit" value="投稿" class="btn btn-primary mt-2">
    </form>
</div>
</body>
</html>