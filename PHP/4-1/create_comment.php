<?php
session_start();
require('db_connect.php');
require('function.php');
login_check();
param_check($_GET);
$post_id = $_GET['post_id'];

// 投稿ボタンがおされたら
if(!empty($_POST)){
    // 文字が入っていたら
    if($_POST['name'] !== '' && $_POST['content'] !== ''){
        $comments = $db->prepare('INSERT INTO comments (post_id, name, content) VALUES (?, ?, ?)');
        $comments->execute(array($post_id, $_POST['name'], $_POST['content']));
        header('Location: detail_post.php?id=' . $post_id);
    } else{
        echo '投稿者名とコメントを記入してください';
    }
}

var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コメントの投稿</title>
</head>
<body>
<h1>コメントの投稿</h1>
<form action="" method="POST">
    投稿者名:<br>
    <input type="text" name="name"><br>
    コメント:<br>
    <textarea name="content" cols="30" rows="10"></textarea><br>
    <input type="submit" value="コメントする">
</form>
<a href="detail_post.php?id=<?= $post_id; ?>">記事詳細に戻る</a><br>
<a href="main.php">ホームに戻る</a>
    
</body>
</html>