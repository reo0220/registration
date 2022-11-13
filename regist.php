<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'): {
      //var_dump($_POST);
    //if($_POST !== 0){
        //header("Location:http://localhost/registration/regist_confirm.php");
    //}else{
    $family_name = $_POST['family_name'];
if($family_name === ""){
    $error1 = "名前（姓）が未入力です。";
}
$last_name = $_POST['last_name'];
if($last_name === ""){
    $error2 = "名前(名)が未入力です。";
}
$family_name_kana = $_POST['family_name_kana'];
if($family_name_kana === ""){
    $error3 = "カナ（姓）が未入力です。";
}
$last_name_kana = $_POST['last_name_kana'];
if($last_name_kana === ""){
    $error4 = "カナ（名）が未入力です。";
}
$mail = $_POST['mail'];
if($mail === ""){
    $error5 = "メールアドレスが未入力です。";
}
$password = $_POST['password'];
if($password === ""){
    $error6 = "パスワードが未入力です。";
}
$postal_code = $_POST['postal_code'];
if($postal_code === ""){
    $error7 = "郵便番号が未入力です。";
}
$prefecture = $_POST['prefecture'];
if($prefecture === ""){
    $error8 = "住所（都道府県）が未入力です。";
}
$address_1 = $_POST['address_1'];
if($address_1 === ""){
    $error9 = "都道府県（市区町村）が未入力です。";
}
$address_2 = $_POST['address_2'];
if($address_2 === ""){
    $error10 = "都道府県（番地）が未入力です。";
}
//if(!empty($family_name)){
    //header("Location:http://localhost/registration/regist_confirm.php");
//}
    }
