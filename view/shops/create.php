<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>店舗登録</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header_login.php'; ?>
<div class="container">
    <h3>店舗登録</h3>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <form method="post" action="store.php" class="mx-auto">
        <div class="form-group">
            <label for="name">名前: </label>
            <input type="text" name="name" id="name" class="form-control" maxlength="20" required>
        </div>
        <div class="form-group mt-2">
            <label for="detail">説明(100文字以内): </label>
            <textarea class="form-control" type="text" name="detail" id="detail" rows="3" maxlength="100"></textarea>
        </div>
        <input type="hidden" name="csrf_token" value="<?= h($token); ?>">

        <input type="submit" value="登録" class="btn btn-primary mt-2">
    </form>
</div>
</body>
</html>