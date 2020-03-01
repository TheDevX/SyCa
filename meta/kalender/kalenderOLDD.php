<?php
date_default_timezone_set("Europe/Berlin");
if(file_exists('../meta/kalender/arrays.php')){
  include_once '../meta/kalender/arrays.php';
}
else if(file_exists('../kalender/arrays.php')){
  include_once '../kalender/arrays.php';
}
else if(file_exists('../../kalender/arrays.php')){
  include_once '../../kalender/arrays.php';
}
if(isset($_GET["month"])){
  $month = $_GET["month"];
}
else{
  $month = date("n");
}
if(isset($_GET["year"])){
  $year = $_GET["year"];
}
else{
  $year = date("Y");
}
$countdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
if(date("w", strtotime("01 ".$monthnamesenglish[$month]." ".$year)) == "0"){
  $days = -5;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month]." ".$year)) == "1"){
  $days = 1;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month]." ".$year)) == "2"){
  $days = 0;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month]." ".$year)) == "3"){
  $days = -1;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month]." ".$year)) == "4"){
  $days = -2;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month]." ".$year)) == "5"){
  $days = -3;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month]." ".$year)) == "6"){
  $days = -4;
}
$rows = ceil(($countdays+($days*-1))/7)+1;
?>
<!-- Right Column -->
<div class="w3-rest w3-card-4 w3-border" style="font-family: 'Niramit', sans-serif;">

  <div style="min-width: 100%; min-height: 100%;" class="w3-white w3-text-grey">
    <table style="width: 100%; height: 100%;" class="w3-table w3-bordered w3-striped w3-centered">
      <tr>
        <td class="w3-dark-grey" style="text-align: left; width: 15%">
          <a style ="text-decoration: none;" href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} echo "&month=".$month; echo "&year=".($year-1); if(isset($_GET["showspecialpersons"])){echo "action=".$_GET["showspecialpersons"];}?>">
            < <?php echo $year-1; ?>
          </a>
        </td>
        <td class="w3-dark-grey"><?php echo $year; ?></td>
        <td class="w3-dark-grey" style="text-align: right; width: 15%">
          <a style ="text-decoration: none;" href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} echo "&month=".$month; echo "&year=".($year+1); if(isset($_GET["showspecialpersons"])){echo "action=".$_GET["showspecialpersons"];}?>">
            <?php echo $year+1; ?> >
          </a>
        </td>
      </tr>
    </table>
    <table style="width: 100%; height: 100%;" class="w3-table w3-bordered w3-striped w3-centered">
      <tr>
        <td class="w3-dark-grey" style="text-align: left; width: 15%">
          <a style ="text-decoration: none;" href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} if($month == 1){echo "&month=12&year=".($year-1);} else{echo "&month=".($month-1)."&year=".($year);} if(isset($_GET["showspecialpersons"])){echo "action=".$_GET["showspecialpersons"];}?>">
            < <i><?php echo $monthnames[$month-1]; ?></i>
          </a>
        </td>
        <td class="w3-dark-grey"><?php echo $monthnames[$month]; ?></td>
        <td class="w3-dark-grey" style="text-align: right; width: 15%">
          <a style ="text-decoration: none;" href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} if($month == 12){echo "&month=1&year=".($year+1);} else{echo "&month=".($month+1)."&year=".($year);} if(isset($_GET["showspecialpersons"])){echo "action=".$_GET["showspecialpersons"];}?>">
            <i><?php echo $monthnames[$month+1]; ?></i> >
          </a>
        </td>
      </tr>
    </table>
    <div style="overflow: auto;">
      <table style="width: 99.9%; height: 100%;" class="w3-table w3-bordered w3-striped w3-centered">
        <tr>
          <td class="w3-dark-grey" style="width: <?php echo 100/7; ?>%"><?php echo $daynames[1]; ?></td>
          <td class="w3-dark-grey" style="width: <?php echo 100/7; ?>%"><?php echo $daynames[2]; ?></td>
          <td class="w3-dark-grey" style="width: <?php echo 100/7; ?>%"><?php echo $daynames[3]; ?></td>
          <td class="w3-dark-grey" style="width: <?php echo 100/7; ?>%"><?php echo $daynames[4]; ?></td>
          <td class="w3-dark-grey" style="width: <?php echo 100/7; ?>%"><?php echo $daynames[5]; ?></td>
          <td class="w3-dark-grey" style="width: <?php echo 100/7; ?>%"><?php echo $daynames[6]; ?></td>
          <td class="w3-dark-grey" style="width: <?php echo 100/7; ?>%"><?php echo $daynames[0]; ?></td>
        </tr>
        <?php for($countrows=0; $countrows < $rows; $countrows++){
          ?>
          <tr style="height: 100px;">
            <?php
            for($daysthisrow = 1; $daysthisrow <= 7; $daysthisrow++){
                if($days > 0 && $days <= $countdays){
                  if(date("d-m-Y") == $days."-".$month."-".$year){
                    echo '<td class="w3-display-container w3-border w3-pale-blue" style="padding: 0; overflow: auto;" id="div'.$days.'">';
                  }
                  else{
                    echo '<td class="w3-display-container w3-border" style="padding: 0; overflow: auto;" id="div'.$days.'">';
                  }
                  echo '<div class="w3-display-topright" style="margin-right: 2px; margin-top: 2px;">'.$days.'
                  </div>';
                  $sql = "SELECT * FROM termine";
                  ?>
                  <ul class="w3-ul">
                  <?php
                  foreach ($pdo->query($sql) as $row) {
                    $readallowed = explode(",", $row["read_allowed_for"]);
                    $editallowed = explode(",", $row["edit_allowed_for"]);
                    if(in_array($_SESSION["userid"], $readallowed) || in_array($_SESSION["userid"], $editallowed)){
                      if(date("Y-m-d", strtotime($row["start_time"])) == date("Y-m-d", strtotime($year."-".$month."-".$days))){
                        ?>
                        <a href="../termin/?id=<?php echo $row["id"]; echo "&month=".($month); echo "&year=".$year;?>" style="text-decoration: none;"><li style="width: 100%; margin: 0; padding: 0 5px; border: 1px solid black;" class="w3-pale-green w3-hover-green">
                          <p style="text-align: left; margin: 0; padding: 0;"><?php echo $row["title"]; ?></p>
                        </li></a>
                        <?php
                      }
                    }
                  }
                  ?>
                  <style>
                    <?php echo '#add'.$days.' {
                        display: none;
                    }
                    #div'.$days.':hover #add'.$days.' {
                        display: block;
                    }'; ?>
                  </style>
                  <?php
                  echo '<a href="../termin/add.php?day='.$days.'&month='.$month.'&year='.$year.'" style="text-decoration: none;" id="add'.$days.'"><li style="width: 100%; margin: 0; padding: 0 5px; border: 1px solid black;" class="w3-pale-blue w3-hover-blue">
                    <p style="text-align: left; margin: 0; padding: 0;">Termin hinzufügen...</p>
                  </li></a>';
                  ?>
                  </ul>
                  <?php
                }
                else{
                  echo '<td class="w3-display-container w3-border" style="padding: 0"><div style="height: 100%; width: 100%; margin: 0; background-color: grey"></div>';
                }
                $days++;
                ?>
              </td>
              <?php
              }
              ?>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
    <table style="width: 100%; height: 100%;" class="w3-table w3-bordered w3-striped w3-centered">
      <tr>
        <td class="w3-dark-grey" style="text-align: middle;">
          <a style ="text-decoration: none;" href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} echo "&month=".date("m"); echo "&year=".date("Y"); if(isset($_GET["showspecialpersons"])){echo "action=".$_GET["showspecialpersons"];}?>">
            Heute
          </a>
        </td>
      </tr>
    </table>
  </div>
<!-- End Right Column -->
</div>
<?php
/*
if(file_exists('../meta/menu/menu.php')){
  include_once '../meta/menu/menu.php';
}
else if(file_exists('../menu/menu.php')){
  include_once '../menu/menu.php';
}
else if(file_exists('../../meta/menu/menu.php')){
  include_once '../../meta/menu/menu.php';
}
*/
?>
