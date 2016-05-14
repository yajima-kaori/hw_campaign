<?php

session_start();

$_SESSION = array();

if(isset($_COOKIE[session_name()]))
{
  setcookie(session_name(),'',time()-86400);
}

session_destroy();

<<<<<<< HEAD
header('Location:login.php');
=======
header('Location: top.php');
>>>>>>> origin/master

?>