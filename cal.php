<?php

require("acquireid.php");

if ($result = $conn->query("SHOW TABLES LIKE 'Calendar' ")) {
     if ($result->num_rows == 0) {
        $cal_create = " CREATE TABLE Calendar (dow VARCHAR(9), year INT(4), month VARCHAR(15), day INT(2), wc INT(10))";    
        $conn->query($cal_create);
			
	$insert = $conn -> prepare("INSERT INTO Calendar (dow, year, month, day, wc) VALUES ( ?, ?, ?, ?, ? )");
        $insert -> bind_param("sisii", $dow, $year, $month, $day, $week_counter);
	$week_counter = 0;
	for($x = 1; $x <= 3650; $x++) {
	
	       $ts = mktime(0, 0, 0, 1, $x, 2021);
               $dow = date("l", $ts);
               $year = date("Y", $ts);
               $month = date("M", $ts);
               $day = date("d", $ts);

	       if ($dow == "Sunday")
	       	  $week_counter++;

	       $insert -> execute();

	}

   }
}

date_default_timezone_set("America/New_York");
	
$year = date("Y");
$month = date("M");
$day = date("d");
$df = 0;
$wc_query = $conn -> query(" SELECT Calendar.wc FROM Calendar
            WHERE Calendar.year = '$year'
            AND Calendar.month = '$month'
            AND Calendar.day = '$day' ");

$row = $wc_query->fetch_assoc();
$wc = $row['wc'];
$wc_end = $wc + 6;
$month_query = $conn -> query(" SELECT Calendar.wc, Calendar.year, Calendar.month, Calendar.day, Calendar.dow
	       	     	        FROM Calendar 
				WHERE Calendar.wc >= $wc AND Calendar.wc <= $wc_end");
      
// Callback function for array filter in printDay.
function isToday($row) {
	 $date1 = date_create($row['dateStart']);
	 $date2 = date_create(date("Y-m-d"));
	 $diff = date_diff($date1, $date2);
	 echo $diff->format("%R%a days");
}

function printDay($q, $t) {
	 $row = $q->fetch_assoc();
         echo " $row[day] ";

	 $todayTasks = array_filter($t, "isToday");
	 foreach ($todayTasks as $row) {
	 	 echo "<div> $row[title] </div>";
	 }
      	 
}



?>