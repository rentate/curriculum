<?php
session_start();
require_once('db_connect.php');
require('function.php');
login_check();
$id = $_GET['id'];
param_check($id);



// 記事の情報を取得
$posts = $db->prepare('SELECT * FROM posts WHERE id=?');
$posts->execute(array($id));
$post = $posts->fetch(PDO::FETCH_ASSOC);

// コメントの情報を取得
$comments = $db->prepare('SELECT * FROM comments WHERE post_id=?');
$comments->execute(array($id));



// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
// echo '<pre>';
// var_dump($post);
// echo '</pre>';
// echo '<pre>';
// var_dump($error);
// echo '</pre>';

// 記事があるかチェック
if(empty($post)) {
    $error = 'error';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事詳細</title>
</head>
<body>
    <!-- 記事があれば -->
    <?php if(empty($error)) : ?>
    <h1>記事詳細</h1>
    <table>
        <tr>
            <td>ID</td>
            <td><?= $id; ?></td>
        </tr>
        <tr>
            <td>タイトル</td>
            <td><?= $post['title']; ?></td>
        </tr>
        <tr>
            <td>本文</td>
            <td><?= $post['content']; ?></td>
        </tr>
    </table>
    <?php
    while($comment = $comments->fetch(PDO::FETCH_ASSOC)){
        echo '<hr>';
        echo $comment['name'];
        echo '<br>';
        echo $comment['content'];
        echo '<br>';
    }

    ?>
    <a href="create_comment.php?post_id=<?= $id; ?>">コメントする</a>
    <a href="main.php">ホームに戻る</a>
    <!-- 記事がなければ -->
    <?php else : ?>
    <h1>記事がありません</h1>
    <a href="main.php">ホームに戻る</a>
    <?php endif; ?>
</body>
</html>