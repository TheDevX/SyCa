<?php
session_start();
include_once '../../meta/copyright/messageincode.html';
include_once '../../meta/sql/pdoconecction.php';
include_once '../../meta/securtity/checkifloggedin.php';
include_once '../../meta/startup/startup.php';
include_once '../../meta/noscript/error.php';
$mysqli = new mysqli("db1268.mydbserver.com", "p397345", "5PDgmzoV", "usr_p397345_5");
if($mysqli->connect_error) {
  exit('<span style="color: red;">Verbindung zur Datenbank fehlgeschlagen</span>');
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
$start_date = date_format(date_create_from_format("Y-m-d H:i:s", $start_time), 'd. m Y');
$end_date = date_format(date_create_from_format("Y-m-d H:i:s", $end_time), 'd. m Y');
if(!isset($id)) {
  exit('<span style="color: red;">ID nicht gefunden!</span>');
}
?>
<link rel="stylesheet" href="../../meta/datepicker/datepicker.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="../../meta/datepicker/datepicker.js"></script>
<script src="../../meta/datepicker/datepicker.de-DE.js"></script>
<div style="width: 100%;">
<hr>
<form action="update.php?valid=1&id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" style="width: 100%;">
  <!--<label><i class="fas fa-image fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Titelbild</b></label>
    <input type="file" name="file-7" id="file-7" class="inputfile inputfile-6" accept="image/*"/>
  <label for="file-7"><span></span> <strong><center> Bild hochladen</center></strong></label>
  <hr>-->
  <label><i class="fas fa-list fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Allgemein</b></label>
  <div class="margin-left">
    <div class="input-effect"><input class="effect-20" type="text" name="title" placeholder="Titel*" required value="<?php echo $title; ?>"><span class="focus-border"><i></i></span></div>
    <div class="input-effect"><input class="effect-20" type="text" name="note" placeholder="Notiz" value="<?php echo $note; ?>"><span class="focus-border"><i></i></span></div>
    <div class="input-effect"><input class="effect-20" type="text" name="location" placeholder="Ort" value="<?php echo $location; ?>"><span class="focus-border"><i></i></span></div></br>
  </div>
  <hr>
    <label><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Zeitraum</b></label>
    <div class="w3-padding w3-margin-left">
      <label>Start</label>
      <div class="input-effect"><input class="effect-20" type="text" data-toggle="datepicker-start1" name="datestart" required value="<?php echo $start_date; ?>"><span class="focus-border"><i></i></span></div>
      <div class="input-effect-49 input-left input-margin-right-1"><input class="effect-20 effect-50" type="number" min="0" max="23" name="hourstart" placeholder="Stunde" value="<?php echo date_format(date_create(), 'H') ?>"><span class="focus-border"><i></i></span></div>
      <div class="input-effect-49 input-left input-margin-right-1"><input class="effect-20 effect-50" type="number" min="0" max="59" name="minutestart" placeholder="Minute" value="<?php echo date_format(date_create(), 'i') ?>"><span class="focus-border"><i></i></span></div>
    </div>
    </br>
    </br>
    <div class="w3-padding w3-margin-left w3-margin-top">
      <label>Ende</label>
      <div class="input-effect"><input class="effect-20" type="text" data-toggle="datepicker-end1" name="dateend" required value="<?php echo $end_date; ?>"><span class="focus-border"><i></i></span></div>
      <div class="input-effect-49 input-left input-margin-right-1"><input class="effect-20 effect-50" type="number" min="0" max="23" name="hourend" placeholder="Stunde" value="<?php echo date_format(date_create(), 'H') ?>"><span class="focus-border"><i></i></span></div>
      <div class="input-effect-49 input-left input-margin-right-1"><input class="effect-20 effect-50" type="number" min="0" max="59" name="minuteend" placeholder="Minute" value="<?php echo date_format(date_create(), 'i') ?>"><span class="focus-border"><i></i></span></div>
    </div>
    <div style="margin-left: 32px">
      <p><input class="w3-check" type="checkbox" name="full_day" onclick='$(".input-left").toggleClass("input-disabled")' <?php if($full_day == 1){echo "checked";} ?>> <label>Ganztägig</label></p>
    </div>
    <hr>
    <label><i class="fas fa-palette fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Farbe</b></label>
    <div class="input-effect">
      <script type="text/javascript">
        function changeselectcolor1(){
          document.getElementById('selector1').className = "effect-20 w3-"+document.getElementById('selector1').value;
        }
      </script>
      <select class="myselect effect-20 <?php if($color != ""){echo "w3-".$color;} ?>" onchange="document.getElementsByClassName('myselect')[0].className = 'myselect effect-20 w3-'+document.getElementsByClassName('myselect')[0].value;" name="color" id="selector1">
        <option class="w3-white">Keine</option>
        <option value="red" class="w3-red" <?php if($color == "red"){echo "selected";} ?>>Rot</option>
        <option value="pink" class="w3-pink" <?php if($color == "pink"){echo "selected";} ?>>Pink</option>
        <option value="purple" class="w3-purple" <?php if($color == "purple"){echo "selected";} ?>>Lila</option>
        <option value="deep-purple" class="w3-deep-purple" <?php if($color == "deep-purple"){echo "selected";} ?>>Dunkel Lila</option>
        <option value="indigo" class="w3-indigo" <?php if($color == "indigo"){echo "selected";} ?>>Indigo</option>
        <option value="blue" class="w3-blue" <?php if($color == "blue"){echo "selected";} ?>>Blau</option>
        <option value="light-blue" class="w3-light-blue" <?php if($color == "light-blue"){echo "selected";} ?>>Helles Blau</option>
        <option value="cyan" class="w3-cyan" <?php if($color == "cyan"){echo "selected";} ?>>Cyan</option>
        <option value="aqua" class="w3-aqua" <?php if($color == "aqua"){echo "selected";} ?>>Aqua</option>
        <option value="teal" class="w3-teal" <?php if($color == "teal"){echo "selected";} ?>>Teal</option>
        <option value="green" class="w3-green" <?php if($color == "green"){echo "selected";} ?>>Grün</option>
        <option value="light-green" class="w3-light-green" <?php if($color == "light-green"){echo "selected";} ?>>Helles Grün</option>
        <option value="lime" class="w3-lime" <?php if($color == "lime"){echo "selected";} ?>>Lime</option>
        <option value="sand" class="w3-sand" <?php if($color == "sand"){echo "selected";} ?>>Sand</option>
        <option value="khaki" class="w3-khaki" <?php if($color == "khaki"){echo "selected";} ?>>Khaki</option>
        <option value="yellow" class="w3-yellow" <?php if($color == "yellow"){echo "selected";} ?>>Gelb</option>
        <option value="amber" class="w3-amber" <?php if($color == "amber"){echo "selected";} ?>>Amber</option>
        <option value="orange" class="w3-orange" <?php if($color == "orange"){echo "selected";} ?>>Orange</option>
        <option value="deep-orange" class="w3-deep-orange" <?php if($color == "deep-orange"){echo "selected";} ?>>Dunkeles Orange</option>
        <option value="blue-gray" class="w3-blue-gray" <?php if($color == "blue-gray"){echo "selected";} ?>>Blau/Grau</option>
        <option value="brown" class="w3-brown" <?php if($color == "brown"){echo "selected";} ?>>Braun</option>
        <option value="light-gray" class="w3-light-gray" <?php if($color == "light-gray"){echo "selected";} ?>>Helles Grau</option>
        <option value="gray" class="w3-gray" <?php if($color == "gray"){echo "selected";} ?>>Grau</option>
        <option value="dark-gray" class="w3-dark-gray" <?php if($color == "dark-gray"){echo "selected";} ?>>Dunkeles Grau</option>
        <option value="pale-red" class="w3-pale-red" <?php if($color == "pale-red"){echo "selected";} ?>>Blasses Rot</option>
        <option value="pale-yellow" class="w3-pale-yellow" <?php if($color == "pale-yellow"){echo "selected";} ?>>Blasses Gelb</option>
        <option value="pale-green" class="w3-pale-green" <?php if($color == "pale-green"){echo "selected";} ?>>Blasses Grün</option>
        <option value="pale-blue" class="w3-pale-blue" <?php if($color == "pale-blue"){echo "selected";} ?>>Blasses Blau</option>
      </select>
      <span class="focus-border"><i></i></span>
    </div>
    <hr>
    <label><i class="far fa-eye fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Folgenden Personen anzeigen</b></label></br>
    <div class="w3-container">
    <?php
        $sql = "SELECT * FROM users";
        foreach ($pdo->query($sql) as $row) {
          $checked = 0;
          echo '<input class="w3-check" type="checkbox" name="useridtoshow'.$row["id"].'"';
          if($row["id"] == $_SESSION["userid"]){
            echo "checked='checked' disabled ";
          }
          else if(in_array($row["id"], $readuser)){
            echo "checked='checked'";
          }
          echo '><a href="../profil/?id='.$row["id"].'" style="text-decoration: none;" class="w3-hover-text-blue"> '.$row["name"].'</a></input></br>';
        }
      ?>
    </div>
    <hr>
    <label><i class="far fa-edit fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Bearbeitbar für</b></label></br>
    <div class="w3-container">
    <?php
        $sql = "SELECT * FROM users";
        foreach ($pdo->query($sql) as $row) {
          $checked = 0;
          echo '<input class="w3-check" type="checkbox" name="useridtoedit'.$row["id"].'"';
          if($row["id"] == $_SESSION["userid"]){
            echo "checked='checked' disabled ";
          }
          else if(in_array($row["id"], $edituser)){
            echo "checked='checked'";
          }
          echo '><a href="../profil/?id='.$row["id"].'" style="text-decoration: none;" class="w3-hover-text-blue"> '.$row["name"].'</a></input></br>';
        }
      ?>
  </div>
  <div class="w3-center w3-padding">
    <button class="w3-btn w3-border w3-border-green w3-hover-border-black w3-pale-green w3-hover-green w3-margin"><i class="far fa-save"></i></button>
    <button type="button" class="w3-btn w3-border w3-border-red w3-hover-border-black w3-pale-red w3-hover-red w3-margin" onclick='$("#limiter2").toggleClass("limiter-show")'><i class="fa fa-times"></i></button>
  </div>
</form>
<script>
function setdateeditmode(){
  $('[data-toggle="datepicker-start1"]').datepicker({
    language: 'de-DE',
    format: 'dd. mm yyyy',
    date: '<?php echo $start_date; ?>',
    weekStart: 1,
    autoPick: true,
    autoHide: true,
    zIndex: 2048,
    offset: -40,
  });
  $('[data-toggle="datepicker-end1"]').datepicker({
    language: 'de-DE',
    format: 'dd. mm yyyy',
    date: '<?php echo $end_date; ?>',
    weekStart: 1,
    autoPick: true,
    autoHide: true,
    zIndex: 2048,
    offset: -40,
  });
}
setdateeditmode();
</script>
