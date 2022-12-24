<?php
    session_start();
    unset($_SESSION['family_name_send']);
    
    if(isset($_SESSION['mail'])){

            $mail = $_SESSION['mail'];
            
            mb_internal_encoding("utf8");
            $dbh = new PDO("mysql:dbname=registration;host=localhost;","root","root");
            $sql = "SELECT * FROM users WHERE mail = '$mail'";
            $stmt = $dbh->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['authority'] = $result['authority'];
    }else{
        $login = "NULL";

        $param = $login;
        $param_json = json_encode($param);
    }
    
    ?>
    
   


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" type = "text/css" href = "style1.css">
    <title>diblogs</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
            <script>
            var param = JSON.parse('<?php echo $param_json; ?>');
            
            window.onload = function(){
                if(param == "NULL"){//ログインしていない状態
                    Swal.fire({
                        title: 'エラーが発生しました。',
                        html : '「ログイン」ボタンからログインして下さい。', 
                        type : 'warning',
                        bottons:true,
                        grow : 'fullscreen',
                        confirmButtonText:"ログイン",
                        allowOutsideClick:false
                    }).then((result) =>{
                        if(result.value){
                                window.location.href ="./login.php";
                            }
                    });
                }   
            }

        </script>
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
        <li class = "index_a">
            <?php 
                if(isset($result['authority']) && $result['authority'] === "0"){
                    echo "";
                    }elseif(isset($result['authority']) && $result['authority'] === "1"){
                    echo "<button><a href = 'regist.php' style='text-decoration:none; color:black;'>アカウント登録</a></button>";
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
                    echo "<button><a class = 'index_a' href = 'list.php' style='text-decoration:none; color:black;'>アカウント一覧</a></button>";
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