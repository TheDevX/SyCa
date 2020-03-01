<?php
session_start();
include_once '../../meta/copyright/messageincode.html';
include_once '../../meta/sql/pdoconecction.php';
include_once '../../meta/securtity/checkifloggedin.php';
$mysqli = new mysqli("db1268.mydbserver.com", "p397345", "5PDgmzoV", "usr_p397345_5");
if($mysqli->connect_error) {
  exit('Could not connect');
}
?>
<p>Suchen:</p>
<input class="w3-input w3-border" type="text" onkeyup="showHint(this.value)">
<p><span id="txtHintgroup"></span></p>
<hr>
<ul>
  <?php
    $sql = "SELECT * FROM groups";
    foreach ($pdo->query($sql) as $row) {
      echo '<li onclick="GroupInfo('.$row["id"].')" class="w3-hover-text-blue" style="transition: .2s">'.$row["name"].'</li>';
    }
  ?>
</ul>