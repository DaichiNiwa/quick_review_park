<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>ログイン</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header.php'; ?>
<div class="container">
    <h3>ログイン</h3>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <p>名前：testuser、パスワード：passwordでログインできます。</p>

    <form method="post" action="login_process.php" class="login_form mx-auto">
        <div class="form-group">
            <label for="name">名前: </label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group mt-1">
            <label for="password">パスワード: </label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <input type="hidden" name="csrf_token" value="<?= h($token); ?>">

        <input type="submit" value="ログイン" class="btn btn-primary mt-2">
    </form>
</div>
</body>
</html>