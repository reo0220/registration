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

if(empty($_POST['family_name'])){
    $login2 = "NULL";

    $param2 = $login2;
    $param_json2 = json_encode($param2);
}
?>
<?php
//session_destroy();
?>

<?php
try{
mb_internal_encoding("utf8");
$dbh = new PDO("mysql:dbname=registration;host=localhost;","root","root",//データベース接続
     array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//SQL実行失敗の時、例外をスロー
        PDO::ATTR_EMULATE_PREPARES => false,
          )   
    );
    $dbh -> exec("insert into users(family_name,last_name,family_name_kana,last_name_kana,mail,password,gender,postal_code,prefecture,address_1,address_2,authority,delete_flag)
values('".$_POST['family_name']."','".$_POST['last_name']."','".$_POST['family_name_kana']."','".$_POST['last_name_kana']."','".$_POST['mail']."','".password_hash($_POST['password'],PASSWORD_DEFAULT)."','".$_POST['gender']."','".$_POST['postal_code']."','".$_POST['prefecture']."','".$_POST['address_1']."','".$_POST['address_2']."','".$_POST['authority']."','0');");
}
 catch(PDOException $e){//DB接続エラーが発生した時$db_errorを定義
    $db_error = "エラーが発生したためアカウント登録できません。";
 }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" type = "text/css" href = "style2.css">
    <title>アカウント登録完了画面</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
            <script>
            var param = JSON.parse('<?php echo $param_json; ?>');
            var param2 = JSON.parse('<?php echo $param_json2; ?>');
            
            window.onload = function(){
                if(param == "0" ||  param == "NULL"){
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
                }else if(param == "1" && param2 == "NULL"){
                    Swal.fire({
                        title: 'エラーが発生しました。',
                        html : '「アカウント登録画面」からアカウント情報を入力して下さい。', 
                        type : 'warning',
                        bottons:true,
                        grow : 'fullscreen',
                        confirmButtonText:"アカウント登録",
                        allowOutsideClick:false
                    }).then((result) =>{
                        if(result.value){
                                window.location.href ="./regist.php";
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
    <h2 class = "h2">アカウント登録完了画面</h2>
    <main>
    <div align="center" class = "center">
         <h1> <?php
                if(isset($db_error)){
                    echo '<font color="red">';
                    echo $db_error;
                    echo '</font>';
                  }else{
                    echo "登録完了しました";
               }?>
          </h1>
    </div>   
    <div align ="center"><button onclick="location.href='index.php'" class ="btn" >TOPページへ戻る</button> </div>
    </main>
    <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
</body>

</html>