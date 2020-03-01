<?php
if(isset($_GET["month"])){
  $month = $_GET["month"];
}
else{
  $month = date("m");
}
if(isset($_GET["year"])){
  $year = $_GET["year"];
}
else{
  $year = date("Y");
}
if(isset($_GET["action"])){
  if($_GET["action"] == "showspecialpersons"){
    $users = array();
    $sql = "SELECT * FROM users";
    foreach ($pdo->query($sql) as $row) {
      if(isset($_POST["idtoshow".$row["id"]])){
        if($_POST["idtoshow".$row["id"]] == "on"){
          $users[] = $row["id"];
        }
      }
    }
    $showusersinkalender = implode(",", $users);
    if(empty($showusersinkalender)){
      $showusersinkalender = $_SESSION["userid"];
    }
    else{
      $showusersinkalender .= $_SESSION["userid"];
    }
    $_SESSION["showusersinkal"] = $showusersinkalender;
  }
}
date_default_timezone_set("Europe/Berlin");
?>
