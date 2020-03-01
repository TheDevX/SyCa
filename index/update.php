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
if(isset($_GET["valid"])){
  if($_GET["valid"] == 1){
    /*if(!empty($_FILES['file']['name'])){
      $upload_folder = "../meta/pictures/terminpic/terminid".$_GET["id"]."/"; //Das Upload-Verzeichnis
      if (!file_exists($upload_folder)) {
        mkdir($upload_folder);
      }
      $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
      $filename = "termin";

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
      if(file_exists($new_path)){
        unlink($new_path);
      }
      move_uploaded_file($_FILES['file']['tmp_name'], $new_path);
    }*/
    if(isset($_POST["full_day"])){
      $full_day = 1;
    }
    else{
      $full_day = 0;
    }
    $show = array();
    $edit = array();
    $sql = "SELECT * FROM users";
    foreach ($pdo->query($sql) as $row) {
      if(isset($_POST["useridtoshow".$row["id"]])){
        if($_POST["useridtoshow".$row["id"]] == "on"){
          $show[] = $row["id"];
        }
      }
      if(isset($_POST["useridtoedit".$row["id"]])){
        if($_POST["useridtoedit".$row["id"]] == "on"){
          $edit[] = $row["id"];
        }
      }
    }
    $read_allowed_for = implode(",", $show);
    $read_allowed_for .= ",".$_SESSION["userid"];
    $edit_allowed_for = implode(",", $edit);
    $edit_allowed_for .= ",".$_SESSION["userid"];
    $start_time = date_format(date_create_from_format('d. m Y', $_POST["datestart"]), 'Y-m-d')." ".$_POST["hourstart"]."-".$_POST["minutestart"]."-00";
    $end_time = date_format(date_create_from_format('d. m Y', $_POST["dateend"]), 'Y-m-d')." ".$_POST["hourend"]."-".$_POST["minuteend"]."-00";
    $statement = $pdo->prepare("UPDATE `termine` SET `title`='".$_POST["title"]."',`note`='".$_POST["note"]."',`location`='".$_POST["location"]."',`full_day`='".$full_day."',`start_time`='".$start_time."',`end_time`='".$end_time."',`edit_allowed_for`='".$edit_allowed_for."',`read_allowed_for`='".$read_allowed_for."',`color`='".$_POST["color"]."' WHERE id = ".$_GET["id"]);
    $statement->execute();
    //include_once '../meta/checkcollision/checkcollision.php';
  }
}
?>
<!DOCTYPE html>
<html>
  <title>Aktualisiert :: Kalender :: SyCa</title>
  <?php
  include_once '../meta/head/head.php';
  include_once '../meta/menu/menu.php';
  ?>
  <body>
    <header>
      <a style ="text-decoration: none;" href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} echo "&month=".date("n"); echo "&year=".date("Y"); if(isset($_GET["showspecialpersons"])){echo "action=".$_GET["showspecialpersons"];}?>">
        SyCa
      </a>
    </header>
    <div class="toggle-button">
      <div class="wrapper">
        <div class="menu-bar menu-bar-top"></div>
        <div class="menu-bar menu-bar-middle"></div>
        <div class="menu-bar menu-bar-bottom"></div>
      </div>
    </div>

    <div class="menu-wrap">
      <div class="menu-sidebar">
        <?php
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
        }
        ?>
        <div class="w3-white w3-text-grey w3-card-4">
            <img src="<?php if(empty($profilepic)){echo 'http://syca.stadtlandfluss-online.de/meta/logo/syca.png';}else{echo $profilepic;} ?>" style="width:100%; border: solid 1px grey" alt="ProfilPicture">
            <div class="w3-container" style="width: 100%;">
              <h2><?php echo "<a href='../profil/?id=".$id."' style='text-decoration: none;'>".$full_name."</a>"; if($_SESSION["userid"] == $id || $_SESSION["userrang"] >= 2){echo '<a href="../profil/edit.php?id='.$_SESSION["userid"].'&month='.$month.'&year='.$year.'"><span class="w3-right"><i class="far fa-edit"></i></span></a>';}?></h2>
              <hr>
            </div>
          <?php
          include_once '../meta/notifications/notifications.php';
          include_once '../meta/NextTermins/nexttermins.php';
          include_once '../meta/ShowUsers/showusers.php';
          include_once '../meta/footer/footer.php';
          ?>
        </div>
      </div>
    </div>
    <div class="main">
      <?php
      include_once '../meta/kalender/kalender.php';
      ?>
    </div>
    <link rel="stylesheet" href="../meta/datepicker/datepicker.css">
    <div class="limiter limiter-show">
      <div class="container-login100">
        <div class="wrap-login100">
          <span class="login100-form-title" style="color: #72af2f;">Termin aktualisiert</span>
          <div style="position: relative; left: 50%; color: #72af2f;">
            <i style="font-size: 40px;" class="far fa-check-circle"></i>
          </div>
          <span class="login100-form-title" style="font-size: 18px">Weiterleitung zur Startseite.. <span id="redirect">2</span></span>
          <script>
          var counter = document.getElementById("redirect").innerHTML*1;
          var interval = setInterval(function() {
              counter--;
              if (counter == 0) {
                  // Display a login box
                  clearInterval(interval);
                  window.location.href = "../index";
              }
              document.getElementById("redirect").innerHTML = counter;
          }, 1000);
          </script>
        </div>
      </div>
    </div>
  </body>
  <script>
    'use strict';
    ;( function ( document, window, index )
    {
      var inputs = document.querySelectorAll( '.inputfile' );
      Array.prototype.forEach.call( inputs, function( input )
      {
        var label	 = input.nextElementSibling,
          labelVal = label.innerHTML;

        input.addEventListener( 'change', function( e )
        {
          var fileName = '';
          fileName = e.target.value.split( '\\' ).pop();

          if( fileName )
            label.querySelector( 'span' ).innerHTML = fileName;
          else
            label.innerHTML = labelVal;
        });

        // Firefox bug fix
        input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
        input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
      });
    }( document, window, 0 ));
  </script>
</html>
