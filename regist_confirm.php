<!DOCTYPE html>
<html lang ="ja">
    <head>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
        <title>アカウント登録確認画面</title>
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
        <h2>アカウント登録確認画面</h2>
        <ul class = "ul">
            <li>
                <label class ="form_name">名前（姓）</label>
                <p><?php echo $_POST ['family_name'];?></p>
            </li>
            <li>
                <label class ="form_name">名前（名）</label>
                <p><?php echo $_POST ['last_name'];?></p>
            </li>
            <li>
                <label class ="form_name">カナ（姓）</label>
                <p><?php echo $_POST ['family_name_kana'];?></p>
            </li>
            <li>
                <label class ="form_name">カナ（名）</label>
                <p><?php echo $_POST ['last_name_kana'];?></p>
            </li>
            <li>
                <label class ="form_name">メールアドレス</label>
                <p><?php echo $_POST ['mail'];?></p>
            </li>
            <li>
                <label class ="form_name">パスワード</label>
                <p><?php
                    for($i = 0;$i < mb_strlen($_POST ['password']);$i++){ //文字数分●表示
                            echo "●"; 
                    };?></p>
            </li>
            <li>
                <label class ="form_name">性別</label>
                <p><?php echo $_POST ['gender'];?></p>
            </li>
            <li>
                <label class ="form_name">郵便番号</label>
                <p><?php echo $_POST ['postal_code'];?></p>
            </li>
            <li>
                <label class ="form_name">住所（都道府県）</label>
                <p><?php echo $_POST ['prefecture'];?></p>
            </li>
            <li>
                <label class ="form_name">都道府県（市区町村）</label>
                <p><?php echo $_POST ['address_1'];?></p>
            </li>
            <li>
                <label class ="form_name">都道府県（番地）</label>
                <p><?php echo $_POST ['address_2'];?></p>
            </li>
            <li>
                <label class ="form_name">アカウント権限</label>
                <p><?php echo $_POST ['authority'];?></p>
            </li>
        
        <form method = "POST" action ="regist.php">
            <input type = "submit" class = "botton1" value = "前に戻る">
        </form>
        
        <form method = "POST" action ="regist_complete.php">
            <input type = "submit" class = "botton2" value = "登録する">
            <input type = "hidden" value = "<?php echo $_POST['family_name'];?>" name = "family_name">
            <input type = "hidden" value = "<?php echo $_POST['last_name'];?>" name = "last_name">
            <input type = "hidden" value = "<?php echo $_POST['family_name_kana'];?>" name = "family_name_kana">
            <input type = "hidden" value = "<?php echo $_POST['last_name_kana'];?>" name = "last_name_kana">
            <input type = "hidden" value = "<?php echo $_POST['mail'];?>" name = "mail">
            <input type = "hidden" value = "<?php echo $_POST['password'];?>" name = "password">
            <input type = "hidden" value = "<?php if($_POST['gender'] == "男"){  //男を選択した場合０、女の場合１
                                                        echo 0;
                                                    } else{
                                                        echo 1;
                                                    }?>" name = "gender">
            <input type = "hidden" value = "<?php echo $_POST['postal_code'];?>" name = "postal_code">
            <input type = "hidden" value = "<?php echo $_POST['prefecture'];?>" name = "prefecture">
            <input type = "hidden" value = "<?php echo $_POST['address_1'];?>" name = "address_1">
            <input type = "hidden" value = "<?php echo $_POST['address_2'];?>" name = "address_2">
            <input type = "hidden" value = "<?php if($_POST['authority'] == "一般"){  //一般を選択した場合０、管理者を選択した場合１
                                                        echo 0;
                                                    } else{
                                                        echo 1;
                                                    }?>" name = "authority">
        </form>    
    </div>
    <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
    </body>
</html>        