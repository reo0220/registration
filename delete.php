<?php
session_start();

if(isset($_SESSION['authority'])){
$login = $_SESSION['authority'];

$param = $login;
$param_json = json_encode($param);

}elseif(empty($_SESSION['authority'])){
    $login = "NULL";

    $param = $login;
    $param_json = json_encode($param);
}

if(empty($_GET["user_id"])){//ログインしていて「アカウント一覧画面」から遷移していない状態
    $login2 = "NULL";

    $param2 = $login2;
    $param_json2 = json_encode($param2);
}

?>

<!DOCTYPE html>
<html lang ="ja">
    <head>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
        <title>アカウント削除画面</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
            <script>
            var param = JSON.parse('<?php echo $param_json; ?>');
            var param2 = JSON.parse('<?php echo $param_json2; ?>');
            
            window.onload = function(){
                if(param == "0" ||  param == "NULL"){//ログインしていないか、一般権限の時
                    Swal.fire({
                        title: '権限がないためエラーが発生しました。',
                        html : 'ログインをしていない方は「ログイン」ボタンからログインして下さい。', 
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
                }else if(param == "1" && param2 == "NULL"){//「管理者権限」でログインしているけど、アカウント一覧画面から遷移していない時
                    Swal.fire({
                        title: 'エラーが発生しました。',
                        html : '「アカウント一覧画面」から削除するアカウントを選択して下さい。', 
                        type : 'warning',
                        bottons:true,
                        grow : 'fullscreen',
                        confirmButtonText:"アカウント一覧",
                        allowOutsideClick:false
                    }).then((result) =>{
                        if(result.value){
                                window.location.href ="./list.php";
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
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);//カラム名で添字付けた配列を返す
            ?>    
           <ul class ="ul">
                <li>
                    <label class ="form_name">名前（姓）</label>
                    <p><?php echo $result['family_name'];?></p><!--$resultの配列に入ってるfamily_nameカラムの値を出力-->
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
                        for($i = 0;$i < mb_strlen($result['password']);$i++){ //最大文字数10文字分●表示
                            if($i == 10){
                                break;
                            }else{
                                echo "●";
                            } 
                        };?></p>
                </li>
                <li>
                    <label class ="form_name">性別</label>
                    <p><?php if($result['gender'] === "0"){
                                        echo "男";
                                }else{
                                        echo "女";
                                };?></p>
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
                    <p><?php if($result['authority'] === "0"){
                                        echo "一般";
                                }else{
                                        echo "管理者";
                                };?></p>
                </li>
            </ul>
            <form align="center" method = "POST" action ="delete_confirm.php">
                <input type = "submit" class = "botton2" value = "確認する">
                <input type = "hidden" value = "<?php echo $result['id'];?>" name ="id" >
            </form>    

        </main>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>

    </body>
 </html>    