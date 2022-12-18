<?php
session_start();

var_dump($_SESSION['authority']);
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
//session_destroy();
?>

<!DOCTYPE html>
<html lang ="ja">
    <head>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
        <title>アカウント一覧画面</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
            <script>
            var param = JSON.parse('<?php echo $param_json; ?>');
            
            window.onload = function(){
                if(param == "0"  ||  param == "NULL"){
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
        <h2>アカウント一覧画面</h2>
        <main class = "itiran">
         <div align="center">
            <?php
                mb_internal_encoding("utf8");
                $dbh = new PDO("mysql:dbname=registration;host=localhost;","root","root");//データベース接続
                $sql = "SELECT * FROM users ORDER BY id DESC";//$sqlにIDの降順でusersデーブルの値を代入
                $stmt = $dbh->query($sql);//$stmtにIDの降順でusersデーブルの値を代入

                echo "<table border = '1' cellpadding='0' cellspacing='0'>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>名前(姓)</th>";
                echo "<th>名前(名)</th>";
                echo "<th>カナ(姓)</th>";
                echo "<th>カナ(名)</th>";
                echo "<th>メールアドレス</th>";
                echo "<th>性別</th>";
                echo "<th>アカウント権限</th>";
                echo "<th>削除フラグ</th>";
                echo "<th>登録日時</th>";
                echo "<th>更新日時</th>";
                echo "<th colspan='2'>操作</th>";
                echo "</tr>";
                
                foreach($stmt as $row){//ループ処理
                    echo "<tr>";
                    echo"<td>".$row['id']."</td>";
                    echo"<td>".$row['family_name']."</td>";
                    echo"<td>".$row['last_name']."</td>";
                    echo"<td>".$row['family_name_kana']."</td>";
                    echo"<td>".$row['last_name_kana']."</td>";
                    echo"<td>".$row['mail']."</td>";
                    echo"<td>";
                    if($row['gender'] === "0"){
                        echo "男";
                    }else{
                        echo "女";
                    }
                    echo "</td>";
                    echo"<td>";
                    if($row['authority'] === "0"){
                        echo "一般";
                    }else{
                        echo "管理者";
                    }
                    echo "</td>";
                    echo"<td>";
                    if($row['delete_flag'] === "0"){
                        echo "有効";
                    }else{
                        echo "無効";
                    }
                    echo "</td>";
                    echo"<td>".date('Y/m/d',strtotime($row['registered_time']))."</td>";
                    echo"<td>".date('Y/m/d',strtotime($row['update_time']))."</td>";
                    echo"<td>";
                    if($row['delete_flag']==="1"){
                        echo "<button><a href = 'list.php'>更新</a></button>";//削除フラグが有効な場合、「更新」「削除」画面へ移動できないようにする
                    }else{
                        echo "<button><a href = 'update.php?user_id=$row[id]'>更新</a></button>";//パラメータにidを渡す
                    }
                    echo "</td>";
                    echo"<td>";
                    if($row['delete_flag']==="1"){
                        echo "<button><a href = 'list.php'>削除</a></button>";
                    }else{
                        echo "<button><a href = 'delete.php?user_id=$row[id]'>削除</a></button>";//パラメータにidを渡す
                    }
                    echo "</td>";
                    echo "</tr>";

            };
            echo "</table>";
        ?>
        </div>
    </main>
    <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
</body>
</html>