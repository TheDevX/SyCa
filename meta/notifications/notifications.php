<?php
include_once '../meta/sql/pdoconecction.php';
$statement = $pdo->prepare("SELECT * FROM notifications");
$statement->execute();
if($statement->rowCount() != 0 && $_SESSION["userrang"] >= 3){
?>
  <div class="w3-padding">
    <?php
    $sql = "SELECT * FROM notifications";
    $i = 0;
    foreach ($pdo->query($sql) as $row) {
      if($row["level"] == 3){
        $color = "red";
      }
      if($row["level"] == 2){
        $color = "yellow";
      }
      if($row["level"] == 1){
        $color = "blue";
      }
      if($row["level"] == 0){
        $color = "green";
      }
      ?>
      <span onclick='$("#limiter5").toggleClass("limiter-show"); OverLapInfo(<?php echo $row["link"]; ?>)'>
        <p class="w3-margin-top w3-margin-bottom w3-leftbar w3-rightbar w3-border-<?php echo $color; ?> w3-padding w3-margin w3-pale-<?php echo $color; ?> w3-hover-border-black w3-hover-<?php echo $color; ?> w3-border" id="error<?php echo $i; ?>">
          <?php echo $row["message"]; ?>
        </p>
      </span>
      <?php
      $i++;
    }
    ?>
  </div>
  <hr>
<?php
}
?>
