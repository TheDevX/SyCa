<?php
if(isset($_SESSION["username"])){
  if(isset($_SESSION["userpassword"])){
    if(isset($_SESSION["userid"])){
      $loggedin = TRUE;
    }
  }
}
if(!isset($loggedin)){
  die('<meta http-equiv="refresh" content="0; URL=../login">');
}
?>
