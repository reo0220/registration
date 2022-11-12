<?php
mb_internal_encoding("utf8");
$pdo = new PDO("mysql:dbname=registration;host=localhost;","root","root");

$pdo -> exec("insert into users(family_name,last_name,family_name_kana,last_name_kana,mail,password,gender,postal_code,prefecture,address_1,address_2,authority)
values('".$_POST['family_name']."','".$_POST['last_name']."','".$_POST['family_name_kana']."','".$_POST['last_name_kana']."','".$_POST['mail']."','".password_hash($_POST['password'],PASSWORD_DEFAULT)."','".$_POST['gender']."','".$_POST['postal_code']."','".$_POST['prefecture']."','".$_POST['address_1']."','".$_POST['address_2']."','".$_POST['authority']."');");

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" type = "text/css" href = "style2.css">
    <title>アカウント登録完了画面</title>
</head>
<body>
    <img src ="diblog_logo.jpg">
    <ul class = "a">
        <li>トップ</li>
        <li>プロフィール</li>
        <li>D.I.Blogについて</li>
        <li>登録フォーム</li>
        <li>問い合わせ</li>
        <li>
            <a href = "regist.php">アカウント登録</a>
        </li>
        <li>その他</li>
    </ul>
    <h2 class = "h2">アカウント登録完了画面</h2>
    <div class = "center">
        <div class = "center_item"><h1>登録完了しました</h1></div>
    </div>   
    <form class = "z" method = "POST" action ="index.html">
            <input type = "submit" class = "botton3" value = "TOPページに戻る">
        </form>
    <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
</body>

</html>