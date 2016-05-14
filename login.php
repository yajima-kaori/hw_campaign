<?php

require_once('config.php');
require_once('functions.php');

session_start();

if(!empty($_SESSION['id']))
{
  header('Location: lottery.php');
  exit;
}

<<<<<<< HEAD

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
   $dbh = connectDatabase();
   $sql = "select * from error_time where id = :id ";
   $stmt = $dbh->prepare($sql);
   $id = session_id();
   $stmt->bindParam(":id",$id);
   // var_dump($_SESSION['id']);

   $stmt->execute();

   $error_row = $stmt->fetch();
   var_dump($error_row);

   // var_dump($error_row);
   $error_time = strtotime($error_row['created_at'] . "+1 minute");

    var_dump($error_time);

   $check_time = strtotime(date('Y-m-d H:i:s'));
   var_dump($check_time);


      if(!empty($error_row) && $error_time < $check_time)
      {
               $dbh = connectDatabase();
               $id = session_id();
               $sql = "delete from error_time where id = :id";
               $stmt = $dbh->prepare($sql);
               $stmt->bindParam(":id", $id);
               $stmt->execute();
      }


   if(empty($error_row) || $error_time < $check_time)
    {

           $email = $_POST['email'];
           $password = $_POST['password'];
           $errors = array();

            if($email == '')
            {
              $errors['email'] = 'メールアドレスを入力してください';
            }
            if($password == '')
            {
              $errors['password'] = 'パスワードを入力してください';
            }

          if(empty($errors))
          {

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
          $errors_count = 1;
          $_SESSION['errors_count'] += $errors_count;
          // $error_time= time();
          // $_SESSION['error_time'] = $error_time;

          var_dump($_SESSION['errors_count']);
          // var_dump($error_time);
          // var_dump($_SESSION['error_time']);

               if($_SESSION['errors_count'] >= 2)
              {

               $dbh = connectDatabase();
               $now = date('Y-m-d H:i:s');
               $id = session_id();
               $sql = "insert into error_time(id,created_at) values(:id,:now)";
               $stmt = $dbh->prepare($sql);

               $stmt->bindParam(":id", $id);
               $stmt->bindParam(":now", $now);
               $stmt->execute();

               // $_SESSION['id'] = $id;
               // var_dump($id);
              }
          }

        }
      }
   else
   {
     $errors['message'] = '1分間ログインできません';
   }
=======
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
>>>>>>> origin/master


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
<<<<<<< HEAD
            <td><input type="text" name="email" class="inputStyle">
            <?php echo '<br>' . h($errors['email']) ?>
            </td>
          </tr>
          <tr>
            <td>結果確認用パスワード</td>
            <td><input type="text" name="password" class="inputStyle">
                <?php echo '<br>' . h($errors['password']) ?>
            </td>
=======
            <td><input type="text" name="email" class="inputStyle"></td>
          </tr>
          <tr>
            <td>結果確認用パスワード</td>
            <td><input type="text" name="password" class="inputStyle"></td>
>>>>>>> origin/master
         </tr>
         </table>
        <div class="submit">
        <input type="submit" value="結果確認">
      </div>
      </form>
    </body>
</html>