<?php
include_once '../sql/pdoconecction.php';
$statement = $pdo->prepare("DELETE FROM notifications");
$statement->execute();
?>
