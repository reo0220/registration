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
?>

<?php
    $id = $_POST['id'];
    try{
        mb_internal_encoding("utf8");
        $dbh = new PDO("mysql:dbname=registration;host=localhost;","root","root",
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//SQL実行失敗の時、例外をスロー
                    PDO::ATTR_EMULATE_PREPARES => false,
                    )   
                );
                 $sql = "UPDATE users SET delete_flag = 1 WHERE id= $id";
                 $stmt = $dbh->query($sql);
        }
        catch(PDOException $e){//DB接続エラーが発生した時$db_errorを定義
            $db_error = "エラーが発生したためアカウント削除できません。";
            }
             ?>  

<!DOCTYPE html>
<html lang ="ja">
    <head>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
        <title>アカウント削除完了画面</title>
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
        <h2>アカウント削除完了画面</h2>
        <main>
            <div align="center" class = "center2">
                <h1> 
                    <?php
                    if(isset($db_error)){
                        echo '<font color="red">';
                        echo $db_error;
                        echo '</font>';
                    }else{
                        echo "削除完了しました";
                }?>
                </h1>
            </div>   
            <div align ="center"><button onclick="location.href='index.php'" class ="btn" >TOPページへ戻る</button> </div>
        </main>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>


        </body>
 </html>    