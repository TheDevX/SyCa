<div class="w3-container">
    <p class="w3-large"><b><i class="fa fa-info fa-fw w3-margin-right w3-text-teal"></i>Anstehende Termine</b></p>
    <div class="cards-next-termins">
      <div class="cards-scroll">
        <?php
        if($_SESSION["userrang"] >= 2){
            $sql = "SELECT * FROM termine WHERE (start_time >= curdate()) LIMIT 5";
          }
          else{
            $sql = "SELECT * FROM termine WHERE (start_time >= curdate()) OR (FIND_IN_SET(".$_SESSION['userid'].", read_allowed_for) OR FIND_IN_SET(".$_SESSION['userid'].", edit_allowed_for)) LIMIT 5";
          }
          foreach ($pdo->query($sql) as $row) {
              $haveterminsgenerall = 1;
              ?>
              <span onclick='$("#limiter1").toggleClass("limiter-show"); showInfo(<?php echo $row["id"]; ?>)'>
                <div class="card card-white">
                  <?php if(!empty($row["color"])){
                    echo '<div class="color w3-'.$row["color"].'"></div>';
                  }
                  ?>
                  <div class="title"><?php echo $row["title"]; ?></div>
                </div>
              </span>
              <?php
          }
          if(!isset($haveterminsgenerall)){
            echo '<i>Keine Termine gefunden.</i></br>';
          }
        ?>
    </div>
  </div>
</div>
