<?php
// データベース接続（本番環境で変更）
define('DB_HOST', 'mysql');
define('DB_NAME', 'sample');
define('DB_USER', 'testuser');
define('DB_PASS', 'password');
define('DB_CHARSET', 'utf8');

// バリデーション文字制限
define('REGEXP_ALPHANUMERIC', '/\A[0-9a-zA-Z]+\z/');
define('REGEXP_POSITIVE_INTEGER', '/\A([1-9][0-9]*|0)\z/');

// 各文字列の最大、最小の長さ
define('USER_NAME_LENGTH_MIN', 5);
define('USER_NAME_LENGTH_MAX', 10);
define('USER_PASSWORD_LENGTH_MIN', 5);
define('USER_PASSWORD_LENGTH_MAX', 10);

define('SHOP_NAME_LENGTH_MIN', 1);
define('SHOP_NAME_LENGTH_MAX', 20);
define('SHOP_DETAIL_LENGTH_MAX', 100);

define('REVIEW_LENGTH_MIN', 5);
define('REVIEW_LENGTH_MAX', 200);

// 発行するトークンの長さを指定
define('TOKEN_LENGTH', 20);