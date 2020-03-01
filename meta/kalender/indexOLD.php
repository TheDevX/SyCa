<?php
session_start();
include_once '../meta/copyright/messageincode.html';

?>
<!DOCTYPE html>
<html>
<title>Kalender | SyCa</title>
<?php
include_once '../meta/head/head.php';
?>
<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-margin-top">

  <!-- The Grid -->
  <div class="w3-row-padding">

    <!-- Right Column -->
    <div class="w3-rest w3-card-4 w3-border">

      <div style="min-width: 100%; min-height: 100%;" class="w3-white w3-text-grey">
        <table style="width: 100%; height: 100%;" class="w3-table w3-bordered w3-striped w3-centered">
          <tr>
            <th>Zeit</th>
            <th>Montag</th>
            <th>Dienstag</th>
            <th>Mittwoch</th>
            <th>Donnerstag</th>
            <th>Freitag</th>
            <th>Samstag</th>
            <th>Sonntag</th>
          </tr>
          <?php
          for ($i=0; $i < 24; $i++) {
            ?>
            <tr>
              <td><?php if(strlen($i)>1){echo $i.":00";}else{echo "0".$i.":00";} ?></th>
              <td day="montag" time="<?php echo $i; ?>"></td>
              <td day="dienstag" time="<?php echo $i; ?>"></td>
              <td day="mittwoch" time="<?php echo $i; ?>"></td>
              <td day="donnerstag" time="<?php echo $i; ?>"></td>
              <td day="freitag" time="<?php echo $i; ?>"></td>
              <td day="samstag" time="<?php echo $i; ?>"></td>
              <td day="sonntag" time="<?php echo $i; ?>"></td>
            </tr>
            <?php
          }
          ?>
        </table>
      </div>
    <!-- End Right Column -->
    </div>


  <!-- End Grid -->
  </div>

  <!-- End Page Container -->
</div>

<?php
include_once '../meta/footer/footer.php';
?>

</body>
</html>
