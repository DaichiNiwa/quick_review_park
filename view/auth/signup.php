<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>サインアップ</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header.php'; ?>
<div class="container">
    <h3>ユーザー登録</h3>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <form method="post" action="signup_process.php" class="signup_form mx-auto">
        <div class="form-group">
            <label for="name">名前 (半角英数字5文字以上10文字以内)</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group mt-1">
            <label for="password">パスワード(半角英数字5文字以上10文字以内)</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group mt-1">
            <label for="password_confirmation">パスワード（確認用）: </label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <input type="hidden" name="csrf_token" value="<?=h ($token); ?>">
        <input type="submit" value="登録" class="btn btn-primary mt-2">
    </form>
</div>
</body>
</html>