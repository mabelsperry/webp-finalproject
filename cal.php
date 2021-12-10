<?php

require("acquireid.php");
date_default_timezone_set("America/New_York");

if ($result = $conn->query("SHOW TABLES LIKE 'Calendar' ")) {
     if ($result->num_rows == 0) {
        $cal_create = " CREATE TABLE Calendar (dow VARCHAR(9), year INT(4), month VARCHAR(15), day INT(2), wc INT(10))";    
        $conn->query($cal_create);
			
	$insert = $conn -> prepare("INSERT INTO Calendar (dow, year, month, day, wc) VALUES ( ?, ?, ?, ?, ? )");
        $insert -> bind_param("sisii", $dow, $year, $month, $day, $week_counter);
	$week_counter = 0;
	for($x = 1; $x <= (365 * 50); $x++) {
	
	       $ts = mktime(0, 0, 0, 1, $x, 2010);
               $dow = date("l", $ts);
               $year = date("Y", $ts);
               $month = date("n", $ts);
               $day = date("j", $ts);

	       if ($dow == "Sunday")
	       	  $week_counter++;

	       $insert -> execute();

	}

   }
}




$date = date_create($GLOBALS['viewdate']);

// Get today's date, truncated
$year = date_format($date, "Y");
$month = date_format($date, "n");
$day = date_format($date, "j");

// "Week count query" = finds all weeks associated with a month's display (last days of last month, first of next)
$wc_query = $conn -> query(" SELECT Calendar.wc FROM Calendar
	    	     	     WHERE Calendar.year = '$year'
			     AND Calendar.month = '$month'");

// Section off the six weeks that will be displayed
$row = $wc_query->fetch_assoc();
$wc = $row['wc'];
$wc_end = $wc + 5;

// Query returns every day of the month we are displaying
$month_query = $conn -> query(" SELECT Calendar.wc, Calendar.year, Calendar.month, Calendar.day, Calendar.dow
	       	     		FROM Calendar 
				WHERE Calendar.wc >= $wc AND Calendar.wc <= $wc_end");


function printDayTasks($row, $t) {
	 echo " $row[day] ";

	 $todayTasks = array();

	 // For every existing task for the user, check if it occurs on the current calendar day.
	 // If it does, push it onto $todayTasks.
	 foreach ($t as $task) {
	 	 $date1 = date_create($task['dateStart']);
		 $date2 = date_create($row['year'] . "-" . $row['month'] . "-" . $row['day']);
		 
		 $date1_Str = date_format($date1,"Y-n-j");
		 $date2_Str = date_format($date2,"Y-n-j");
		 		 
		 if (strncasecmp($date1_Str, $date2_Str,10) == 0) {
		    array_push($todayTasks, $task);
		 }
	 	 
	 }

	 // Prints each task on the given day.
	 foreach ($todayTasks as $row) {
	 	 echo "<div style=\"background-color: $row[color]\"id=\"dayTask$task[taskID]\"> $row[taskName] </div>";
		 echo "<script type=\"text/javascript\">
		      $(\"#dayTask$task[taskID]\").click(function() {assign(\"addtask.php?taskID=$task[taskID]\");});
		      </script>";
	 }
      	 
}


function printDay($q, $t) {

	 // While there is a day left in the month query, $f equals that day
	 while ($f = $q->fetch_assoc()) {
	 
	       // If it is outside of the current viewing month, display it darker.
	       if ($f['month'] != date_format(date_create($_GET['viewdate']), "n")) {
               	  echo '<div style="background-color: darkgrey;">';
		  printDayTasks($f, $t);
	    	  echo '</div>';
               } else {
                  echo '<div style="background-color: grey;">';
	          printDayTasks($f, $t);
	          echo '</div>';
               }
         }
}
?>