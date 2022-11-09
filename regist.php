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
        
            <form  class = "form" action = "regist_confirm.php" method = "POST">
                <ul class = "ul">
                    <li>
                        <labal>名前（姓）</label>
                        <input type = "text" name = "family_name" maxlength = "10" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*">
                        <span class = "alertarea"></span>
                    </li>
                    <li> 
                        <label>名前（名）</label>
                        <input type = "text" name = "last_name" maxlength = "10" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*">
                        <span class = "alertarea"></span>
                    </li>
                    <li>
                        <label>カナ（姓）</label>
                        <input type = "text" name = "family_name_kana" maxlength = "10" pattern="[\u30A1-\u30F6]*">
                        <span class = "alertarea"></span>
                    </li>
                    <li>
                        <label>カナ（名）</label>
                        <input type = "text" name = "last_name_kana" maxlength = "10" pattern="[\u30A1-\u30F6]*">
                        <span class = "alertarea"></span>
                    </li>
                    <li>
                        <label>メールアドレス</label>
                        <input type = "email" name = "mail" maxlength = "100">
                        <span class = "alertarea"></span>
                    </li>
                    <li>
                        <label>パスワード</label>
                        <input type = "password" name = "password" maxlength = "10">
                        <span class = "alertarea"></span>
                    </li>  
                    <li>
                        <label>性別</label>
                        <input type="radio" name="gender" value="0" checked> 男
                        <input type="radio" name="gender"value="1"> 女
                        <span class = "alertarea"></span>
                    </li> 
                    <li>  
                        <label>郵便番号</label>
                        <input type = "text" name = "postal_code" maxlength = "7">
                        <span class = "alertarea"></span>
                    </li>  
                    <li>
                        <label>住所（都道府県）</label>
                        <select class = "dropdown" name="prefecture">
                            <option></option>
                            <option value="1">北海道</option>
                            <option value="2">青森県</option>
                            <option value="3">岩手県</option>
                            <option value="4">宮城県</option>
                            <option value="5">秋田県</option>
                            <option value="6">山形県</option>
                            <option value="7">福島県</option>
                            <option value="8">茨城県</option>
                            <option value="9">栃木県</option>
                            <option value="10">群馬県</option>
                            <option value="11">埼玉県</option>
                            <option value="12">千葉県</option>
                            <option value="13">東京都</option>
                            <option value="14">神奈川県</option>
                            <option value="15">新潟県</option>
                            <option value="16">富山県</option>
                            <option value="17">石川県</option>
                            <option value="18">福井県</option>
                            <option value="19">山梨県</option>
                            <option value="20">長野県</option>
                            <option value="21">岐阜県</option>
                            <option value="22">静岡県</option>
                            <option value="23">愛知県</option>
                            <option value="24">三重県</option>
                            <option value="25">滋賀県</option>
                            <option value="26">京都府</option>
                            <option value="27">大阪府</option>
                            <option value="28">兵庫県</option>
                            <option value="29">奈良県</option>
                            <option value="30">和歌山県</option>
                            <option value="31">鳥取県</option>
                            <option value="32">島根県</option>
                            <option value="33">岡山県</option>
                            <option value="34">広島県</option>
                            <option value="35">山口県</option>
                            <option value="36">徳島県</option>
                            <option value="37">香川県</option>
                            <option value="38">愛媛県</option>
                            <option value="39">高知県</option>
                            <option value="40">福岡県</option>
                            <option value="41">佐賀県</option>
                            <option value="42">長崎県</option>
                            <option value="43">熊本県</option>
                            <option value="44">大分県</option>
                            <option value="45">宮崎県</option>
                            <option value="46">鹿児島県</option>
                            <option value="47">沖縄県</option>
                        </select>
                        <span class = "alertarea"></span>
                    </li>
                    <li>
                        <label>都道府県（市区町村）</label>
                        <input type = "text" name = "address_1" maxlength = "10" pattern="">
                        <span class = "alertarea"></span>
                    </li>                                       
                    <li>
                        <label>都道府県（番地）</label>
                        <input type = "text" name = "address_2" maxlength = "100" pattern="">
                        <span class = "alertarea"></span>
                    </li>                                                       
                    <li>
                        <label>アカウント権限</label>
                        <select class = "dropdown" name = "authority">
                            <option value ="0">一般</option>
                            <option value="1">管理者</option>
                        </select>
                    </li>
                    <li><input type = "submit" class = "submit" value="確認する"></li>
                </ul>       
            </form>          
     
    </main>
    <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
</body>
</html>    
