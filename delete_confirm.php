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

if(empty($_POST['id'])){//ログインしていて「アカウント削除画面」から遷移していない状態
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
        <title>アカウント削除確認画面</title>
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
                }else if(param == "1" && param2 == "NULL"){//「管理者権限」でログインしているけど、アカウント削除画面から遷移していない時
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
        <h2>アカウント削除確認画面</h2>
        <main>
        <div align="center" class = "center2">
            <h1>本当に削除してよろしいですか？</h1>
        </div>
        <?php
           echo "<div class ='botton3'>"."<button><a href ='delete.php?user_id=$_POST[id]'>前に戻る</a></button>"."</div>";
        ?>
        <form method = "POST" action ="delete_complete.php">
            <input type = "submit" class = "botton2" value = "削除する">
            <input type = "hidden" value = "<?php echo $_POST['id'];?>" name = "id">
        </form>
        </main>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>


    </body>
 </html>    