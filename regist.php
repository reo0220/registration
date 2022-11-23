<?php
session_start();
if(isset($_SESSION['family_name_send'])):{//$_SESSION['family_name_send']に値が入っているとき

$family_name_return = $_SESSION['family_name_send']; //$family_name_kana_returnにセッション変数に入っている値を代入
$last_name_return = $_SESSION['last_name_send']; 
$family_name_kana_return = $_SESSION['family_name_kana_send'];
$last_name_kana_return = $_SESSION['last_name_kana_send']; 
$mail_return = $_SESSION['mail_send']; 
$password_return = $_SESSION['password_send']; 
$gender_return = $_SESSION['gender_send']; 
$postal_code_return = $_SESSION['postal_code_send']; 
$prefecture_return = $_SESSION['prefecture_send']; 
$address_1_return = $_SESSION['address_1_send']; 
$address_2_return = $_SESSION['address_2_send']; 
$authority_return = $_SESSION['authority_send'];
} 
?>
<?php endif;?>
<?php session_destroy();?><!--セッションの値破棄-->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'): {//POSTメソッドがリクエストがあったとき
    $family_name = $_POST['family_name'];//$family_nameに入力した値を代入
if($family_name === ""){//代入した値が空のとき
    $error1 = "名前（姓）が未入力です。"; //$error1にエラーメッセージを代入
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
$gender = $_POST['gender'];

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
$authority = $_POST['authority'];

if(!empty($family_name) && !empty($last_name) && !empty($family_name_kana) && !empty($last_name_kana) && !empty($mail) && !empty($password) && !empty($postal_code) && !empty($prefecture) && !empty($address_1) && !empty($address_2)){
    header("Location:http://localhost/registration/regist_confirm.php",true,307);//入力フォームが空じゃない時、POST形式でリダイレクト
}
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
        <li>その他</li>
        <li>
            <button onclick="location.href='regist.php'" class ="btn">アカウント登録</button>
        </li>
    </ul>
    <main>
        <h2>アカウント登録画面</h2>
        
            <form  name = "form" action = "regist.php" method = "POST">
                <ul class = "ul">
                    <li>
                        <label class = "form_name" id = "formname_1">名前（姓）</label>
                        <input type = "text" name = "family_name" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]{0,10}" value=<?php if(isset($family_name)){//$family_nameに値が入っている場合
                                                                                                                                    echo $family_name;//$family_nameを表示
                                                                                                                                }elseif(isset($family_name_return)){//$family_name_returnに値が入っているとき
                                                                                                                                    echo $family_name_return;//$family_name_returnを表示                                                                                                                             
                                                                                                                                }?>><!--漢字、ひらがな 10文字まで-->
                        <?php if(!empty($error1)):?>
                            <p class="text-danger"><?php echo $error1 ?></p><!--$error1が空じゃないときエラーメッセージ表示-->
                        <?php endif; ?>
                    </li>
                    <li> 
                        <label class = "form_name">名前（名）</label>
                        <input type = "text" name = "last_name" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]{0,10}" value = <?php if(isset($last_name)){
                                                                                                                                    echo $last_name;
                                                                                                                                }elseif(isset($last_name_return)){
                                                                                                                                    echo $last_name_return;                                                                                                                                 
                                                                                                                                }?>>
                        <?php if(!empty($error2)):?>
                            <p class="text-danger"><?php echo $error2 ?></p>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class = "form_name">カナ（姓）</label>
                        <input type = "text" name = "family_name_kana" class = "form_item" pattern="[\u30A1-\u30F6]{0,10}" value = <?php if(isset($family_name_kana)){
                                                                                                                                    echo $family_name_kana;
                                                                                                                                }elseif(isset($family_name_kana_return)){
                                                                                                                                    echo $family_name_kana_return;                                                                                                                                 
                                                                                                                                }?>><!--カタカナ 10文字まで-->
                        <?php if(!empty($error3)):?>
                            <p class="text-danger"><?php echo $error3 ?></p>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class = "form_name">カナ（名）</label>
                        <input type = "text" name = "last_name_kana" class = "form_item" pattern="[\u30A1-\u30F6]{0,10}" value = <?php if(isset($last_name_kana)){
                                                                                                                                    echo $last_name_kana;
                                                                                                                                }elseif(isset($last_name_kana_return)){
                                                                                                                                    echo $last_name_kana_return;                                                                                                                                 
                                                                                                                                }?>>
                        <?php if(!empty($error4)):?>
                            <p class="text-danger"><?php echo $error4 ?></p>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class = "form_name">メールアドレス</label>
                        <input type = "text" name = "mail" class = "form_item" maxlength = "100" pattern = "[0-9a-zA-Z_\.-]+@[0-9a-zA-Z_\.-]{0,100}" value = <?php if(isset($mail)){
                                                                                                                                    echo $mail;
                                                                                                                                }elseif(isset($mail_return)){
                                                                                                                                    echo $mail_return;                                                                                                                                 
                                                                                                                                }?>><!--半角英数字とハイフンと＠と＿とドット 100文字まで-->
                        <?php if(!empty($error5)):?>
                            <p class="text-danger"><?php echo $error5 ?></p>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class = "form_name">パスワード</label>
                        <input type = "text" name = "password" class = "form_item" pattern = "[0-9a-zA-Z]{0,10}" value = <?php if(isset($password)){
                                                                                                                                    echo $password;
                                                                                                                                }elseif(isset($password_return)){
                                                                                                                                    echo $password_return;                                                                                                                                 
                                                                                                                                }?>> <!--半角英数字10文字まで-->
                        <?php if(!empty($error6)):?>
                            <p class="text-danger"><?php echo $error6 ?></p>
                        <?php endif; ?>
                    </li>  
                    <li>
                        <label class = "form_name">性別</label>
                        <input type="radio" name="gender" value ="男" checked <?php if(isset($gender)){//$genderに値が入っていて、値が男の場合男を選択、そうじゃない場合何もしない
                                                                                        echo $gender == "男" ? "checked":"";
                                                                                    }elseif(isset($gender_return)){
                                                                                        echo $gender_return == "男" ? "checked":"";
                                                                                    }?>> 男
                        <input type="radio" name="gender" value ="女" <?php if(isset($gender)){
                                                                                echo $gender == "女" ? "checked":"";
                                                                            }elseif(isset($gender_return)){
                                                                                echo $gender_return == "女" ? "checked":"";
                                                                                                        }?>>女
                    </li> 
                    <li>  
                        <label class = "form_name">郵便番号</label>
                        <input type = "text" name = "postal_code" class = "form_item" maxlength = "7" pattern = "[0-9]{0,7}" value = <?php if(isset($postal_code)){
                                                                                                                                    echo $postal_code;
                                                                                                                                }elseif(isset($postal_code_return)){
                                                                                                                                    echo $postal_code_return;                                                                                                                                 
                                                                                                                                }?>><!--半角数字 7文字まで-->
                        <?php if(!empty($error7)):?>
                            <p class="text-danger"><?php echo $error7 ?></p>
                        <?php endif; ?>
                    </li>  
                    <li>
                        <label class = "form_name">住所（都道府県）</label>
                        <select class = "form_item" name="prefecture">
                            <option value = ""></option>
                            <option value="北海道"<?php if(isset($prefecture)){//$prefectureに値が入っていて、値が北海道の場合北海道を選択、そうじゃない場合何もしない
                                                            echo $prefecture == "北海道" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "北海道" ? "selected" :"";                                                       
                                                        }?>>北海道</option>
                            <option value="青森県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "青森県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "青森県" ? "selected" :"";                                                       
                                                        }?>>青森県</option>
                            <option value="岩手県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "岩手県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "岩手県" ? "selected" :"";                                                       
                                                        }?>>岩手県</option>
                            <option value="宮城県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "宮城県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "宮城県" ? "selected" :"";                                                       
                                                        }?>>宮城県</option>
                            <option value="秋田県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "秋田県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "秋田県" ? "selected" :"";                                                       
                                                        }?>>秋田県</option>
                            <option value="山形県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "山形県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "山形県" ? "selected" :"";                                                       
                                                        }?>>山形県</option>
                            <option value="福島県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "福島県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "福島県" ? "selected" :"";                                                       
                                                        }?>>福島県</option>
                            <option value="茨城県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "茨城県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "茨城県" ? "selected" :"";                                                       
                                                        }?>>茨城県</option>
                            <option value="栃木県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "栃木県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "栃木県" ? "selected" :"";                                                       
                                                        }?>>栃木県</option>
                            <option value="群馬県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "群馬県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "群馬県" ? "selected" :"";                                                       
                                                        }?>>群馬県</option>
                            <option value="埼玉県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "埼玉県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "埼玉県" ? "selected" :"";                                                       
                                                        }?>>埼玉県</option>
                            <option value="千葉県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "千葉県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "千葉県" ? "selected" :"";                                                       
                                                        }?>>千葉県</option>
                            <option value="東京都" <?php if(isset($prefecture)){
                                                            echo $prefecture == "東京都" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "東京都" ? "selected" :"";                                                       
                                                        }?>>東京都</option>
                            <option value="神奈川県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "神奈川県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "神奈川県" ? "selected" :"";                                                       
                                                        }?>>神奈川県</option>
                            <option value="新潟県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "新潟県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "新潟県" ? "selected" :"";                                                       
                                                        }?>>新潟県</option>
                            <option value="富山県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "富山県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "富山県" ? "selected" :"";                                                       
                                                        }?>>富山県</option>
                            <option value="石川県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "石川県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "石川県" ? "selected" :"";                                                       
                                                        }?>>石川県</option>
                            <option value="福井県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "福井県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "福井県" ? "selected" :"";                                                       
                                                        }?>>福井県</option>
                            <option value="山梨県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "山梨県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "山梨県" ? "selected" :"";                                                       
                                                        }?>>山梨県</option>
                            <option value="長野県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "長野県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "長野県" ? "selected" :"";                                                       
                                                        }?>>長野県</option>
                            <option value="岐阜県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "岐阜県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "岐阜県" ? "selected" :"";                                                       
                                                        }?>>岐阜県</option>
                            <option value="静岡県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "静岡県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "静岡県" ? "selected" :"";                                                       
                                                        }?>>静岡県</option>
                            <option value="愛知県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "愛知県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "愛知県" ? "selected" :"";                                                       
                                                        }?>>愛知県</option>
                            <option value="三重県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "三重県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "三重県" ? "selected" :"";                                                       
                                                        }?>>三重県</option>
                            <option value="滋賀県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "滋賀県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "滋賀県" ? "selected" :"";                                                       
                                                        }?>>滋賀県</option>
                            <option value="京都府" <?php if(isset($prefecture)){
                                                            echo $prefecture == "京都府" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "京都府" ? "selected" :"";                                                       
                                                        }?>>京都府</option>
                            <option value="大阪府" <?php if(isset($prefecture)){
                                                            echo $prefecture == "大阪府" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "大阪府" ? "selected" :"";                                                       
                                                        }?>>大阪府</option>
                            <option value="兵庫県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "兵庫県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "兵庫県" ? "selected" :"";                                                       
                                                        }?>>兵庫県</option>
                            <option value="奈良県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "奈良県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "奈良県" ? "selected" :"";                                                       
                                                        }?>>奈良県</option>
                            <option value="和歌山県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "和歌山県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "和歌山県" ? "selected" :"";                                                       
                                                        }?>>和歌山県</option>
                            <option value="鳥取県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "鳥取県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "鳥取県" ? "selected" :"";                                                       
                                                        }?>>鳥取県</option>
                            <option value="島根県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "島根県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "島根県" ? "selected" :"";                                                       
                                                        }?>>島根県</option>
                            <option value="岡山県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "岡山県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "岡山県" ? "selected" :"";                                                       
                                                        }?>>岡山県</option>
                            <option value="広島県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "広島県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "広島県" ? "selected" :"";                                                       
                                                        }?>>広島県</option>
                            <option value="山口県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "山口県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "山口県" ? "selected" :"";                                                       
                                                        }?>>山口県</option>
                            <option value="徳島県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "徳島県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "徳島県" ? "selected" :"";                                                       
                                                        }?>>徳島県</option>
                            <option value="香川県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "香川県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "香川県" ? "selected" :"";                                                       
                                                        }?>>香川県</option>
                            <option value="愛媛県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "愛媛県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "愛媛県" ? "selected" :"";                                                       
                                                        }?>>愛媛県</option>
                            <option value="高知県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "高知県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "高知県" ? "selected" :"";                                                       
                                                        }?>>高知県</option>
                            <option value="福岡県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "福岡県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "福岡県" ? "selected" :"";                                                       
                                                        }?>>福岡県</option>
                            <option value="佐賀県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "佐賀県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "佐賀県" ? "selected" :"";                                                       
                                                        }?>>佐賀県</option>
                            <option value="長崎県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "長崎県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "長崎県" ? "selected" :"";                                                       
                                                        }?>>長崎県</option>
                            <option value="熊本県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "熊本県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "熊本県" ? "selected" :"";                                                       
                                                        }?>>熊本県</option>
                            <option value="大分県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "大分県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "大分県" ? "selected" :"";                                                       
                                                        }?>>大分県</option>
                            <option value="宮崎県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "宮崎県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "宮崎県" ? "selected" :"";                                                       
                                                        }?>>宮崎県</option>
                            <option value="鹿児島県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "鹿児島県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "鹿児島県" ? "selected" :"";                                                       
                                                        }?>>鹿児島県</option>
                            <option value="沖縄県" <?php if(isset($prefecture)){
                                                            echo $prefecture == "沖縄県" ? "selected":"";
                                                        }elseif(isset($prefecture_return)){
                                                            echo $prefecture_return == "沖縄県" ? "selected" :"";                                                       
                                                        }?>>沖縄県</option>
                        </select>
                        <?php if(!empty($error8)):?>
                            <p class="text-danger"><?php echo $error8 ?></p>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class = "form_name">都道府県（市区町村）</label>
                        <input type = "text" name = "address_1" class = "form_item" pattern = "[\u30A1-\u30F6\u4E00-\u9FFF\u3040-\u309Fー0-9０-９\s-ー]{0,10}" value = <?php if(isset($address_1)){
                                                                                                                                    echo $address_1;
                                                                                                                                }elseif(isset($address_1_return)){
                                                                                                                                    echo $address_1_return;                                                                                                                                 
                                                                                                                                }?>><!--漢字ひらがな、カタカナ、数字、ハイフン、スペース　10文字-->
                        <?php if(!empty($error9)):?>
                            <p class="text-danger"><?php echo $error9 ?></p>
                        <?php endif; ?>
                    </li>                                       
                    <li>
                        <label class = "form_name">都道府県（番地）</label>
                        <input type = "text" name = "address_2" class = "form_item" pattern = "[\u30A1-\u30F6\u4E00-\u9FFF\u3040-\u309Fー0-9０-９\s-ー]{0,10}" value = <?php if(isset($address_2)){
                                                                                                                                    echo $address_2;
                                                                                                                                }elseif(isset($address_2_return)){
                                                                                                                                    echo $address_2_return;                                                                                                                                 
                                                                                                                                }?>>
                        <?php if(!empty($error10)):?>
                            <p class="text-danger"><?php echo $error10 ?></p>
                        <?php endif; ?>
                    </li>                                                       
                    <li>
                        <label class = "form_name">アカウント権限</label>
                        <select name = "authority">
                            <option value ="一般" <?php if(isset($authority)){
                                                            echo $authority == "一般" ? "selected":"";
                                                        }elseif(isset($authority_return)){
                                                            echo $authority_return == "一般" ? "selected" :"";                                                       
                                                        }?>>一般</option>
                            <option value="管理者" <?php if(isset($authority)){
                                                            echo $authority == "管理者" ? "selected":"";
                                                        }elseif(isset($authority_return)){
                                                            echo $authority_return == "管理者" ? "selected" :"";                                                       
                                                        }?>>管理者</option>
                        </select>
                    </li>
                    <li><input type = "submit" class = "submit" value="確認する"></li>
                </ul>       
            </form>          
     
    </main>
    <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
</body>
</html>    
