<?php
session_start();
require('db_connect.php');

// 送信されたとき
if(!empty($_POST)){
    if($_POST['name'] === ''){
        $error['name'] = 'blank';
    }
    if($_POST['password'] === ''){
        $error['password'] = 'blank';
    }
    // エラーがなかったときの処理
    if(empty($error)){
        $stmt = $db->prepare('INSERT INTO users (name, password) values(?, ?)');
        $stmt->execute(array($_POST['name'], password_hash($_POST['password'], PASSWORD_DEFAULT)));
        $_SESSION = $_POST;
        $signUpMessage = '登録が完了しました!';
        $main_link = '<a href="main.php">ホームへ</a>';
        $_POST['name'] = '';
    }
}

// var_dump($_SESSION);
// var_dump($stmt);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
</head>
<body>
    <?= $signUpMessage; ?>
    <br>
    <?= $main_link; ?>
    <h1>新規登録</h1>
    <a href="login.php">アカウントをお持ちの方はコチラ</a>
    <form action="" method="POST">
        名前:<br>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES); ?>"><br>
        <?php if($error['name'] === 'blank') : ?>
        <p>名前を入力してください</p>
        <?php endif; ?>
        パスワード:<br>
        <input type="password" name="password" id="password"><br>
        <?php if($error['password'] === 'blank') : ?>
        <p>パスワードを入力してください</p>
        <?php endif; ?>
        <input type="submit" value="登録" id="signUp" name="signUp">
    </form>
</body>
</html>