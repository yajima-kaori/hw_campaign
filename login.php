<?php

require_once('config.php');
require_once('functions.php');

session_start();

if(!empty($_SESSION['id']))
{
  header('Location: lottery.php');
  exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
 $email = $_POST['email'];
 $password = $_POST['password'];

 $dbh = connectDatabase();
 $sql = "select * from users where email = :email and password = :password";
 $stmt = $dbh->prepare($sql);
 $stmt->bindParam(":email",$email);
 $stmt->bindParam(":password",$password);
 $stmt->execute();

 $row = $stmt->fetch();

 // var_dump($row);

 $errors = array();

  if($row)
  {
    $_SESSION['id'] = $row['id'];
    header('Location: lottery.php');
    exit;
  }
  else
  {
    $errors['message'] ='ログインに失敗しました｡';
  }


}

?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>抽選結果ログイン画面</title>
      <link type="text/css" rel="stylesheet" href="css/reset.css">
      <link type="text/css" rel="stylesheet" href="css/style.css">
      <link type="text/css" rel="stylesheet" href="css/form.css">
      <link type="text/css" rel="stylesheet" href="css/login.css">
    </head>
    <body>
    <div id="header"><h1>ドーナツがもらえるキャンペーン</h1></div>
      <?php echo h($errors['message']); ?>
      <form action="" method="post">
          <table>
          <tr>
            <td>メールアドレス</td>
            <td><input type="text" name="email" class="inputStyle"></td>
          </tr>
          <tr>
            <td>結果確認用パスワード</td>
            <td><input type="text" name="password" class="inputStyle"></td>
         </tr>
         </table>
        <div class="submit">
        <input type="submit" value="結果確認">
      </div>
      </form>
    </body>
</html>