?>
<?php endif;?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" type = "text/css" href = "style2.css">
    <title>アカウント登録画面</title>
    
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
    <main>
        <h2>アカウント登録画面</h2>
        
            <form  name = "form" action = "regist.php" method = "POST">
                <ul class = "ul">
                    <li>
                        <label class = "form_name" id = "formname_1">名前（姓）</label>
                        <input type = "text" name = "family_name" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]{0,10}" value=<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $family_name;}else{echo"";}?> ><!--漢字、ひらがな 10文字まで-->
                        <?php if(!empty($error1)):?>
                            <p class="text-danger"><?php echo $error1 ?></p>
                        <?php endif; ?>
                    </li>
                    <li> 
                        <label class = "form_name">名前（名）</label>
                        <input type = "text" name = "last_name" maxlength = "10" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]{0,10}" value=<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $last_name;}else{echo"";}?>>
                        <?php if(!empty($error2)):?>
                            <p class="text-danger"><?php echo $error2 ?></p>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class = "form_name">カナ（姓）</label>
                        <input type = "text" name = "family_name_kana" class = "form_item" pattern="[\u30A1-\u30F6]{0,10}" value=<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $family_name_kana;}else{echo"";}?>><!--カタカナ 10文字まで-->
                        <?php if(!empty($error3)):?>
                            <p class="text-danger"><?php echo $error3 ?></p>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class = "form_name">カナ（名）</label>
                        <input type = "text" name = "last_name_kana" class = "form_item" pattern="[\u30A1-\u30F6]{0,10}" value=<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $last_name_kana;}else{echo"";}?>>
                        <?php if(!empty($error4)):?>
                            <p class="text-danger"><?php echo $error4 ?></p>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class = "form_name">メールアドレス</label>
                        <input type = "text" name = "mail" class = "form_item" pattern = "[0-9a-zA-Z_\.-]+@[0-9a-zA-Z_\.-]{0,100}" value=<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $mail;}else{echo"";}?>><!--半角英数字とハイフンと＠と＿とドット 100文字まで-->
                        <?php if(!empty($error5)):?>
                            <p class="text-danger"><?php echo $error5 ?></p>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class = "form_name">パスワード</label>
                        <input type = "text" name = "password" class = "form_item" pattern = "[0-9a-zA-Z]{0,10}" value=<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $password;}else{echo"";}?>> <!--半角英数字10文字まで-->
                        <?php if(!empty($error6)):?>
                            <p class="text-danger"><?php echo $error6 ?></p>
                        <?php endif; ?>
                    </li>  
                    <li>
                        <label class = "form_name">性別</label>
                        <input type="radio" name="gender" value="男" checked> 男
                        <input type="radio" name="gender"value="女"> 女
                    </li> 
                    <li>  
                        <label class = "form_name">郵便番号</label>
                        <input type = "text" name = "postal_code" class = "form_item" maxlength = "7" pattern = "[0-9]{0,7}" value=<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $postal_code;}else{echo"";}?>><!--半角数字 7文字まで-->
                        <?php if(!empty($error7)):?>
                            <p class="text-danger"><?php echo $error7 ?></p>
                        <?php endif; ?>
                    </li>  
                    <li>
                        <label class = "form_name">住所（都道府県）</label>
                        <select class = "form_item" name="prefecture">
                            <option value=<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $prefecture;}else{echo"";}?>></option>
                            <option value="北海道">北海道</option>
                            <option value="青森県">青森県</option>
                            <option value="岩手県">岩手県</option>
                            <option value="宮城県">宮城県</option>
                            <option value="秋田県">秋田県</option>
                            <option value="山形県">山形県</option>
                            <option value="福島県">福島県</option>
                            <option value="茨城県">茨城県</option>
                            <option value="栃木県">栃木県</option>
                            <option value="群馬県">群馬県</option>
                            <option value="埼玉県">埼玉県</option>
                            <option value="千葉県">千葉県</option>
                            <option value="東京都">東京都</option>
                            <option value="神奈川県">神奈川県</option>
                            <option value="新潟県">新潟県</option>
                            <option value="富山県">富山県</option>
                            <option value="石川県">石川県</option>
                            <option value="福井県">福井県</option>
                            <option value="山梨県">山梨県</option>
                            <option value="長野県">長野県</option>
                            <option value="岐阜県">岐阜県</option>
                            <option value="静岡県">静岡県</option>
                            <option value="愛知県">愛知県</option>
                            <option value="三重県">三重県</option>
                            <option value="滋賀県">滋賀県</option>
                            <option value="京都府">京都府</option>
                            <option value="大阪府">大阪府</option>
                            <option value="兵庫県">兵庫県</option>
                            <option value="奈良県">奈良県</option>
                            <option value="和歌山県">和歌山県</option>
                            <option value="鳥取県">鳥取県</option>
                            <option value="島根県">島根県</option>
                            <option value="岡山県">岡山県</option>
                            <option value="広島県">広島県</option>
                            <option value="山口県">山口県</option>
                            <option value="徳島県">徳島県</option>
                            <option value="香川県">香川県</option>
                            <option value="愛媛県">愛媛県</option>
                            <option value="高知県">高知県</option>
                            <option value="福岡県">福岡県</option>
                            <option value="佐賀県">佐賀県</option>
                            <option value="長崎県">長崎県</option>
                            <option value="熊本県">熊本県</option>
                            <option value="大分県">大分県</option>
                            <option value="宮崎県">宮崎県</option>
                            <option value="鹿児島県">鹿児島県</option>
                            <option value="沖縄県">沖縄県</option>
                        </select>
                        <?php if(!empty($error8)):?>
                            <p class="text-danger"><?php echo $error8 ?></p>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class = "form_name">都道府県（市区町村）</label>
                        <input type = "text" name = "address_1" class = "form_item" pattern = "[\u4E00-\u9FFF\u3040-\u309Fー0-9０-９\s-]{0,10}" value=<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $address_1;}else{echo"";}?>><!--漢字ひらがな、カタカナ、数字、ハイフン、スペース　10文字-->
                        <?php if(!empty($error9)):?>
                            <p class="text-danger"><?php echo $error9 ?></p>
                        <?php endif; ?>
                    </li>                                       
                    <li>
                        <label class = "form_name">都道府県（番地）</label>
                        <input type = "text" name = "address_2" class = "form_item" pattern = "[\u4E00-\u9FFF\u3040-\u309Fー0-9０-９-\s]{0,10}" value=<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $address_2;}else{echo"";}?>>
                        <?php if(!empty($error10)):?>
                            <p class="text-danger"><?php echo $error10 ?></p>
                        <?php endif; ?>
                    </li>                                                       
                    <li>
                        <label class = "form_name">アカウント権限</label>
                        <select name = "authority">
                            <option value ="一般">一般</option>
                            <option value="管理者">管理者</option>
                        </select>
                    </li>
                    <li><input type = "submit" class = "submit" value="確認する"></li>
                </ul>       
            </form>          
     
    </main>
    <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
</body>
</html>    
