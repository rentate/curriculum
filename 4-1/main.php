<?php
session_start();
require('function.php');
require('db_connect.php');
login_check();

$posts = $db->query('SELECT * FROM posts ORDER BY id DESC');


// var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メインページ</title>
</head>
<body>
    <h1>メインページ</h1>
    <p>ようこそ <?= h($_SESSION['name']); ?> さん</p>
    <a href="logout.php">ログアウト</a>
    <a href="create_post.php">記事を投稿する</a>
    <h2>記事一覧</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>タイトル</th>
            <th>本文</th>
            <th>投稿日</th>
        </tr>
        <?php while($post = $posts->fetch()) : ?>
        <tr>
            <td><?= $post['id']; ?></td>
            <td><?= $post['title']; ?></td>
            <td><?= $post['content']; ?></td>
            <td><?= $post['time']; ?></td>
            <td><a href="detail_post.php?id=<?= h($post[id]); ?>">詳細</a></td>
            <td><a href="edit_post.php?id=<?= h($post[id]); ?>">記事の編集</a></td>
            <td><a href="delete_post.php?id=<?= h($post[id]); ?>">記事の削除</a></td>
        </tr>
        <?php endwhile; ?>
    </table>


</body>
</html>