<?php
  require("conn.php");

  $taskID = filter_input(INPUT_GET, 'taskID',FILTER_VALIDATE_INT);
  echo $taskID;
  if ($taskID == NULL || $taskID ==  FALSE) {
     exit();
  }

  $sql = "DELETE FROM tasks WHERE tasks.taskID = $taskID";
  $row = $conn->query($sql);

  header('Location: taskview.php');
  exit();

?>