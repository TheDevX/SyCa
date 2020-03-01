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
$sql = "SELECT * FROM groups WHERE id = ".$_GET["q"];
foreach ($pdo->query($sql) as $row) {
    $id = $row["id"];
    $description = $row["description"];
    $name = $row["name"];
    $members = explode(",", $row["members"]);
}
if(!isset($id)) {
  exit('<span style="color: red;">ID nicht gefunden!</span>');
}
?>
<div style="width: 100%; border: 1px black solid; padding: 0% 3% 4%; margin-top: 4%;">
<h2><?php echo $name; ?></h2>
  <div class="w3-container">
    <?php if(!empty($description)){ ?> <p><i class="fa fa-sticky-note fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $description; ?></p><?php } ?>
    <hr>
    <p class="w3-large"><b><i class="fa fa-info fa-fw w3-margin-right w3-text-teal"></i>Weitere Infos</b></p>
    <ul>
        <?php
        $statement = $pdo->prepare("SELECT users.full_name, users.name, users.id FROM users LEFT JOIN groups ON FIND_IN_SET(users.id, groups.members) WHERE FIND_IN_SET(users.id, groups.members)");
        $statement->execute();   
        while($result = $statement->fetch()) {
           ?>
           <li title='<?php echo $result['full_name']; ?>' class='w3-hover-text-blue' style='transition: .2s' onclick='$("#limiter7").toggleClass("limiter-show"); $("#limiter3").toggleClass("limiter-show"); ShowProfInfo(<?php echo $result["id"]; ?>)'><?php echo $result['name']; ?></li>
           <?php
        }
        ?>
    </ul>
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
