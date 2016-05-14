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
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $postal1 = $_POST['postal1'];
  $postal2 = $_POST['postal2'];
  $address = $_POST['address'];
  $agree = $_POST['agree'];
  $errors = array();

      if($name == '')
      {
        $errors['name'] = 'お名前を入力してください';
      }
      if($email == '')
      {
        $errors['email'] = 'メールアドレスを入力してください';
      }
      if($postal1 == '' || $postal2 == '')
      {
        $errors['postal_blank'] = '郵便番号を入力してください';
      }
      if(!is_numeric($postal1) || !is_numeric($postal2))
      {
        $errors['postal_num'] = '半角数字で入力してください';
      }
      if($address == '')
      {
        $errors['address'] = '住所を入力してください';
      }
      if($agree == '')
      {
        $errors['agree'] = 'チェックがされていません｡';
      }



      if(empty($errors))
      {
        $dbh = connectDatabase();
        $sql = "select * from users where email = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->execute();

        $row = $stmt->fetch();

        // var_dump($row['id']);
        $errors2 = array();


        if($row)
        {
          $errors2['email'] = 'すでに登録されたメールアドレスです!';
        }
        else
        {
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['postal1'] = $postal1;
            $_SESSION['postal2'] = $postal2;
            $_SESSION['address'] = $address;
            $_SESSION['agree'] = $agree;

          header('Location:completion.php');
          exit;
        }
      }

}

?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>応募フォーム画面</title>
      <link type="text/css" rel="stylesheet" href="css/reset.css">
      <link type="text/css" rel="stylesheet" href="css/style.css">
      <link type="text/css" rel="stylesheet" href="css/form.css">
    </head>
    <body>
      <div id="header"><h1>ドーナツがもらえるキャンペーン</h1></div>
      <form action="" method="post">
      <table>
      <tr>
        <td>お名前</td>
        <td><input type="text" name="name" class="inputStyle"
              <?php if(empty($errors['name'])) :?>
                value="<?php echo h($name) ?>"
              <?php endif;?>><br>
        <span><?php echo h($errors['name']) ?></span>
        </td>
      </tr>
      <tr>
        <td>メールアドレス</td>
        <td><input type="text" name="email" width="200px" class="inputStyle"
            <?php if(empty($errors['email'])) :?>
              value="<?php echo h($email) ?>"
            <?php endif;?>><br>
            <span><?php echo h($errors['email']) ?>
            <?php echo h($errors2['email']) ?></span>
        </td>
      </tr>
      <tr>
        <td>郵便番号</td>
        <td><input type="text" name="postal1" class="inputStyle_postal"
              <?php if(empty($errors['postal_blank'])) :?>
                value="<?php echo h($postal1) ?>"
              <?php endif;?>> -
              <input type="text" name="postal2" class="inputStyle_postal"
              <?php if(empty($errors['postal_blank'])) :?>
                value="<?php echo h($postal2) ?>"
              <?php endif;?>><br>
            <span><?php echo h($errors['postal_blank']) ?>
            <?php echo h($errors['postal_num']) ?></span>
        </td>
      </tr>
      <tr>
        <td>ご住所</td>
        <td><input type="text" name="address" class="inputStyle"
              <?php if(empty($errors['address'])) :?>
                value="<?php echo h($address) ?>"
              <?php endif;?>><br>
        <span><?php echo h($errors['address']) ?></span>
        </td>
      </tr>
      </table>

      <div class="kiyaku">
      <p>
      応募規約:<br>
      ドーナツは抽選で当たった方にプレゼントします｡
      </p>
      </div>

      <div class="agree">
      <input type="checkbox" name="agree">応募規約に同意する<br>
      <span><?php echo h($errors['agree']) ?></span>
      </div>

      <div class="submit">
      <input type="submit" value="上記内容でキャンペーンに応募する">
      </div>

      </form>
    </body>
</html>