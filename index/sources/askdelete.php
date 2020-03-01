<?php
session_start();
include_once '../../meta/copyright/messageincode.html';
include_once '../../meta/sql/pdoconecction.php';
include_once '../../meta/securtity/checkifloggedin.php';
$mysqli = new mysqli("db1268.mydbserver.com", "p397345", "5PDgmzoV", "usr_p397345_5");
if($mysqli->connect_error) {
  exit('Could not connect');
}
$sql = "SELECT * FROM termine WHERE id = ".$_GET["q"];
foreach ($pdo->query($sql) as $row) {
  $id = $row["id"];
  $title = $row["title"];
}
if(!isset($id)) {
  exit('<span style="color: red;">ID nicht gefunden!</span>');
}
?>
<div style="width: 100%;">
  <hr>
  <h2><?php echo $title; ?></h2>
  <div>
    <span onclick='$("#limiter6").toggleClass("limiter-show");'>
      <button style="width: 49.5%; background-color: #388c3d; height: 5%; border:1px solid #000000;border-radius:0px;padding:8px 20px; color:#ffffff; display:inline-block; text-align:center;">Weiter behalten</button>
    </span>
    <a href="delete.php?valid=1&id=<?php echo $id; ?>">
      <button style="float: left; width: 49.5%; background-color: #ff5656; height: 5%; border:1px solid #000000;border-radius:0px;padding:8px 20px; color:#ffffff; display:inline-block; text-align:center;">Endgültig löschen</button>
    </a>
  </div>
</div>
