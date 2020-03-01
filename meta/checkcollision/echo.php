<?php
include_once '../sql/pdoconecction.php';
$sql = "SELECT * FROM notifications";
foreach ($pdo->query($sql) as $row) {
  echo "Level: ".$row["level"]." | Nachricht: ".$row["message"]." | Link: ".$row["link"]."</br>";
}
?>
