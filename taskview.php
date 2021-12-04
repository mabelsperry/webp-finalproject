<!DOCTYPE html>
<html lang="en">

  <?php require("acquireid.php"); ?>
  
  <head>
    <meta charset="utf-8">
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
    <title>List View</title>
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <div class="greetings-box">
    <h1>Hello, <?php echo $session_name ?></h1>
  </div>
  
  <body>

    <script type="text/javascript">
      function assign(link) {
         window.location.assign(link);
        }
    </script>
    
    <div class="sidebar">

      <div id="task_list_div"><p><strong>Task List</strong></p></div>
      <div id="cal_div"><p><strong>Calendar</strong></p></div>
      <a href="addtask.php" class="button button_addtask">+</a>

      <script type="text/javascript">
	document.getElementById("task_list_div").addEventListener("click", function() {assign("taskview.php");});
	document.getElementById("cal_div").addEventListener("click", function() {assign("calendarview.php");});
      </script>
    </div>

    <div id="list-content-area">
      <?php
       if ($tasks->num_rows > 0) {
      while ($row = $tasks->fetch_assoc()) { ?>
      <div><p>
	  <strong><?php echo $row['taskName']; ?>:  </strong>
	  <?php echo $row['taskDetails']; ?>
	  <i><?php echo $row['taskID']; ?></i>
	  
      </p></div>
      <?php } }?>
    </div>
  </body>
  
</html>
