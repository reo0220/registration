<!DOCTYPE html>
<html lang ="ja">
    <head>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
        <title>アカウント削除画面</title>
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
                <button onclick="location.href='regist.php'" class ="btn">アカウント登録</button>
            </li>
            <li>
                <button onclick="location.href='list.php'" class ="btn">アカウント一覧</button>
            </li>
        </ul>
        <h2>アカウント削除画面</h2>
        <main>
            <?php
                    $user_id = $_GET["user_id"];
                    mb_internal_encoding("utf8");
                    $dbh = new PDO("mysql:dbname=registration;host=localhost;","root","root");
                    $sql = "SELECT * FROM users WHERE id = $user_id ";//パラメータに渡された[user_id]のidの情報を取り出す
                    $stmt = $dbh->query($sql);
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>    
           <ul class ="ul">
           <li>
                    <label class ="form_name">名前（姓）</label>
                    <p><?php echo $result['family_name'];?></p>
                </li>
                <li>
                    <label class ="form_name">名前（名）</label>
                    <p><?php echo $result['last_name'];?></p>
                </li>
                <li>
                    <label class ="form_name">カナ（姓）</label>
                    <p><?php echo $result['family_name_kana'];?></p>
                </li>
                <li>
                    <label class ="form_name">カナ（名）</label>
                    <p><?php echo $result['last_name_kana'];?></p>
                </li>
                <li>
                    <label class ="form_name">メールアドレス</label>
                    <p><?php echo $result['mail'];?></p>
                </li>
                <li>
                    <label class ="form_name">パスワード</label>
                    <p><?php
                        for($i = 0;$i < mb_strlen($result['password']);$i++){ //文字数分●表示
                                echo "●"; 
                        };?></p>
                </li>
                <li>
                    <label class ="form_name">性別</label>
                    <p><?php echo $result['gender'];?></p>
                </li>
                <li>
                    <label class ="form_name">郵便番号</label>
                    <p><?php echo $result['postal_code'];?></p>
                </li>
                <li>
                    <label class ="form_name">住所（都道府県）</label>
                    <p><?php echo $result['prefecture'];?></p>
                </li>
                <li>
                    <label class ="form_name">都道府県（市区町村）</label>
                    <p><?php echo $result['address_1'];?></p>
                </li>
                <li>
                    <label class ="form_name">都道府県（番地）</label>
                    <p><?php echo $result['address_2'];?></p>
                </li>
                <li>
                    <label class ="form_name">アカウント権限</label>
                    <p><?php echo $result['authority'];?></p>
                </li>

        </main>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>

    </body>
 </html>    