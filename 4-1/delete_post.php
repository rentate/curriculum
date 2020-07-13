<?php
session_start();
require('db_connect.php');
require('function.php');
login_check();

$id = $_GET['id'];
param_check($id);


$del = $db->prepare('DELETE FROM posts WHERE id=?');
$del->execute(array($id));

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事の削除</title>
</head>
<body>
    <h1>記事を削除しました</h1>
    <a href="main.php">ホームに戻る</a>
</body>
</html>