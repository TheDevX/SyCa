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
    if(!empty($_POST["password"])){
      $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
      $statement = $pdo->prepare("UPDATE `users` SET `name`=".$_POST["name"].",`full_name`=".$_POST["full_name"].",`password`=".$password.",`adress_street`=".$_POST["adress_street"].",`adress_town`=".$_POST["adress_town"].",`adress_plz`=".$_POST["adress_plz"].",`rang`=".$_POST["rang"].",`email`=".$_POST["email"].",`phone_number`=".$_POST["phone_number"].",`note`=".$_POST["note"].",`trainer_name`=".$_POST["trainer_name"].",`trainer_adress_plz`=".$_POST["trainer_adress_plz"].",`trainer_adress_town`=".$_POST["trainer_adress_town"].",`trainer_adress_street`=".$_POST["trainer_adress_street"].",`trainer_email`=".$_POST["trainer_email"].",`trainer_number`=".$_POST["trainer_number"].",`teacher_name`=".$_POST["teacher_name"].",`teacher_adress_plz`=".$_POST["teacher_adress_plz"].",`teacher_adress_town`=".$_POST["teacher_adress_town"].",`teacher_adress_street`=".$_POST["teacher_adress_street"].",`teacher_email`=".$_POST["teacher_email"].",`teacher_number`=".$_POST["teacher_number"]." WHERE `id`=".$_GET["id"]);
    }
    else{
      $statement = $pdo->prepare("UPDATE `users` SET `name`=".$_POST["name"].",`full_name`=".$_POST["full_name"].",`adress_street`=".$_POST["adress_street"].",`adress_town`=".$_POST["adress_town"].",`adress_plz`=".$_POST["adress_plz"].",`rang`=".$_POST["rang"].",`email`=".$_POST["email"].",`phone_number`=".$_POST["phone_number"].",`note`=".$_POST["note"].",`trainer_name`=".$_POST["trainer_name"].",`trainer_adress_plz`=".$_POST["trainer_adress_plz"].",`trainer_adress_town`=".$_POST["trainer_adress_town"].",`trainer_adress_street`=".$_POST["trainer_adress_street"].",`trainer_email`=".$_POST["trainer_email"].",`trainer_number`=".$_POST["trainer_number"].",`teacher_name`=".$_POST["teacher_name"].",`teacher_adress_plz`=".$_POST["teacher_adress_plz"].",`teacher_adress_town`=".$_POST["teacher_adress_town"].",`teacher_adress_street`=".$_POST["teacher_adress_street"].",`teacher_email`=".$_POST["teacher_email"].",`teacher_number`=".$_POST["teacher_number"]." WHERE `id`=".$_GET["id"]);
    }
    $statement->execute();
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
        <div class="w3-white w3-text-grey w3-card-4">
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
          <span class="login100-form-title" style="color: #72af2f;">Benutzerdaten aktualisiert</span>
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
                  //window.location.href = "../index";
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