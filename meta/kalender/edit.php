<?php
session_start();
include_once '../meta/copyright/messageincode.html';
include_once '../meta/sql/pdoconecction.php';
include_once '../meta/securtity/checkifloggedin.php';
if(isset($_GET["month"])){
  $month = $_GET["month"];
}
else{
  $month = date("m");
}
if(isset($_GET["year"])){
  $year = $_GET["year"];
}
else{
  $year = date("Y");
}
if(isset($_GET["action"])){
  if($_GET["action"] == "save"){
    if(!empty($_FILES['file']['name'])){
      $upload_folder = "../profilpictures/userid".$_SESSION["userid"]."/";; //Das Upload-Verzeichnis
      if (!file_exists($upload_folder)) {
        mkdir($upload_folder);
      }
      $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
      $filename = "ProfilPicture";

      //Überprüfung der Dateiendung
      $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
      if(!in_array($extension, $allowed_extensions)) {
       die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
      }

      //Überprüfung dass das Bild keine Fehler enthält
      if(function_exists('exif_imagetype')) { //Die exif_imagetype-Funktion erfordert die exif-Erweiterung auf dem Server
       $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
       $detected_type = exif_imagetype($_FILES['file']['tmp_name']);
       if(!in_array($detected_type, $allowed_types)) {
       die("Nur der Upload von Bilddateien ist gestattet");
       }
      }

      //Pfad zum Upload
      $new_path = $upload_folder.$filename.'.'.$extension;

      //Neuer Dateiname falls die Datei bereits existiert
      if(file_exists($new_path)) { //Falls Datei existiert, hänge eine Zahl an den Dateinamen
       unlink($new_path);
      }

      //Alles okay, verschiebe Datei an neuen Pfad
      move_uploaded_file($_FILES['file']['tmp_name'], $new_path);
    }
    if(!isset($new_path)){
      $sql = "SELECT profilurl FROM users WHERE id = ".$_SESSION["userid"];
      foreach ($pdo->query($sql) as $row) {
        $new_path = $row["profilurl"];
      }
    }
    $bday = date_format(date_create_from_format('d. m Y', $_POST["bday"]), 'Y-m-d');
    $statement = $pdo->prepare("UPDATE `users` SET `name`='".$_POST["name"]."',`full_name`='".$_POST["full_name"]."',`password`='".password_hash($_POST["password"], PASSWORD_DEFAULT)."',`birthday`='".$bday."',`adress_street`='".$_POST["adress_street"]."',`adress_town`='".$_POST["adress_town"]."',`adress_plz`='".$_POST["adress_plz"]."',
    `rang`='".$_POST["rang"]."',`profilurl`='".$new_path."',`email`='".$_POST["email"]."',`phone_number`='".$_POST["phone_number"]."',`classteachers`='".$_POST["classteachers"]."',`note`='".$_POST["note"]."' WHERE id = ".$_SESSION["userid"]);
    $statement->execute();
    die('<meta http-equiv="refresh" content="0; URL=index.php">');
  }
}
$sql = "SELECT * FROM users WHERE id = ".$_SESSION["userid"];
foreach ($pdo->query($sql) as $row) {
  $id = $row["id"];
  $full_name = $row["full_name"];
  $name = $row["name"];
  $profilepic = $row["profilurl"];
  $created_at = $row["added_at"];
  $last_login = $row["last_login"];
  $added_by_id = $row["added_by_id"];
  $birthday = $row["birthday"];
  $adress_street = $row["adress_street"];
  $adress_town = $row["adress_town"];
  $adress_plz = $row["adress_plz"];
  $rang = $row["rang"];
  $email = $row["email"];
  $phone_number = $row["phone_number"];
  $classteachers = $row["classteachers"];
  $note = $row["note"];
}
$date = date_format(date_create_from_format("Y-m-d", $birthday), 'd. m Y');
?>
<!DOCTYPE html>
<html>
<title>Profil | SyCa</title>
<?php
include_once '../meta/head/head.php';
?>
<link rel="stylesheet" href="../meta/datepicker/datepicker.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="../meta/datepicker/datepicker.js"></script>
<script src="../meta/datepicker/datepicker.de-DE.js"></script>
<script>
  $(function() {
    $('[data-toggle="datepicker-bday"]').datepicker({
      language: 'de-DE',
      format: 'dd. mm yyyy',
      weekStart: 1,
      date: '<?php echo $date; ?>',
      autoPick: true,
      autoHide: true,
      zIndex: 2048,
    });
  });
</script>
<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-margin-top">

  <!-- The Grid -->
  <div class="w3-row-padding">

    <!-- Left Column -->
    <div class="w3-quarter">
      <div class="w3-white w3-text-grey w3-card-4">
        <form action="?action=save" method="POST" enctype="multipart/form-data">
          <div class="w3-display-container">
            <img src="<?php if(empty($profilepic)){echo 'http://syca.stadtlandfluss-online.de/meta/logo/syca.png';}else{echo $profilepic;} ?>" style="width:100%; border: solid 1px grey" alt="ProfilPicture">
            <div class="w3-display-bottommiddle w3-center w3-padding w3-white" style="width: 100%; opacity: 0.9;">
                <input type="file" name="file"/>
            </div>
          </div>
          <div class="w3-container" style="width: 100%;">
            <label>Name</label>
            <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $name;?>" name="name"></input>
            <label>Ganzer Name</label>
            <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $full_name;?>" name="full_name"></input>
            <hr>
            <input class="w3-input w3-border w3-margin" type="password" placeholder="Passwort" name="password"></input>
            <hr>
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
            <label>Klassenlehrer</label>
            <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $classteachers;?>" name="classteachers"></input>
            <hr>
            <label>Notiz</label>
            <input class="w3-input w3-border w3-margin" type="text" value="<?php echo $note;?>" name="note"></input>
          </div>
          <hr>
          <div class="w3-center w3-padding">
            <button type="submit" class="w3-btn w3-border w3-border-green w3-hover-border-black w3-pale-green w3-hover-green w3-margin"><i class="far fa-save"></i></button>
            <button class="w3-btn w3-border w3-border-red w3-hover-border-black w3-pale-red w3-hover-red w3-margin"><i class="far fa-trash-alt"></i></button>
          </div>
        </form>
      </div><br>

    <!-- End Left Column -->
    </div>

    <?php
    include_once '../meta/kalender/kalender.php';
    ?>

  <!-- End Grid -->
  </div>

  <!-- End Page Container -->
</div>

<?php
include_once '../meta/footer/footer.php';
?>

</body>
</html>
