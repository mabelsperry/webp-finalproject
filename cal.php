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

	       if ($dow == "Monday")
	       	  $week_counter++;

	       $insert -> execute();

	}

   }
}



?>