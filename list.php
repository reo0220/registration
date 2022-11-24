<!DOCTYPE html>
<html lang ="ja">
    <head>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
        <title>アカウント一覧画面</title>
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
        <main>
            <?php
                mb_internal_encoding("utf8");
                $dbh = new PDO("mysql:dbname=registration;host=localhost;","root","root");//データベース接続
                $sql = "SELECT * FROM users ORDER BY id DESC";//$sqlにIDの降順でusersデーブルの値を代入
                $stmt = $dbh->query($sql);

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
                
                foreach($stmt as $row){
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
                        echo "無効";
                    }else{
                        echo "有効";
                    }
                    echo "</td>";
                    echo"<td>".$row['registered_time']."</td>";
                    echo"<td>".$row['update_time']."</td>";
                    echo"<td>";
                    echo "<button onclick=location.href='update.php'' class ='btn'>"."更新"."</button>";
                    echo "</td>";
                    echo"<td>";
                    echo "<button onclick='location.href='delete.php'' class ='btn'>削除</button>";
                    echo "</td>";
                    echo "</tr>";

            };
            echo "</table>";
?>

        </main>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
    </body>
</html>