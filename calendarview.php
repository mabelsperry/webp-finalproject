<!DOCTYPE html>
<html lang="en">

<?php
 
     require('conn.php');
     require('cal.php');

?>

  <head>
    <meta charset="utf-8">
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
    <title>Calendar View</title>
    
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <body>
    

      <div class="greetings-box">
	<h1>Hello, <?php echo $session_name ?></h1>
      </div>

    
    <div class="sidebar">
      <div><p><strong><a href="taskview.php">Task List</a></strong></p></div>
      <div><p><strong><a href="calendarview.php">Calendar</a></strong></p></div>
      <a href="addtask.php" class="button button_addtask">+</a>
    </div>

    <div id="cal-content-area">
      <?php echo date("Y-M-d"); ?>
      
      <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>  <div></div>
      <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>  <div></div>
      <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>  <div></div>
      <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>  <div></div>
      <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>  <div></div> 
    </div>
    
  </body>
  
</html>
