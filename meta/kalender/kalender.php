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
if(date("w", strtotime("01 ".$monthnamesenglish[$month+1]." ".$year)) == "0"){
  $daysnextmonth = -5;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month+1]." ".$year)) == "1"){
  $daysnextmonth = 1;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month+1]." ".$year)) == "2"){
  $daysnextmonth = 0;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month+1]." ".$year)) == "3"){
  $daysnextmonth = -1;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month+1]." ".$year)) == "4"){
  $daysnextmonth = -2;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month+1]." ".$year)) == "5"){
  $daysnextmonth = -3;
}
if(date("w", strtotime("01 ".$monthnamesenglish[$month+1]." ".$year)) == "6"){
  $daysnextmonth = -4;
}
if($days < 0){
  $dayscalc = $days * -1;
}
else{
  $dayscalc = $days;
}
if($daysnextmonth < 0){
  $daysnextmonthcalc = $days * -1;
}
else{
  $daysnextmonthcalc = $daysnextmonth;
}
$rows = ceil(($countdays+$dayscalc+$daysnextmonthcalc)/7);
if(is_int(($dayscalc + 1 + $countdays)/7)/2){
  $rows++;
}
?>
<table class="calender">
  <section class="table-header">
    <span class="table-previous">
      <a style ="text-decoration: none;" href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} echo "&month=".$month; echo "&year=".($year-1); if(isset($_GET["showspecialpersons"])){echo "action=".$_GET["showspecialpersons"];}?>">
        < <?php echo $year-1; ?>
      </a>
    </span>
    <?php echo $year; ?>
    <span class="table-next">
      <a style ="text-decoration: none;" href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} echo "&month=".$month; echo "&year=".($year+1); if(isset($_GET["showspecialpersons"])){echo "action=".$_GET["showspecialpersons"];}?>">
        <?php echo $year+1; ?> >
      </a>
    </span>
  </section>
  <section class="table-header">
    <span class="table-previous">
      <a style ="text-decoration: none;" href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} if($month == 1){echo "&month=12&year=".($year-1);} else{echo "&month=".($month-1)."&year=".($year);} if(isset($_GET["showspecialpersons"])){echo "action=".$_GET["showspecialpersons"];}?>">
        < <?php echo $monthnames[$month-1]; ?>
      </a>
    </span>
    <?php echo $monthnames[$month]; ?>
    <span class="table-next">
      <a style ="text-decoration: none;" href="?<?php if(isset($_GET["id"])){echo "id=".$_GET["id"];} if($month == 12){echo "&month=1&year=".($year+1);} else{echo "&month=".($month+1)."&year=".($year);} if(isset($_GET["showspecialpersons"])){echo "action=".$_GET["showspecialpersons"];}?>">
        <?php echo $monthnames[$month+1]; ?> >
      </a>
    </span>
  </section>
  <tr class="table-title">
    <th class="day"><?php echo $daynames[1]; ?></th>
    <th class="day"><?php echo $daynames[2]; ?></th>
    <th class="day"><?php echo $daynames[3]; ?></th>
    <th class="day"><?php echo $daynames[4]; ?></th>
    <th class="day"><?php echo $daynames[5]; ?></th>
    <th class="day"><?php echo $daynames[6]; ?></th>
    <th class="day"><?php echo $daynames[0]; ?></th>
  </tr>
  <?php for($countrows=0; $countrows < $rows; $countrows++){
    ?>
    <tr class="day-row">
      <?php
      for($daysthisrow = 1; $daysthisrow <= 7; $daysthisrow++){
            echo '<td class="table-day ';
            if(date("j-n-Y") == $days."-".$month."-".$year){
              echo 'table-day-today ';
            }
            $calcmonth = $month;
            $calcyear = $year;
            if($days <= 0 || $days > $countdays){
              echo 'last-month ';
              if($days <= 0){
                if($month == 1){
                  $calcmonth = 12;
                  $calcyear = $calcyear - 1;
                }
                else{
                  $calcmonth = $calcmonth - 1;
                }
                $showday = cal_days_in_month(CAL_GREGORIAN, $calcmonth, $calcyear) + $days;
              }
              if($days > $countdays){
                if($month == 12){
                  $calcmonth = 1;
                  $calcyear = $calcyear + 1;
                }
                $showday = -cal_days_in_month(CAL_GREGORIAN, $month, $calcyear) + $days;
              }
            }
            else{
              $showday = $days;
            }
            echo '"><div class="day-card">';
              echo '<span class="day-date">'.$showday.'</span>'; ?>
                    <button class="plus-btn" onclick="setdateandshow(<?php echo $showday.",".($calcmonth-1).",".$calcyear; ?>)">+</button>
                    <script>
                    function setdateandshow(day,month,year){
                      $("[data-toggle='datepicker-end']").datepicker('setDate', new Date(year, month, day));
                      $("[data-toggle='datepicker-start']").datepicker('setDate', new Date(year, month, day));
                      $('#limiter').toggleClass('limiter-show')
                    }
                    </script>
                    <?php
              echo '<div class="cards">';
                echo '<div class="cards-scroll">';
                  if($_SESSION["userrang"] >= 2){
                    $sql = "SELECT * FROM termine";
                  }
                  else{
                    $sql = "SELECT * FROM termine WHERE FIND_IN_SET(".$_SESSION['userid'].", read_allowed_for) OR FIND_IN_SET(".$_SESSION['userid'].", edit_allowed_for)";
                  }
                  foreach ($pdo->query($sql) as $row) {
                    $readallowed = explode(",", $row["read_allowed_for"]);
                    $editallowed = explode(",", $row["edit_allowed_for"]);
                    if(in_array($_SESSION["userid"], $readallowed) || in_array($_SESSION["userid"], $editallowed) || $_SESSION["userrang"] == 2){
                      if(date("Y-m-d", strtotime($row["start_time"])) == date("Y-m-d", strtotime($calcyear."-".$calcmonth."-".$showday))){
                        ?>
                        <span onclick='$("#limiter1").toggleClass("limiter-show"); showInfo(<?php echo $row["id"]; ?>)'>
                          <div class="card">
                            <?php if(!empty($row["color"])){
                              echo '<div class="color w3-'.$row["color"].'"></div>';
                            }
                            ?>
                            <div class="title"><?php echo $row["title"]; ?></div>
                          </div>
                        </span>
                        <?php
                      }
                    }
                  }
              echo '</div>';
            echo '</div>';
            $days++;
            ?>
          </div>
        </td>
        <?php
        }
        ?>
    </tr>
    <?php
  }
  ?>
</table>
<script>
$('.day-row').height(($(window).height()*0.95-46-46-33)/<?php echo $rows; ?>);
</script>
