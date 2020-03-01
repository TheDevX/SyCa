<?php
session_start();
include_once '../../meta/copyright/messageincode.html';
include_once '../../meta/sql/pdoconecction.php';
include_once '../../meta/securtity/checkifloggedin.php';
$mysqli = new mysqli("db1268.mydbserver.com", "p397345", "5PDgmzoV", "usr_p397345_5");
if($mysqli->connect_error) {
  exit('<span style="color: red;">Verbindung zur Datenbank fehlgeschlagen</span>');
}

$sql = "SELECT * FROM users WHERE id = ".$_GET["q"];
foreach ($pdo->query($sql) as $row) {
    $id = $row["id"];
    $name = $row["name"];
    $full_name = $row["full_name"];
    $last_login = $row["last_login"];
    $added_at = $row["added_at"];
    $added_by_id = $row["added_by_id"];
    $birthday = $row["birthday"];
    $adress_street = $row["adress_street"];
    $adress_town = $row["adress_town"];
    $adress_plz = $row["adress_plz"];
    $rang = $row["rang"];
    $profilurl = $row["profilurl"];
    $email = $row["email"];
    $phone_number = $row["phone_number"];
    $note = $row["note"];
    $trainer_name = $row["trainer_name"];
    $trainer_adress_street = $row["trainer_adress_street"];
    $trainer_adress_town = $row["trainer_adress_town"];
    $trainer_adress_plz = $row["trainer_adress_plz"];
    $trainer_email = $row["trainer_email"];
    $trainer_number = $row["trainer_number"];
    $teacher_name = $row["teacher_name"];
    $teacher_adress_street = $row["teacher_adress_street"];
    $teacher_adress_town = $row["teacher_adress_town"];
    $teacher_adress_plz = $row["teacher_adress_plz"];
    $teacher_email = $row["teacher_email"];
    $teacher_number = $row["teacher_number"];
}
$date = date_format(date_create_from_format("Y-m-d", $birthday), 'd. m Y');
if(!isset($id)) {
  exit('<span style="color: red;">ID nicht gefunden!</span>');
}
?>
<style>
    .box {
        height: auto;
        overflow: hidden;
        transition: .4s;
    }

    .closed {
        height: 0;
        transition: .4s;
    }
</style>
<div style="width: 100%;">
<hr>
<form action="edit_user.php?id=<?php echo $id; ?>&action=save" method="POST" enctype="multipart/form-data">
  <div class="w3-container" style="width: 100%;">
    <label>Name</label>
    <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $name;?>" name="name"></input>
    <label>Ganzer Name</label>
    <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $full_name;?>" name="full_name"></input>
    <hr>
    <label>Passwort</label>
    <input class="w3-input w3-border w3-margin" type="password" placeholder="Passwort" name="password" autocomplete="off"></input>
    <hr>
    <label>Geburtstag</label>
    <input class="w3-input w3-border w3-margin" data-toggle="datepicker-bday" name="bday">
    <hr>
    <label><b>Adresse</b></label>
    <div class="w3-row-padding">
        <label>Straße</label>
        <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $adress_street;?>" name="adress_street"></input>
        <label>Stadt</label>
        <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $adress_town;?>" name="adress_town"></input>
        <label>PLZ</label>
        <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $adress_plz;?>" name="adress_plz"></input>
    </div>
    <hr>
    <?php
    if($_SESSION["userrang"] >= 2){
      ?>
      <select class="w3-select w3-border w3-margin" name="rang">
        <option value="1" <?php if($rang == 1){echo "selected";} ?>>Normaler Benuter</option>
        <option value="2" <?php if($rang == 2){echo "selected";} ?>>Moderator</option>
        <option value="3" <?php if($rang == 3){echo "selected";} ?>>Administrator</option>
      </select>
      <?php
      }
    ?>
    <hr>
    <label>E-Mail Adresse</label>
    <input class="w3-input w3-border w3-margin" type="email" value="<?php echo $email;?>" name="email"></input>
    <label>Handynummer</label></br>
    <label>Bsp.: +4912345678987</label>
    <input class="w3-input w3-border w3-margin" type="tel" value="<?php echo $phone_number;?>" name="phone_number"></input>
    <hr>
    <label>Notiz</label>
    <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $note;?>" name="note"></input>
  </div>
  <hr>
  <div>
      <div><label><b>Trainer Infos </b><i onclick="$('.box1').toggleClass('closed')">Anzeigen/Ausblenden</i></label></div>
      <div class="box box1 closed">
        <label>Name</label>
        <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $trainer_name;?>" name="trainer_name"></input>
        <label>E-Mail Adresse</label>
        <input class="w3-input w3-border w3-margin" type="email" value="<?php echo $trainer_email;?>" name="trainer_email"></input>
        <label>Handynummer</label></br>
        <label>Bsp.: +4912345678987</label>
        <input class="w3-input w3-border w3-margin" type="tel" value="<?php echo $trainer_number;?>" name="trainer_number"></input>
        <label><b>Adresse</b></label>
        <div class="w3-row-padding">
            <label>Straße</label>
            <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $trainer_adress_street;?>" name="trainer_adress_street"></input>
            <label>Stadt</label>
            <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $trainer_adress_town;?>" name="trainer_adress_town"></input>
            <label>PLZ</label>
            <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $trainer_adress_plz;?>" name="trainer_adress_plz"></input>
        </div>
    </div>
  </div>
  <hr>
  <div>
      <div><label><b>Lehrer Infos </b><i onclick="$('.box2').toggleClass('closed')">Anzeigen/Ausblenden</i></label></div>
      <div class="box box2 closed">
        <label>Name</label>
        <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $teacher_name;?>" name="teacher_name"></input>
        <label>E-Mail Adresse</label>
        <input class="w3-input w3-border w3-margin" type="email" value="<?php echo $teacher_email;?>" name="teacher_email"></input>
        <label>Handynummer</label></br>
        <label>Bsp.: +4912345678987</label>
        <input class="w3-input w3-border w3-margin" type="tel" value="<?php echo $teacher_number;?>" name="teacher_number"></input>
        <label><b>Adresse</b></label>
        <div class="w3-row-padding">
            <label>Straße</label>
            <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $teacher_adress_street;?>" name="teacher_adress_street"></input>
            <label>Stadt</label>
            <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $teacher_adress_town;?>" name="teacher_adress_town"></input>
            <label>PLZ</label>
            <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $teacher_adress_plz;?>" name="teacher_adress_plz"></input>
        </div>
    </div>
  </div>
  <hr>
  <div class="w3-center w3-padding">
    <button type="submit" class="w3-btn w3-border w3-border-green w3-hover-border-black w3-pale-green w3-hover-green w3-margin"><i class="far fa-save"></i></button>
    <button class="w3-btn w3-border w3-border-red w3-hover-border-black w3-pale-red w3-hover-red w3-margin"><i class="far fa-trash-alt"></i></button>
  </div>
</form>
