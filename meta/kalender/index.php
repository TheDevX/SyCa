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
?>
<!DOCTYPE html>
<html>
<title>Profil | SyCa</title>
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
</body>
</html>
