<?php
require("conn.php");

$ID = $_SESSION['ID'];

$data = $_POST;
$taskID = $_GET['taskID'];
$title = $data['title'];
$dateStart = $data['dateStart'];
$dateStop = $data['dateStop'];
$timeStart = $data['timeStart'];
$timeStop = $data['timeStop'];
$details = $data['details'];
$isFolder = (array_key_exists('isFolder', $data)) ? $data['isFolder'] : 0;
$fID = $data['folderID'];
$color = $data['color'];

// Sanitize input

if ($dateStart == "" || $dateStart == NULL) {
   $dateStart = "1970-01-1";
} else {
  $check_date_format = date_parse_from_format("Y-n-j", $dateStart);
  checkdate($check_date_format['month'], $check_date_format['day'], $check_date_format['year']);
}

if ($dateStop == "" || $dateStop == NULL) {
   $dateStop = "1970-01-1";
} else {
  $check_date_format = date_parse_from_format("Y-n-j",$dateStop);
  checkdate($check_date_format['month'], $check_date_format['day'], $check_date_format['year']);
}

if ($timeStart == "" || $timeStart == NULL) {
   $timeStart = "00:00:00";
}

if ($timeStop == "" || $timeStop == NULL) {
   $timeStop = "00:00:00";
}

if ($isFolder != '') {
   $sql = "UPDATE `tasks` 
   	   SET `taskName` = '$title',
	   `taskDetails` = '$details',
	   `dateStart` = '$dateStart',
	   `dateStop` = '$dateStop',
	   `timeStart` = '$timeStart',
	   `timeStop` = '$timeStop',
	   `isFolder` = '$isFolder',
	   `fID` = '$taskID',
	   `color` = '$color'
	   WHERE `tasks`.`taskID` = $taskID ";
} else {
  $sql = "UPDATE `tasks` 
   	   SET `taskName` = '$title',
	   `taskDetails` = '$details',
	   `dateStart` = '$dateStart',
	   `dateStop` = '$dateStop',
	   `timeStart` = '$timeStart',
	   `timeStop` = '$timeStop',
	   `isFolder` = '$isFolder',
	   `fID` = '$fID',
	   `color` = '$color'
	   WHERE `tasks`.`taskID` = $taskID ";
}

$conn -> query($sql);

header("Location: taskview.php");


?>
