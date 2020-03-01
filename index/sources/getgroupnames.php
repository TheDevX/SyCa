<?php
include_once '../../meta/sql/pdoconecction.php';
// Array with names
$sql = "SELECT name, id FROM groups";
foreach ($pdo->query($sql) as $row) {
  $a[] = $row["name"];
}

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $sql = "SELECT id FROM groups WHERE name = '".$name."'";
                foreach ($pdo->query($sql) as $row) {
                  $id = $row["id"];
                }
                $hint = "<span onclick='GroupInfo($id)' class='w3-hover-text-blue w3-text-green'>".$name."</span>";
            } else {
                $sql = "SELECT id FROM users WHERE name = '".$name."'";
                foreach ($pdo->query($sql) as $row) {
                  $id = $row["id"];
                }
                $hint .= ", <a href='../groups/?id=".$id."' class='w3-hover-text-blue w3-text-green'>".$name."</a>";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "Ergebnis: <span class='w3-text-red'>Keine Übereinstimmung gefunden</span>" : "Ergebnis: ".$hint;
?>
