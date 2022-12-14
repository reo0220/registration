<?php
    session_start();
    
    if(isset($_SESSION['mail'])){
            $mail = $_SESSION['mail'];
            
            mb_internal_encoding("utf8");
            $dbh = new PDO("mysql:dbname=registration;host=localhost;","root","root");
            $sql = "SELECT * FROM users WHERE mail = '$mail'";
            $stmt = $dbh->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['authority'] = $result['authority'];
    }

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" type = "text/css" href = "style1.css">
    <title>diblogs</title>
</head>
<body>
    <img src ="diblog_logo.jpg">
    <ul class = "a">
        <li>トップ</li>
        <li>プロフィール</li>
        <li>D.I.Blogについて</li>
        <li>登録フォーム</li>
        <li>問い合わせ</li>
        <li>その他</li>
        <li>
            <?php 
                if(isset($result['authority']) && $result['authority'] === "0"){
                    echo "";
                    }elseif(isset($result['authority']) && $result['authority'] === "1"){
                    echo "<button><a href = 'regist.php'>アカウント登録</a></button>";
                }else{
                    echo "";
                }
            ?>
        </li>
        <li>
            <?php 
                if(isset($result['authority']) && $result['authority'] === "0"){
                    echo "";
                    }elseif(isset($result['authority']) && $result['authority'] === "1"){
                    echo "<button><a href = 'list.php'>アカウント一覧</a></button>";
                }else{
                    echo "";
                }
            ?>
        </li>
    </ul>
    <main>
        <div class ="left">
            <h1>プログラミングに役立つ書籍</h1>
            <p>2017年1月15日</p>
        </div>
        <div class = "right">
            <h3>人気の記事</h3>
            <ul class ="b">
                <li>PHPおすすめ本</li>
                <li>PHP MyAdminの使い方</li>
                <li>今人気のエディタTop5</li>
                <li>HTMLの基礎</li>
            </ul>    
            <h3>おすすめリンク</h3>
            <ul class ="b">
                <li>ディーアイワークス株式会社</li>
                <li>XAMPPのダウンロード</li>
                <li>Eclipseのダウンロード</li>
                <li>Bracketsのダウンロード</li>
            </ul>
            <h3>カテゴリ</h3>
            <ul class ="b">
                <li>HTML</li>
                <li>PHP</li>
                <li>MySQL</li>
                <li>JavaScript</li>
            </ul>        
        </div>
    </main>
    <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
</body>
</html>