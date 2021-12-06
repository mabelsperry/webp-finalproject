<?php

require('conn.php');

$stm1 = $conn -> prepare(" SELECT userID FROM users WHERE username = ? ");
$stm1 -> bind_param("s", $session_name);
$session_name = $_SESSION["name"];
$stm1 -> execute();
$result1 = $stm1 -> get_result();
$ID = $result1->fetch_assoc();
$_SESSION["ID"] = $ID['userID'];;
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
?>