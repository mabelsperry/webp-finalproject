<?php
require("conn.php");

$ID = $_SESSION["ID"];

$data = $_POST;
$title = $data["title"];
$date = $data["date"];
$time = $data["time"];
$details = $data["details"];

$sql = "INSERT INTO `tasks` (`userID`, `taskName`, `taskDetails`, `dateStart`, `timeStart` )
        VALUES ('$ID', '$title', '$details', NULL, NULL)";

$conn -> query($sql);

header("Location: taskview.php");


?>