<?php
include_once '../meta/sql/pdoconecction.php';
$sql = "SELECT * FROM termine WHERE id != ".$_GET["id"];
foreach ($pdo->query($sql) as $row) {
  if($row["full_day"] == 1){
    $a = new DateTime($row["end_time"]);
    $row["end_time"] = $a->format('Y-m-d')." 23:59:59";
    $b = new DateTime($row["start_time"]);
    $row["start_time"] = $b->format('Y-m-d')." 00:00:00";
  }
  if(($start_time < $row["start_time"] && $end_time < $row["end_time"]) OR ($start_time > $row["start_time"] && $end_time > $row["end_time"])){
  }
  else{
    overlap($row["id"]);
  }
  /*
  if($start_time < $row["start_time"] && $end_time > $row["end_time"]){
    //  DATE A: <------------------->
    //  DATE B:    <--------->
    overlap(1);
  }
  if($start_time > $row["start_time"] && $end_time < $row["end_time"]){
    //  DATE A:       <------->
    //  DATE B: <------------------->
    overlap(2);
  }
  if($start_time < $row["start_time"] && $end_time == $row["end_time"]){
    //  DATE A:  <-------------->
    //  DATE B:        <-------->
    overlap(3);
  }
  if($start_time > $row["start_time"] && $end_time == $row["end_time"]){
    //  DATE A:       <------------->
    //  DATE B: <------------------->
    overlap(4);
  }
  if($start_time > $row["start_time"] && $end_time > $row["end_time"]){
    //  DATE A:       <----------------->
    //  DATE B: <------------------->
    overlap(5);
  }
  if($start_time == $row["start_time"] && $end_time == $row["end_time"]){
    //  DATE A: <------------------->
    //  DATE B: <------------------->
    overlap(6);
  }
  if($start_time < $row["start_time"] && $end_time < $row["end_time"]){
    //  DATE A: <------------------->
    //  DATE B:          <------------------->
    overlap(7);
  }
  */
}
function overlap($id){
  global $pdo;
  $statement = $pdo->prepare("INSERT INTO notifications (level, message, link) VALUES (:level, :message, :link)");
  $statement->execute(array('level' => 3, 'message' => "Überschneidung registriert!", 'link' => $id.",".$_GET["id"]));
}
?>
