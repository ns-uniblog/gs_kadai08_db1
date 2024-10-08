<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// POSTデータ取得
$date = date("Y-m-d H:i:s");
$name = $_POST["name"];
$email = $_POST["email"];
$order_pasta = $_POST["order_pasta"];
$order_pizza = $_POST["order_pizza"];
$order_curry = $_POST["order_curry"];
$memo = $_POST["memo"];

// DB接続
try {
    $db_name =  'uniblog_gs_kadai08_db1';            //データベース名
    $db_host =  'localhost';  //DBホスト
    $db_id =    'root';                //アカウント名(登録しているドメイン)
    $db_pw =    '';           //さくらサーバのパスワード

    $server_info = 'mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
    $pdo = new PDO($server_info, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

// データ登録SQL作成
$sql = "INSERT INTO uniblog_gs_kadai08_db1_table1(date, name, email, order_pasta, order_pizza, order_curry, memo) VALUES(:date, :name, :email, :order_pasta, :order_pizza, :order_curry, :memo)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':order_pasta', $order_pasta, PDO::PARAM_INT);
$stmt->bindValue(':order_pizza', $order_pizza, PDO::PARAM_INT);
$stmt->bindValue(':order_curry', $order_curry, PDO::PARAM_INT);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQL Error:".$error[2]);
} else {
    header("Location: index.php");
    exit();
}
?>
