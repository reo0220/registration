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

$id = $_POST['id'];
$family_name = $_POST['family_name'];
$last_name = $_POST['last_name'];
$family_name_kana = $_POST['family_name_kana'];
$last_name_kana = $_POST['last_name_kana'];
$mail = $_POST['mail'];
$gender = $_POST['gender'];
$prefecture = $_POST['prefecture'];
$postal_code = $_POST['postal_code'];
$address_1 = $_POST['address_1'];
$address_2 = $_POST['address_2'];
$authority = $_POST['authority'];



try{
    mb_internal_encoding("utf8");
    $dbh = new PDO("mysql:dbname=registration;host=localhost;","root","root",//データベース接続
        array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//SQL実行失敗の時、例外をスロー
                PDO::ATTR_EMULATE_PREPARES => false,
            )   
    );
    
    $sql = "SELECT * FROM users WHERE id = $id";
    $stmt = $dbh ->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(password_verify($_POST['password'], $result['password'])){
        $password = $result['password'];
    }else{
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    } 

    $sql1 = "UPDATE users SET family_name = '$family_name',last_name = '$last_name',family_name_kana = '$family_name_kana',last_name_kana = '$last_name_kana',mail = '$mail',password = '$password',gender = '$gender',postal_code = '$postal_code',prefecture = '$prefecture',address_1 = '$address_1',address_2 = '$address_2',authority = '$authority' WHERE id = '$id'";
    $dbh -> exec($sql1);
 
}
    catch(PDOException $e){//DB接続エラーが発生した時$db_errorを定義
                            $db_error = "エラーが発生したためアカウント更新できません。";
                        }
?>

<!DOCTYPE html>
<html lang ="ja">
    <head>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
        <title>アカウント更新完了</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
            <script>
            var param = JSON.parse('<?php echo $param_json; ?>');
            
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
        <h2>アカウント更新完了画面</h2>
        <main>
            <div align="center" class = "center2">
                <h1> <?php
                        if(isset($db_error)){
                            echo '<font color="red">';
                            echo $db_error;
                            echo '</font>';
                        }else{
                            echo "更新完了しました";
                        }?>
                </h1>
    </div>   
    <div align ="center"><button onclick="location.href='index.php'" class ="btn" >TOPページへ戻る</button> </div>

        </main>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>




        </body>
 </html>    