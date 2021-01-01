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

</div>
</body>
</html>