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
$sql = "SELECT * FROM users WHERE id = ".$_GET["q"];
foreach ($pdo->query($sql) as $row) {
  $id = $row["id"];
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
if(!isset($id)) {
  exit('<span style="color: red;">ID nicht gefunden!</span>');
}
?>
<div style="width: 100%;">
<hr>
<h2><?php echo $full_name; ?></h2>
<div class="w3-container">
  <?php if(!empty($birthday)){ ?> <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} echo "&month=".date("n",strToTime($birthday)); echo "&year=".date("Y", strToTime($birthday));?>" style="text-decoration: none;" class="w3-hover-text-blue"><?php echo date("d.m Y ", strToTime($birthday)); ?></a></p> <?php } ?>
  <?php if(!empty($adress_street) and !empty($adress_town) and !empty($adress_plz)){ ?> <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="https://www.google.de/maps/search/<?php echo $adress_street." ".$adress_plz." ".$adress_town; ?>" style="text-decoration: none;" target="_blank" class="w3-hover-text-blue"><?php echo $adress_street." | ".$adress_plz." ".$adress_town; ?></p> <?php } ?>
  <?php if(!empty($email)){ ?> <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="mailto:<?php echo $email; ?>" style="text-decoration: none;" target="_blank" class="w3-hover-text-blue"><?php echo $email; ?></a></p> <?php } ?>
  <?php if(!empty($phone_number)){ ?>
    <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="tel:<?php echo $phone_number; ?>" style="text-decoration: none;" target="_blank" class="w3-hover-text-blue">
      <?php
      if(substr($phone_number, 0, 3) == "+49"){
        echo substr($phone_number, 0, 3)." ".substr($phone_number, 3, 4)." ".substr($phone_number, 7, 4)." ".substr($phone_number, 11, 3);
      }
      if(substr($phone_number, 0, 1) == "0"){
        echo substr($phone_number, 0, 5)." ".substr($phone_number, 5, 4)." ".substr($phone_number, 9, 3);
      }
      ?>
    </a></p>
    <hr>
    <p class="w3-large"><b><i class="fas fa-dumbbell fa-fw w3-margin-right w3-text-teal"></i>Trainer Infos</b></p>
    <div class="w3-margin-left">
      <?php if(!empty($trainer_name)){ ?> <p><i class="fas fa-user fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $trainer_name; ?></p> <?php } ?>
      <?php if(!empty($trainer_adress_street) and !empty($trainer_adress_town) and !empty($trainer_adress_plz)){ ?> <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="https://www.google.de/maps/search/<?php echo $trainer_adress_street." ".$trainer_adress_plz." ".$trainer_adress_town; ?>" style="text-decoration: none;" target="_blank" class="w3-hover-text-blue"><?php echo $trainer_adress_street." | ".$trainer_adress_plz." ".$trainer_adress_town; ?></p> <?php } ?>
      <?php if(!empty($trainer_email)){ ?> <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="mailto:<?php echo $trainer_email; ?>" style="text-decoration: none;" target="_blank" class="w3-hover-text-blue"><?php echo $trainer_email; ?></a></p> <?php } ?>
      <?php if(!empty($trainer_number)){ ?>
        <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="tel:<?php echo $trainer_number; ?>" style="text-decoration: none;" target="_blank" class="w3-hover-text-blue">
          <?php
          if(substr($trainer_number, 0, 3) == "+49"){
            echo substr($trainer_number, 0, 3)." ".substr($trainer_number, 3, 4)." ".substr($trainer_number, 7, 4)." ".substr($trainer_number, 11, 3);
          }
          if(substr($trainer_number, 0, 1) == "0"){
            echo substr($trainer_number, 0, 5)." ".substr($trainer_number, 5, 4)." ".substr($trainer_number, 9, 3);
          }
          ?>
        </a></p>
        <?php
      }?>
    </div>
    <hr>
    <p class="w3-large"><b><i class="fas fa-school fa-fw w3-margin-right w3-text-teal"></i>Lehrer Infos</b></p>
    <div class="w3-margin-left">
      <?php if(!empty($teacher_name)){ ?> <p><i class="fas fa-user fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $teacher_name; ?></p> <?php } ?>
      <?php if(!empty($teacher_adress_street) and !empty($teacher_adress_town) and !empty($teacher_adress_plz)){ ?> <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="https://www.google.de/maps/search/<?php echo $teacher_adress_street." ".$teacher_adress_plz." ".$teacher_adress_town; ?>" style="text-decoration: none;" target="_blank" class="w3-hover-text-blue"><?php echo $teacher_adress_street." | ".$teacher_adress_plz." ".$teacher_adress_town; ?></p> <?php } ?>
      <?php if(!empty($teacher_email)){ ?> <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="mailto:<?php echo $teacher_email; ?>" style="text-decoration: none;" target="_blank" class="w3-hover-text-blue"><?php echo $teacher_email; ?></a></p> <?php } ?>
      <?php if(!empty($teacher_number)){ ?>
        <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="tel:<?php echo $teacher_number; ?>" style="text-decoration: none;" target="_blank" class="w3-hover-text-blue">
          <?php
          if(substr($teacher_number, 0, 3) == "+49"){
            echo substr($teacher_number, 0, 3)." ".substr($teacher_number, 3, 4)." ".substr($teacher_number, 7, 4)." ".substr($teacher_number, 11, 3);
          }
          if(substr($teacher_number, 0, 1) == "0"){
            echo substr($teacher_number, 0, 5)." ".substr($teacher_number, 5, 4)." ".substr($teacher_number, 9, 3);
          }
          ?>
        </a></p>
        <?php
      }?>
    </div>
  <?php } ?>
  <hr>
  <?php
    if($_SESSION["userrang"] >= 2){
      ?>
      <p class="w3-large"><b><i class="fa fa-info fa-fw w3-margin-right w3-text-teal"></i>Weitere Infos</b></p>
      <div class="w3-margin-left">
        <p><i class="fa fa-plus-circle fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo date("d.m Y ", strToTime($added_at)); ?></p>
        <p><i class="fa fa-plus-square fa-fw w3-margin-right w3-large w3-text-teal"></i><?php $sql = "SELECT name, full_name FROM users WHERE id = ".$added_by_id; foreach ($pdo->query($sql) as $row) {echo $row["name"]." <i style='font-size: 12px'>(".$row["full_name"].")</i>";}?></p>
        <p><i class="fa fa-sign-in-alt fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo date("d.m Y // H:i", strToTime($last_login)); ?></p>
        <p><i class="fas fa-sticky-note w3-margin-right w3-large w3-text-teal"></i><?php echo $note ?></p>
      </div>
      <?php
    }
  ?>
</div>
<?php if(in_array($_SESSION["userid"], $edituser) || $_SESSION["userrang"] >= 2){?>
    <span onclick='$("#limiter3").toggleClass("limiter-show"); $("#limiter4").toggleClass("limiter-show"); EditProfInfo(<?php echo $_GET["q"]; ?>)'>
      <span class="w3-right"><i class="far fa-edit"></i></span>
    </span>
  <?php } ?>
