<?php
session_start();
include_once '../../meta/copyright/messageincode.html';
include_once '../../meta/sql/pdoconecction.php';
include_once '../../meta/securtity/checkifloggedin.php';
$mysqli = new mysqli("db1268.mydbserver.com", "p397345", "5PDgmzoV", "usr_p397345_5");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$edituser = array();
$readuser = array();
$sql = "SELECT * FROM termine WHERE id = ".$_GET["q"];
foreach ($pdo->query($sql) as $row) {
  $id = $row["id"];
  $title = $row["title"];
  $note = $row["note"];
  $location = $row["location"];
  $start_time = $row["start_time"];
  $end_time = $row["end_time"];
  $full_day = $row["full_day"];
  $created_by_id = $row["created_by_id"];
  $edit_allowed_for = $row["edit_allowed_for"];
  $read_allowed_for = $row["read_allowed_for"];
  $created_at = $row["created_at"];
  $color = $row["color"];
  $edituser = explode(",",$edit_allowed_for);
  $readuser = explode(",",$read_allowed_for);
}
if(!isset($id)) {
  exit('<span style="color: red;">ID nicht gefunden!</span>');
}
?>
<div style="width: 100%;">
<div style="width: 100%; height: 1px; margin-top: 10px;" class="w3-<?php echo $color; ?> w3-border-<?php echo $color; ?>"></div>
<h2><?php echo $title; ?></h2>
  <div class="w3-container">
    <?php if(!empty($note)){ ?> <p><i class="fa fa-sticky-note fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $note; ?></p><hr> <?php } ?>
    <?php if(!empty($location)){ ?> <p><i class="fa fa-map-marker fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $location ?></p><hr><a href="https://www.google.de/maps/search/<?php echo $location; ?>" style="text-decoration: none;" target="_blank" class="w3-hover-text-blue"><p><i>"<?php echo $location ?>" in Google Maps öffnen</i></p></a> <?php } ?>
    <?php if($full_day == 1){
    if(!empty($start_time) and !empty($end_time)){
      if(date("d.m Y", strToTime($start_time)) != date("d.m Y", strToTime($end_time))){
        echo '<p><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i>'.date("d.m Y", strToTime($row["start_time"])).' -  '.date("d.m Y", strToTime($row["end_time"])).'// Ganztägig</p>';
      }
      else{
        echo '<p><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i>'.date("d.m Y", strToTime($row["start_time"])).' // Ganztägig</p>';
      }
    }
  }
  else {
    if(!empty($start_time) and !empty($end_time)){ ?> <p><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo date("d.m Y // H:i", strToTime($row["start_time"])).' - ';
      if(date("d.m Y", strToTime($start_time)) != date("d.m Y", strToTime($end_time))){
        echo date("d.m Y // H:i", strToTime($row["end_time"]));
      }
      else{
        echo date("H:i", strToTime($row["end_time"])); ?></p>
<?php }
    }
  } ?>
    <?php
      if($_SESSION["userrang"] >= 2){
        ?>
        <hr>
        <p class="w3-large"><b><i class="fa fa-info fa-fw w3-margin-right w3-text-teal"></i>Weitere Infos</b></p>
        <p><i class="fa fa-plus-circle fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo date("d.m Y ", strToTime($created_at)); ?></p>
        <p><i class="fa fa-plus-square fa-fw w3-margin-right w3-large w3-text-teal"></i><?php $sql = "SELECT name, full_name, id FROM users WHERE id = ".$created_by_id; foreach ($pdo->query($sql) as $row) {echo "<a href='../profil/?id=".$row["id"]."' style='text-decoration: none;' class='w3-hover-text-blue'>".$row["name"]." <i style='font-size: 12px'>(".$row["full_name"].")</i></a>";}?></p>
        <hr>
        <p><i class="fa fa-eye fa-fw w3-margin-right w3-large w3-text-teal"></i>Sichtbar für<ul class="w3-ul-special w3-margin"><?php $sql = "SELECT name, full_name, id FROM users"; foreach ($pdo->query($sql) as $row) {if(in_array($row["id"], $readuser)){?><span class='w3-hover-text-blue' onclick='$("#limiter1").toggleClass("limiter-show"); $("#limiter3").toggleClass("limiter-show"); ShowProfInfo(<?php echo $row["id"]; ?>)'><?php echo "<li>".$row["name"]." <i style='font-size: 12px'>(".$row["full_name"].")</i></li></span>";}}?></ul></p>
        <hr>
        <p><i class="fa fa-user-edit fa-fw w3-margin-right w3-large w3-text-teal"></i>Bearbeitbar für<ul class="w3-ul-special w3-margin"><?php $sql = "SELECT name, full_name, id FROM users"; foreach ($pdo->query($sql) as $row) {if(in_array($row["id"], $edituser)){?><span class='w3-hover-text-blue' onclick='$("#limiter1").toggleClass("limiter-show"); $("#limiter3").toggleClass("limiter-show"); ShowProfInfo(<?php echo $row["id"]; ?>)'><?php echo "<li>".$row["name"]." <i style='font-size: 12px'>(".$row["full_name"].")</i></li></span>";}}?></ul></p>
        <?php
      }
    ?>
  </div>
  <?php if(in_array($_SESSION["userid"], $edituser) || $_SESSION["userrang"] >= 2){?>
    <span class="w3-right">
      <span style="margin-right: 10px;" class="w3-hover-text-red" onclick='$("#limiter1").toggleClass("limiter-show"); $("#limiter6").toggleClass("limiter-show"); AskDelete(<?php echo $_GET["q"]; ?>)'>
        <i class="far fa-trash-alt"></i>
      </span>
      <span onclick='$("#limiter1").toggleClass("limiter-show"); $("#limiter2").toggleClass("limiter-show"); EditInfo(<?php echo $_GET["q"]; ?>)'>
        <i class="far fa-edit"></i>
      </span>
    </span>
    <?php } ?>
  </div>
