<?php
session_start();
include_once '../../meta/copyright/messageincode.html';
include_once '../../meta/sql/pdoconecction.php';
include_once '../../meta/securtity/checkifloggedin.php';
$mysqli = new mysqli("db1268.mydbserver.com", "p397345", "5PDgmzoV", "usr_p397345_5");
if($mysqli->connect_error) {
  exit('Could not connect');
}
echo var_dump($_GET["q"]);
$ids = "";
$strlen = strlen($_GET["q"]);
for ($n=0; $n < $strlen; $n=$n+2) {
  $ids .= substr($_GET["q"], $n, 1);
}
echo $ids;
$edituser1 = array();
$readuser1 = array();
$sql = "SELECT * FROM termine WHERE id = ".$ids[0];
foreach ($pdo->query($sql) as $row) {
  $id1 = $row["id"];
  $title1 = $row["title"];
  $note1 = $row["note"];
  $location1 = $row["location"];
  $start_time1 = $row["start_time"];
  $end_time1 = $row["end_time"];
  $full_day1 = $row["full_day"];
  $created_by_id1 = $row["created_by_id"];
  $edit_allowed_for1 = $row["edit_allowed_for"];
  $read_allowed_for1 = $row["read_allowed_for"];
  $created_at1 = $row["created_at"];
  $edituser1 = explode(",",$edit_allowed_for1);
  $readuser1 = explode(",",$read_allowed_for1);
}
$edituser2 = array();
$readuser2 = array();
$sql = "SELECT * FROM termine WHERE id = ".$ids[1];
foreach ($pdo->query($sql) as $row) {
  $id2 = $row["id"];
  $title2 = $row["title"];
  $note2 = $row["note"];
  $location2 = $row["location"];
  $start_time2 = $row["start_time"];
  $end_time2 = $row["end_time"];
  $full_day2 = $row["full_day"];
  $created_by_id2 = $row["created_by_id"];
  $edit_allowed_for2 = $row["edit_allowed_for"];
  $read_allowed_for2 = $row["read_allowed_for"];
  $created_at2 = $row["created_at"];
  $edituser2 = explode(",",$edit_allowed_for2);
  $readuser2 = explode(",",$read_allowed_for2);
}
?>
<div class="w3-half w3-container w3-border w3-pale-red w3-border-red w3-hover-red w3-hover-border-black w3-display-container" style="transition: .2s;">
  <?php
  echo "<h3>".$title1."</h3>"; if(in_array($_SESSION["userid"], $edituser1) || $_SESSION["userrang"] >= 2){echo '<a href="edit.php?id='.$id1.'&month='.$month.'&year='.$year.'"><span class="w3-display-topright w3-margin"><i class="far fa-edit"></i></span></a>';}
  echo "<br>";
  if($full_day1 == 1){
    if(!empty($start_time1) and !empty($end_time1)){
      if(date("d.m Y", strToTime($start_time1)) != date("d.m Y", strToTime($end_time1))){
        echo '<p><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i>'.date("d.m Y", strToTime($start_time1)).' -  '.date("d.m Y", strToTime($end_time1)).'// Ganztägig</p>';
      }
      else{
        echo '<p><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i>'.date("d.m Y", strToTime($start_time1)).' // Ganztägig</p>';
      }
    }
  }
  else {
    if(!empty($start_time1) and !empty($end_time1)){ ?> <p><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo date("d.m Y // H:i", strToTime($start_time1)).' - ';
      if(date("d.m Y", strToTime($start_time1)) != date("d.m Y", strToTime($end_time1))){
        echo date("d.m Y // H:i", strToTime($end_time1));
      }
      else{
        echo date("H:i", strToTime($end_time1)); ?></p>
        <?php
      }
    }
  }
  ?>
</div>
<div class="w3-half w3-container w3-border w3-pale-red w3-border-red w3-hover-red w3-hover-border-black w3-display-container" style="transition: .2s;">
  <?php
  echo "<h3>".$title2."</h3>"; if(in_array($_SESSION["userid"], $edituser2) || $_SESSION["userrang"] >= 2){echo '<a href="edit.php?id='.$id2.'&month='.$month.'&year='.$year.'"><span class="w3-display-topright w3-margin"><i class="far fa-edit"></i></span></a>';}
  echo "<br>";
  if($full_day2 == 1){
    if(!empty($start_time2) and !empty($end_time2)){
      if(date("d.m Y", strToTime($start_time2)) != date("d.m Y", strToTime($end_time2))){
        echo '<p><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i>'.date("d.m Y", strToTime($start_time2)).' -  '.date("d.m Y", strToTime($end_time2)).'// Ganztägig</p>';
      }
      else{
        echo '<p><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i>'.date("d.m Y", strToTime($start_time2)).' // Ganztägig</p>';
      }
    }
  }
  else {
    if(!empty($start_time2) and !empty($end_time2)){ ?> <p><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo date("d.m Y // H:i", strToTime($start_time2)).' - ';
      if(date("d.m Y", strToTime($start_time2)) != date("d.m Y", strToTime($end_time2))){
        echo date("d.m Y // H:i", strToTime($end_time2));
      }
      else{
        echo date("H:i", strToTime($end_time2)); ?></p>
        <?php
      }
    }
  }
  ?>
</div>
