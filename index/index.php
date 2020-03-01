<?php
session_start();
include_once '../meta/copyright/messageincode.html';
include_once '../meta/sql/pdoconecction.php';
include_once '../meta/securtity/checkifloggedin.php';
include_once '../meta/startup/startup.php';
include_once '../meta/noscript/error.php';
?>
<!DOCTYPE html>
<html>
  <title>Kalender :: SyCa</title>
  <?php
  include_once '../meta/head/head.php';
  include_once '../meta/menu/menu.php';
  ?>
  <body class="cn">
    <header>
      <a style ="text-decoration: none;" href="../index">SyCa</a>
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
        <div class="w3-white w3-text-grey w3-border-right w3-border-black" style="height: 100%; position: relative;">
            <!--<img src="<?php if(empty($profilepic)){echo 'http://syca.stadtlandfluss-online.de/meta/logo/syca.png';}else{echo $profilepic;} ?>" style="width:100%; border: solid 1px grey" alt="ProfilPicture">-->
            <div class="w3-container" style="width: 100%;">
              <h2><span style='text-decoration: none;' onclick='$("#limiter3").toggleClass("limiter-show"); $(".button-open").toggleClass("button-open"); $(".menu-show").toggleClass("menu-show"); $(".body-make-place").toggleClass("body-make-place"); ShowProfInfo(<?php echo $row["id"]; ?>)'><?php echo $full_name; ?></span></h2>
              <hr>
            </div>
          <?php
          //include_once '../meta/notifications/notifications.php';
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="../meta/datepicker/datepicker.js"></script>
    <script src="../meta/datepicker/datepicker.de-DE.js"></script>
    <script>
      $(function() {
        $('[data-toggle="datepicker-start"]').datepicker({
          language: 'de-DE',
          format: 'dd. mm yyyy',
          <?php
          if(isset($_GET["day"])){
            echo 'date: "'.$day.'. '.$month.' '.$year.'",';
          }
          ?>
          weekStart: 1,
          autoPick: true,
          autoHide: true,
          zIndex: 2048,
          offset: -40,
        });
      });
      $(function() {
        $('[data-toggle="datepicker-end"]').datepicker({
          language: 'de-DE',
          format: 'dd. mm yyyy',
          <?php
          if(isset($_GET["day"])){
            echo 'date: "'.$day.'. '.$month.' '.$year.'",';
          }
          ?>
          weekStart: 1,
          autoPick: true,
          autoHide: true,
          zIndex: 2048,
          offset: -40,
        });
      });
    </script>
    <div class="limiter" id="limiter">
      <div class="container-login100">
        <div class="wrap-login100" style="position: relative;">
          <span style="position: absolute; right: 0; top: 0; padding: 5px 10px;" onclick='$("#limiter").toggleClass("limiter-show")'>x</span>
          <span class="login100-form-title" style="padding-bottom: 0;">Neuen Termin hinzufügen</span>
          <form action="insert.php?valid=1" method="POST" enctype="multipart/form-data" style="width: 100%; margin-top: 4%;">
            <!--<label><i class="fas fa-image fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Titelbild</b></label>
              <input type="file" name="file-7" id="file-7" class="inputfile inputfile-6" accept="image/*"/>
            <label for="file-7"><span></span> <strong><center> Bild hochladen</center></strong></label>
            <hr>-->
            <label><i class="fas fa-list fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Allgemein</b></label>
            <div class="margin-left">
              <div class="input-effect"><input class="effect-20" type="text" name="title" placeholder="Titel*" required><span class="focus-border"><i></i></span></div>
              <div class="input-effect"><input class="effect-20" type="text" name="note" placeholder="Notiz"><span class="focus-border"><i></i></span></div>
              <div class="input-effect"><input class="effect-20" type="text" name="location" placeholder="Ort"><span class="focus-border"><i></i></span></div></br>
            </div>
            <hr>
              <label><i class="fa fa-calendar-alt fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Zeitraum</b></label>
              <div class="w3-padding w3-margin-left">
                <label>Start</label>
                <div class="input-effect"><input class="effect-20" type="text" data-toggle="datepicker-start" name="datestart" required><span class="focus-border"><i></i></span></div>
                <div class="input-effect-49 input-left input-margin-right-1"><input class="effect-20 effect-50" type="number" min="0" max="23" name="hourstart" placeholder="Stunde" value="<?php echo date_format(date_create(), 'H') ?>"><span class="focus-border"><i></i></span></div>
                <div class="input-effect-49 input-left input-margin-right-1"><input class="effect-20 effect-50" type="number" min="0" max="59" name="minutestart" placeholder="Minute" value="<?php echo date_format(date_create(), 'i') ?>"><span class="focus-border"><i></i></span></div>
              </div>
              </br>
              </br>
              <div class="w3-padding w3-margin-left w3-margin-top">
                <label>Ende</label>
                <div class="input-effect"><input class="effect-20" type="text" data-toggle="datepicker-end" name="dateend" required><span class="focus-border"><i></i></span></div>
                <div class="input-effect-49 input-left input-margin-right-1"><input class="effect-20 effect-50" type="number" min="0" max="23" name="hourend" placeholder="Stunde" value="<?php echo date_format(date_create(), 'H') ?>"><span class="focus-border"><i></i></span></div>
                <div class="input-effect-49 input-left input-margin-right-1"><input class="effect-20 effect-50" type="number" min="0" max="59" name="minuteend" placeholder="Minute" value="<?php echo date_format(date_create(), 'i') ?>"><span class="focus-border"><i></i></span></div>
              </div>
              <div style="margin-left: 32px">
                <p><input class="w3-check" type="checkbox" name="full_day" onclick='$(".input-left").toggleClass("input-disabled")'> <label>Ganztägig</label></p>
              </div>
              <hr>
              <label><i class="fas fa-palette fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Farbe</b></label>
              <div class="input-effect">
                <select class="effect-20" onchange="changeselectcolor()" name="color">
                  <option selected class="w3-white">Keine</option>
                  <option value="red" class="w3-red">Rot</option>
                  <option value="pink" class="w3-pink">Pink</option>
                  <option value="purple" class="w3-purple">Lila</option>
                  <option value="deep-purple" class="w3-deep-purple">Dunkel Lila</option>
                  <option value="indigo" class="w3-indigo">Indigo</option>
                  <option value="blue" class="w3-blue">Blau</option>
                  <option value="light-blue" class="w3-light-blue">Helles Blau</option>
                  <option value="cyan" class="w3-cyan">Cyan</option>
                  <option value="aqua" class="w3-aqua">Aqua</option>
                  <option value="teal" class="w3-teal">Teal</option>
                  <option value="green" class="w3-green">Grün</option>
                  <option value="light-green" class="w3-light-green">Helles Grün</option>
                  <option value="lime" class="w3-lime">Lime</option>
                  <option value="sand" class="w3-sand">Sand</option>
                  <option value="khaki" class="w3-khaki">Khaki</option>
                  <option value="yellow" class="w3-yellow">Gelb</option>
                  <option value="amber" class="w3-amber">Amber</option>
                  <option value="orange" class="w3-orange">Orange</option>
                  <option value="deep-orange" class="w3-deep-orange">Dunkeles Orange</option>
                  <option value="blue-gray" class="w3-blue-gray">Blau/Grau</option>
                  <option value="brown" class="w3-brown">Braun</option>
                  <option value="light-gray" class="w3-light-gray">Helles Grau</option>
                  <option value="gray" class="w3-gray">Grau</option>
                  <option value="dark-gray" class="w3-dark-gray">Dunkeles Grau</option>
                  <option value="pale-red" class="w3-pale-red">Blasses Rot</option>
                  <option value="pale-yellow" class="w3-pale-yellow">Blasses Gelb</option>
                  <option value="pale-green" class="w3-pale-green">Blasses Grün</option>
                  <option value="pale-blue" class="w3-pale-blue">Blasses Blau</option>
                </select>
                <span class="focus-border"><i></i></span>
              </div>
              <script type="text/javascript">
                function changeselectcolor(){
                  document.getElementsByTagName('select')[0].className = "effect-20 w3-"+document.getElementsByTagName('select')[0].value;
                }
              </script>
              <hr>
              <!--<label><i class="fas fa-retweet fa-fw w3-margin-right w3-large w3-text-teal"></i><b>Wiederholung</b></label></br>
              <div class="w3-container">
                  <div>
                        <input class="w3-check" type="radio" name="repeat" value="off" checked> Keine Wiederholung</input></br>
                        <input class="w3-check" type="radio" name="repeat" value="on"> Wiederholung</input>
                  </div>
                  <div>

                  </div>
              </div>
              <hr>-->
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
                    echo '><a href="../profil/?id='.$row["id"].'" style="text-decoration: none;" class="w3-hover-text-blue"> '.$row["name"].'</a></input></br>';
                  }
                ?>
            </div>
            <div class="w3-center w3-padding">
              <button class="w3-btn w3-border w3-border-green w3-hover-border-black w3-pale-green w3-hover-green w3-margin"><i class="far fa-save"></i></button>
              <button type="button" class="w3-btn w3-border w3-border-red w3-hover-border-black w3-pale-red w3-hover-red w3-margin" onclick='$("#limiter").toggleClass("limiter-show")'><i class="fa fa-times"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="limiter" id="limiter1">
      <div class="container-login100">
        <div class="wrap-login100" style="position: relative;">
          <span style="position: absolute; right: 0; top: 0; padding: 5px 10px;" onclick='$("#limiter1").toggleClass("limiter-show")'>x</span>
          <span class="login100-form-title" style="padding-bottom: 0;">Termin Info</span>
          <div id="txtHint1" style="width: 100%;"></div>
        </div>
      </div>
    </div>
    <div class="limiter" id="limiter2">
      <div class="container-login100">
        <div class="wrap-login100" style="position: relative;">
          <span style="position: absolute; right: 0; top: 0; padding: 5px 10px;" onclick='$("#limiter2").toggleClass("limiter-show")'>x</span>
          <span class="login100-form-title" style="padding-bottom: 0;">Termin bearbeiten</span>
          <div id="txtHint2" style="width: 100%;"></div>
        </div>
      </div>
    </div>
    <div class="limiter" id="limiter3">
      <div class="container-login100">
        <div class="wrap-login100" style="position: relative;">
          <span style="position: absolute; right: 0; top: 0; padding: 5px 10px;" onclick='$("#limiter3").toggleClass("limiter-show")'>x</span>
          <span class="login100-form-title" style="padding-bottom: 0;">Benutzer Info</span>
          <div id="txtHint3" style="width: 100%;"></div>
        </div>
      </div>
    </div>
    <div class="limiter" id="limiter4">
      <div class="container-login100">
        <div class="wrap-login100" style="position: relative;">
          <span style="position: absolute; right: 0; top: 0; padding: 5px 10px;" onclick='$("#limiter4").toggleClass("limiter-show")'>x</span>
          <span class="login100-form-title" style="padding-bottom: 0;">Benutzer bearbeiten</span>
          <div id="txtHint4" style="width: 100%;"></div>
        </div>
      </div>
    </div>
    <div class="limiter" id="limiter5">
      <div class="container-login100">
        <div class="wrap-login100" style="position: relative;">
          <span style="position: absolute; right: 0; top: 0; padding: 5px 10px;" onclick='$("#limiter5").toggleClass("limiter-show")'>x</span>
          <span class="login100-form-title" style="padding-bottom: 0; color: red;">Überschneidung festgestellt</span>
          <div id="txtHint5" style="width: 100%;"></div>
        </div>
      </div>
    </div>
    <div class="limiter" id="limiter6">
      <div class="container-login100">
        <div class="wrap-login100" style="position: relative;">
          <span style="position: absolute; right: 0; top: 0; padding: 5px 10px;" onclick='$("#limiter6").toggleClass("limiter-show")'>x</span>
          <span class="login100-form-title" style="padding-bottom: 0;">Termin löschen</span>
          <div id="txtHint6" style="width: 100%;"></div>
        </div>
      </div>
    </div>
    <div class="limiter" id="limiter7">
      <div class="container-login100">
        <div class="wrap-login100" style="position: relative;">
            <span style="position: absolute; right: 0; top: 0; padding: 5px 10px;" onclick='$("#limiter7").toggleClass("limiter-show")'>x</span>
            <span class="login100-form-title" style="padding-bottom: 0;">Gruppen</span>
            
            <div id="txtHint7" style="width: 100%;"></div>
        </div>
      </div>
    </div>
    <script>
    function showInfo(str) {
      var xhttp;
      if (str == "") {
        document.getElementById("txtHint1").innerHTML = "";
        return;
      }
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint1").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "sources/getinfo.php?q="+str, true);
      xhttp.send();
    }
    function EditInfo(str) {
      var xhttp;
      if (str == "") {
        document.getElementById("txtHint2").innerHTML = "";
        return;
      }
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint2").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "sources/editinfo.php?q="+str, true);
      xhttp.send();
    }
    function ShowProfInfo(str) {
      var xhttp;
      if (str == "") {
        document.getElementById("txtHint3").innerHTML = "";
        return;
      }
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint3").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "sources/getprofinfo.php?q="+str, true);
      xhttp.send();
    }
    function EditProfInfo(str) {
      var xhttp;
      if (str == "") {
        document.getElementById("txtHint4").innerHTML = "";
        return;
      }
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint4").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "sources/editprofinfo.php?q="+str, true);
      xhttp.send();
    }
    function OverLapInfo(str) {
      var xhttp;
      if (str == "") {
        document.getElementById("txtHint5").innerHTML = "";
        return;
      }
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint5").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "sources/overlapinfo.php?q="+str, true);
      xhttp.send();
    }
    function AskDelete(str) {
      var xhttp;
      if (str == "") {
        document.getElementById("txtHint6").innerHTML = "";
        return;
      }
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint6").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "sources/askdelete.php?q="+str, true);
      xhttp.send();
    }
    function GroupsOverview(str) {
      var xhttp;
      if (str == "") {
        document.getElementById("txtHint7").innerHTML = "";
        return;
      }
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint7").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "sources/groupsov.php?q="+str, true);
      xhttp.send();
    }
    function GroupInfo(str) {
      var xhttp;
      if (str == "") {
        document.getElementById("txtHint7").innerHTML = "";
        return;
      }
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint7").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "sources/getgroupinfo.php?q="+str, true);
      xhttp.send();
    }
    </script>
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
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("txtHintgroup").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHintgroup").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "sources/getgroupnames.php?q=" + str, true);
            xmlhttp.send();
        }
    }
  </script>
</html>
