<?php
// 作成したdb_connect.phpを読み込む
require_once('db_connect.php');

$name = 'Hanako Yamada';
$password = 'jiro';
$id = 1;

// 実行したいSQL文を準備
// 今回はusersテーブルにレコードを追加

// $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";
// $sql = "SELECT * FROM users";
// $sql = "SELECT * FROM users WHERE id = :id";
// $sql = "UPDATE users SET name = :name WHERE id = :id";
$sql = "DELETE FROM users WHERE id = :id";

// 関数db_connect()からPDOを取得する
$pdo = db_connect();
try {
    // // insert
    // $stmt = $pdo->prepare($sql);
    // $stmt->bindParam(':name', $name);
    // $stmt->bindParam(':password', $password);
    // $stmt->execute();
    // echo 'インサートしました。';

    // // select
    // 全件出力
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();
    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //     echo $row['id'] . ', ' . $row['name'] . ', ' . $row['password'];
    //     echo '<br>';
    // }

    // id=1のみ出力
    // $stmt = $pdo->prepare($sql);
    // $stmt->bindParam(':id', $id);
    // $stmt->execute();
    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //     echo $row['id'] . ', ' . $row['name'] . ', ' . $row['password'];
    //     echo '<br>';
    // }

    // // UPDATE
    // $stmt = $pdo->prepare($sql);
    // $stmt->bindParam(':name', $name);
    // $stmt->bindParam(':id', $id);
    // $stmt->execute();
    // echo 'UPDATE!';

    // DELETE
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo 'DELETE!';



} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    die();
}