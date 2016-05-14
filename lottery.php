<?php

$random = rand(0,1);

// if($random == 1)
// {
//   echo 'あたり';
// }
// else
// {
//   echo 'はずれ';
// }

?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>抽選結果画面</title>
      <link type="text/css" rel="stylesheet" href="css/reset.css">
      <link type="text/css" rel="stylesheet" href="css/style.css">
      <link type="text/css" rel="stylesheet" href="css/completion.css">
    </head>
    <body>
    <div id="header"><h1>ドーナツがもらえるキャンペーン</h1></div>
    <div><p>キャンペーン結果</p>
    </div>
    <div>
    <span>
    <?php if($random == 1) :?>
      おめでとうございます!<br>
      当たりです!
    <?php else : ?>
      残念...ハズレです｡
    <?php endif; ?>
    </span>
      </div>
    </body>
</html>