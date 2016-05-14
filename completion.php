<?php

  require_once('config.php');
  require_once('functions.php');

  session_start();

  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
  $email = $_SESSION['email'];
  $postal1 = $_SESSION['postal1'];
  $postal2 = $_SESSION['postal2'];
  $address = $_SESSION['address'];
  $agree = $_SESSION['agree'];

  $password = rand(1111111,9999999);

  $dbh = connectDatabase();
  $sql = "insert into users(name,email,postal1,postal2,address,agree,password) values
         (:name,:email,:postal1,:postal2,:address,:agree,:password)";
  $stmt = $dbh->prepare($sql);

  $stmt->bindParam(":name",$name);
  $stmt->bindParam(":email",$email);
  $stmt->bindParam(":postal1",$postal1);
  $stmt->bindParam(":postal2",$postal2);
  $stmt->bindParam(":address",$addess);
  $stmt->bindParam(":agree",$agree);
  $stmt->bindParam(":password",$password);


  $stmt->execute();

?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>完了画面</title>
      <link type="text/css" rel="stylesheet" href="css/reset.css">
      <link type="text/css" rel="stylesheet" href="css/style.css">
      <link type="text/css" rel="stylesheet" href="css/completion.css">

    </head>
    <body>
    <div id="header"><h1>ドーナツがもらえるキャンペーン</h1></div>
    <div><p>ご応募ありがとうございます｡<br>
      結果確認用のパスワードをお控えください｡</p>
    </div>
    <div>
    結果確認用パスワード:<br>
    <span><?php echo $password; ?></span>
    </div>
    </body>
</html>