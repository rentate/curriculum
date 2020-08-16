<?php
session_start();
require('db_connect.php');
// var_dump($_SESSION);
// echo '<br>';
// var_dump($row);

if(!empty($_POST)){
    // 入力チェック
    if($_POST['name'] === ''){
        $error['name'] = 'blank';
    }
    if($_POST['password'] === ''){
        $error['password'] = 'blank';
    }

    // 名前とパスワードのチェック
    if($_POST['name'] !== '' && $_POST['password'] !== ''){
        $name_check = $db->prepare('SELECT * FROM users WHERE name=?');
        $name_check->execute(array($_POST['name']));
        $user = $name_check->fetch(PDO::FETCH_ASSOC);
        
        if(password_verify($_POST['password'], $user['password'])){
            // ログインできたユーザーの情報を$_SESSIONに入れる
            $_SESSION = $user;   
            header("Location: main.php");
            exit();
        } else{
            echo '名前もしくはパスワードが違います';
        }  
    } 
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン画面</h1>
    <a href="signUp.php">新規登録の方はコチラ</a>
    <form action="" method="POST">
        名前:<br>
        <?php if($error['name']) : ?>
        <p>名前を入力してください</p>
        <?php endif; ?>
        <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES); ?>"><br>
        パスワード:<br>
        <?php if($error['password']) : ?>
        <p>パスワードを入力してください</p>
        <?php endif; ?>
        <input type="password" name="password"><br>
        <input type="submit" value="ログイン">
    </form>
</body>
</html>