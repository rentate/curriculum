<?php
// ログインチェック
function login_check(){
    session_start();
    if(empty($_SESSION)){
        header('Location: login.php');
        exit();
    }
}

// htmlspecialcharsに変換
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

// 不正アクセス対策
function param_check($param){
    if(empty($param)){
        header('Location: main.php');
        exit();
    }
}

?>