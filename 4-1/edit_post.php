<?php
require('db_connect.php');
require('function.php');
login_check();

$id = $_GET['id'];

param_check($id);


// IDから記事情報を取得
$posts = $db->prepare('SELECT * FROM posts WHERE id=?');
$posts->execute(array($id));
$post = $posts->fetch(PDO::FETCH_ASSOC);

// 指定したidの記事がなかったとき
if (empty($post)){
    $error = 'error';
}

// 編集完了ボタンが押されたとき
if(!empty($_POST) && empty($error)){
    $edits = $db->prepare('UPDATE posts SET title=:title, content=:content WHERE id=:id');
    $edits->bindParam(':title', $_POST['title']);
    $edits->bindParam(':content', $_POST['post']);
    $edits->bindParam(':id', $id);
    $edits->execute();
    header('Location: main.php');
    exit();
}


// var_dump($_GET);
// var_dump($error);
// var_dump($id);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事編集</title>
</head>
<body>
    <h1>記事編集</h1>
    <a href="main.php">戻る</a>
    <?php if($error) : ?>
        <p>対象のデータがありません</p>
    <?php else: ?>
        <form action="" method="POST">
            タイトル<br>
            <input type="text" name="title" value="<?= $post['title']; ?>"><br>
            記事<br>
            <textarea name="post" cols="30" rows="10"><?= $post['content']; ?></textarea><br>
            <input type="submit" value="編集完了">
        </form>
    <?php endif; ?>
</body>
</html>