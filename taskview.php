<!DOCTYPE html>
<html lang="en">

  <?php
   require("conn.php");
   require("acquireid.php");

   
   ?>
  
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
    <div class="sidebar">
      <div><p><strong><a href="taskview.php">Task List</a></strong></p></div>
      <div><p><strong><a href="calendarview.php">Calendar</a></strong></p></div>
      <a href="addtask.php" class="button button_addtask">+</a>
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
