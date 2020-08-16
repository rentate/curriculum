<?php
session_start();
require('function.php');
require('db_connect.php');
login_check();
// var_dump($_SESSION);
// echo '<br>';
// var_dump($_POST);
// echo '<br>';

// 投稿するを押したら
if(!empty($_POST)){
    // 入力チェック
    if($_POST['title'] !== '' && $_POST['post'] !== ''){
        $post = $db->prepare('INSERT INTO posts (title, content) values (?, ?)');
        $post->execute(array($_POST['title'], $_POST['post']));

        header('Location: main.php');
        exit();
    } else {
        echo 'タイトルと記事は両方入力してください';
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事の投稿</title>
</head>
<body>
    <h1>記事の投稿</h1><a href="main.php">ホームに戻る</a>
    <p><?= h($_SESSION['name']);?> さん記事をどうぞ</p>
    <form action="" method="POST">
        タイトル<br>
        <input type="text" name="title" size="30"><br>
        記事<br>
        <textarea name="post" cols="30" rows="10"></textarea><br>
        <input type="submit" value="投稿する">
    </form>
</body>
</html>