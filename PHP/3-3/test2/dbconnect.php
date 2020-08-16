<?php
// セッション開始
session_start();
// DBサーバのURL
$db['host'] = "localhost";
// ユーザー名
$db['user'] = "root";
// ユーザー名のパスワード
$db['pass'] = "root";
// データベース名
$db['dbname'] = "YIGroupBlog";

$db['dsn'] = "mysql:host=".$db['host'].";charset=utf8;dbname=".$db['dbname'];

try {
    $pdo = new PDO($db['dsn'], $db['user'], $db['pass']);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    die();
}


