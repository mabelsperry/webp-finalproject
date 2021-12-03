<?php

$stm1 = $conn -> prepare(" SELECT userID FROM users WHERE username = ? ");
$stm1 -> bind_param("s", $session_name);
$session_name = $_SESSION["name"];

$stm1 -> execute();
$result1 = $stm1 -> get_result();
$ID = $result1->fetch_assoc();
// print_r($ID['userID']);

// Validate that userID is an int.
if (filter_var($ID['userID'], FILTER_VALIDATE_INT) === 0 ||
!filter_var($ID['userID'], FILTER_VALIDATE_INT) === false) {

$stm2 = $conn ->
prepare(" SELECT tasks.*, users.userID 
FROM tasks LEFT JOIN users ON tasks.userID = users.userID 
WHERE users.userID = ? ");
$stm2 -> bind_param("i", $ID['userID']);

$result2 = $stm2 -> execute();
$tasks = $stm2 -> get_result();

}

if ($result = $conn->query("SHOW TABLES LIKE 'Calendar' ")) {
     if ($result->num_rows == 0) {
        $cal_create = " CREATE TABLE Calendar (dow VARCHAR(9), year INT(4), month VARCHAR(15), day INT(2))";    
        $conn->query($cal_create);
			
	$insert = $conn -> prepare("INSERT INTO Calendar (dow, year, month, day) VALUES ( ?, ?, ?, ? )");
        $insert -> bind_param("sisi", $dow, $year, $month, $day);
	
	for($x = 1; $x <= 3650; $x++) {
	
	       $ts = mktime(0, 0, 0, 1, $x, 2021);
               $dow = date("l", $ts);
               $year = date("Y", $ts);
               $month = date("M", $ts);
               $day = date("d", $ts);
	       $insert -> execute();

	}

   }
}

?>