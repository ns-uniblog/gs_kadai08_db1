<?php
// DB接続
try {
    $db_name =  'uniblog_gs_kadai08_db1';            //データベース名
    $db_host =  'localhost';  //DBホスト
    $db_id =    'root';                //アカウント名(登録しているドメイン)
    $db_pw =    '';           //さくらサーバのパスワード
    
    $server_info = 'mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
    $pdo = new PDO($server_info, $db_id, $db_pw);
    
} catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
}

// データ削除SQL
$sql = "DELETE FROM uniblog_gs_kadai08_db1_table1";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); // 実行

// 削除後の処理
if($status == false) {
    $error = $stmt->errorInfo();
    exit("SQL Error:".$error[2]);
} else {
    header("Location: index.php"); // index.phpにリダイレクト
    exit();
}
?>
