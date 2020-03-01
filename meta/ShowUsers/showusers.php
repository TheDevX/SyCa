<?php
if($_SESSION["userrang"] >= 2){
?>
<div class="w3-container">
  <hr>
  <p class="w3-large"><b><i class="fas fa-users w3-margin-right w3-text-teal"></i>Anzuzeigende Benutzer</b></p>
    <form class="w3-margin" method="POST" action="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} ?>&action=showspecialpersons">
    <?php
    if(isset($_GET["action"])){
      if($_GET["action"] == "showspecialpersons"){
        $shownow = array();
        $sql = "SELECT * FROM users";
        foreach ($pdo->query($sql) as $row) {
          if(isset($_POST["idtoshow".$row["id"]])){
            if($_POST["idtoshow".$row["id"]] == "on"){
              $shownow[] = $row["id"];
            }
          }
        }
        $_SESSION["showusersinkal"] = implode(",", $shownow);
      }
    }
      $users = array();
      $sql = "SELECT * FROM users";
      foreach ($pdo->query($sql) as $row) {
        $checked = 0;
        if(isset($_SESSION["showusersinkal"])){
          $showusersinkalender = explode(",", $_SESSION["showusersinkal"]);
            if(in_array($row["id"], $showusersinkalender)){
              $users[] = $row["id"];
              $checked = 1;
            }
        }
        echo '<input class="w3-check" type="checkbox" name="idtoshow'.$row["id"].'"';
        if($row["id"] == $_SESSION["userid"]){
          echo "checked='checked' disabled ";
        }
        if($checked == 1){
          echo "checked='checked'";
        }
        echo '>';
        ?>
        <span class="w3-hover-text-blue" onclick='$("#limiter3").toggleClass("limiter-show"); ShowProfInfo(<?php echo $row["id"]; ?>)'><?php echo $row["name"].'</span></input><br>';
      }
    ?>
    <div class="w3-center w3-padding">
      <button type="submit" class="w3-btn w3-border w3-border-green w3-hover-border-black w3-pale-green w3-hover-green w3-margin"><i class="fas fa-user-check"></i></button>
    </div>
  </form>
</div>
<?php
}
?>
