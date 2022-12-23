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

<!DOCTYPE html>
<html lang ="ja">
    <head>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
        <title>アカウント一覧画面</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
            <script>
                //選択されている時クリックすると選択が外れる
                var remove = 0;
                function radioDeselection(already, numeric) {
                    if(remove == numeric) {
                        already.checked = false;
                        remove = 0;
                    }else{
                        remove = numeric;
                    }
                }
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
                        }).then((result) =>{//「ログイン」ボタンをクリックした時、ログイン画面へ遷移
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
                    <form class = "list_form" action = "list.php" method = "POST">
                        <table border = '1' cellpadding='0' cellspacing='0' width = "1000px">
                        <tr>
                            <td><label>名前(姓)</label></td>
                            <td><input class = "list_input"type = "text" name = "family_name" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]{0,10}"></td>
                            <td><label>名前(名)</label></td>
                            <td><input class = "list_input" type = "text" name = "last_name" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]{0,10}"></td>
                        </tr> 
                        <tr>
                            <td><label>カナ（姓）</label></td>
                            <td><input class = "list_input" type = "text" name = "family_name_kana" pattern="[\u30A1-\u30F6]{0,10}"></td>
                            <td><label>カナ（名）</label></td>
                            <td><input class = "list_input" type = "text" name = "last_name_kana" pattern="[\u30A1-\u30F6]{0,10}"></td>
                        </tr>   
                        <tr>
                            <td><label>メールアドレス</label></td>
                            <td><input class = "list_input" type = "text" name = "mail" maxlength = "100"></td>
                            <td><label>性別</label></td>
                            <td>
                                <input type = "radio" name = "gender" value = "男" onclick="radioDeselection(this, 1)">男
                                <input type = "radio" name = "gender" value = "女"onclick="radioDeselection(this, 2)">女
                            </td>
                        </tr>
                        <tr>
                            <td><label>アカウント権限</label></td>
                            <td>
                                <select class = "list_pull"name = "authority">
                                    <option value = ""></option>
                                    <option value = "一般">一般</option>
                                    <option value = "管理者">管理者</option>
                                </select> 
                            </td>  
                            <td colspan='2'></td>
                        </tr>
                    </table>
                    <input class = "kennsaku_botton" type = "submit" value = "検索">
                </form>      
            
                
                <?php
                    if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    
                        //検索されたデータを変数に格納
                        $family_name = $_POST['family_name'];
                        $family_name2 = '%'.$_POST['family_name'].'%';
                        $last_name = $_POST['last_name'];
                        $last_name2 = '%'.$_POST['last_name'].'%';
                        $family_name_kana = $_POST['family_name_kana'];
                        $family_name_kana2 = '%'.$_POST['family_name_kana'].'%';
                        $last_name_kana = $_POST['last_name_kana'];
                        $last_name_kana2 = '%'.$_POST['last_name_kana'].'%';
                        $mail = $_POST['mail'];
                        $mail2 = '%'.$_POST['mail'].'%';
                        
                        if(empty($_POST['gender'])){//性別が何も選択していない時
                            $gender = "NULL";
                        }elseif($_POST['gender'] === "男"){
                            $gender = "0";
                        }elseif($_POST['gender'] === "女"){
                            $gender = "1";
                        }

                        if($_POST['authority'] === "一般"){
                            $authority = "0";
                        }elseif($_POST['authority'] === "管理者"){
                            $authority = "1";
                        }else{
                            $authority = "NULL";
                        }
                
                        mb_internal_encoding("utf8");
                        $dbh = new PDO("mysql:dbname=registration;host=localhost;","root","root");
                        
                        //全ての項目が空欄の時全てのデータをセレクト
                        if(empty($family_name) && empty($last_name) && empty($family_name_kana) && empty($last_name_kana) && empty($mail) && $gender === "NULL" && $authority === "NULL"){
                            $sql = "SELECT * FROM users ORDER BY id DESC";
                            $stmt = $dbh->query($sql);
                            $counts = $dbh->query('SELECT COUNT(*) as cnt FROM users');
                            $count = $counts->fetch();//データ件数
                        //性別と権限が選択されていないかつ、他の項目が一つでも入力されているとき  
                        }elseif((isset($family_name) || isset($last_name) || isset($family_name_kana) || isset($last_name_kana) || isset($mail)) && ($gender === "NULL" && $authority === "NULL")){
                            $sql = "SELECT * FROM users WHERE family_name like '%".$family_name."%' && last_name like '%".$last_name."%' && family_name_kana like '%".$family_name_kana."%' && last_name_kana like '%".$last_name_kana."%' && mail like '%".$mail."%' ORDER BY id DESC" ;
                            $stmt = $dbh->query($sql);
                            $counts = $dbh->query("SELECT COUNT(*) as cnt FROM users WHERE family_name like '%".$family_name."%' && last_name like '%".$last_name."%' && family_name_kana like '%".$family_name_kana."%' && last_name_kana like '%".$last_name_kana."%' && mail like '%".$mail."%'");
                            $count = $counts->fetch();
                        //権限が選択されていなかつ、他の項目が一つでも入力されているとき
                        }elseif((isset($family_name) || isset($last_name) || isset($family_name_kana) || isset($last_name_kana) || isset($mail) || $gender != "NULL") && ($authority === "NULL")){
                            $sql = "SELECT * FROM users WHERE family_name like '%".$family_name."%' && last_name like '%".$last_name."%' && family_name_kana like '%".$family_name_kana."%' && last_name_kana like '%".$last_name_kana."%' && mail like '%".$mail."%' && gender = '$gender' ORDER BY id DESC" ;     
                            $stmt = $dbh->query($sql);    
                            $counts = $dbh->query("SELECT COUNT(*) as cnt FROM users WHERE family_name like '%".$family_name."%' && last_name like '%".$last_name."%' && family_name_kana like '%".$family_name_kana."%' && last_name_kana like '%".$last_name_kana."%' && mail like '%".$mail."%' && gender = '$gender'");
                            $count = $counts->fetch();
                        //性別が選択されていなかつ、他の項目が一つでも入力されているとき
                        }elseif((isset($family_name) || isset($last_name) || isset($family_name_kana) || isset($last_name_kana) || isset($mail) || $authority != "NULL") && ($gender === "NULL")){
                            $sql = "SELECT * FROM users WHERE family_name like '%".$family_name."%' && last_name like '%".$last_name."%' && family_name_kana like '%".$family_name_kana."%' && last_name_kana like '%".$last_name_kana."%' && mail like '%".$mail."%' && authority = '$authority' ORDER BY id DESC" ;
                            $stmt = $dbh->query($sql);
                            $counts = $dbh->query("SELECT COUNT(*) as cnt FROM users WHERE family_name like '%".$family_name."%' && last_name like '%".$last_name."%' && family_name_kana like '%".$family_name_kana."%' && last_name_kana like '%".$last_name_kana."%' && mail like '%".$mail."%' && authority = '$authority'");
                            $count = $counts->fetch();
                        //性別と権限両方が選択されているかつ他の項目が一つでも入力されているとき
                        }else{
                            $sql = "SELECT * FROM users WHERE family_name like '%".$family_name."%' && last_name like '%".$last_name."%' && family_name_kana like '%".$family_name_kana."%' && last_name_kana like '%".$last_name_kana."%' && mail like '%".$mail."%' && gender = '$gender' && authority = '$authority' ORDER BY id DESC" ;
                            $stmt = $dbh->query($sql);
                            $counts = $dbh->query("SELECT COUNT(*) as cnt FROM users WHERE family_name like '%".$family_name."%' && last_name like '%".$last_name."%' && family_name_kana like '%".$family_name_kana."%' && last_name_kana like '%".$last_name_kana."%' && mail like '%".$mail."%' && gender = '$gender' && authority = '$authority'");
                            $count = $counts->fetch();
                        }
                        
                        //検索結果がない場合、該当するユーザーが存在しません。sと表示
                        if(empty($count['cnt'])){
                            echo "<h2>該当するユーザーが存在しません。</h2>";
                        }else{
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

                }
                echo "</table>";
            }
        }
            ?>
        </div>
    </main>
    <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
</body>
</html>