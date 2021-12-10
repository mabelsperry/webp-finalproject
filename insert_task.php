<?php
require("conn.php");

$ID = $_SESSION["ID"];

$data = $_POST;
$title = $data["title"];
$dateStart = $data["dateStart"];
$dateStop = $data["dateStop"];
$timeStart = $data["timeStart"];
$timeStop = $data["timeStop"];
$details = $data["details"];
$folderID = $data["folderID"];
$color = $data["color"];

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


$sql = "INSERT INTO `tasks` (`userID`, `taskName`, `taskDetails`, `dateStart`, `dateStop`, `timeStart`, `timeStop`, `fID`, `color`)
        VALUES ('$ID', '$title', '$details', '$dateStart', '$dateStop','$timeStart', '$timeStop', '$folderID', '$color')";

$conn -> query($sql);

header("Location: taskview.php");


?>