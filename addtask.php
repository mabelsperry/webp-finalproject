<!DOCTYPE html>
<html lang="en">
  <?php
   require("conn.php");
   ?>
  <head>
    <meta charset="utf-8">
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
    <title>Add Task</title>
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <body>
    <div class="sidebar">
      <div><p><strong><a href="taskview.php">Task List</a></strong></p></div>
      <div><p><strong><a href="calendarview.php">Calendar</a></strong></p></div>
      <a href="addtask.php" class="button button_addtask">+</a>
    </div>
    <div id="list-content-area">
      <h1>Add a Task!</h1>
      <form action="insert_task.php" method="post">
	<style>
	  div {
	      width: 100%;
	      border-radius: 10px;
	      border: 1px dashed black;
	      padding: 10px;
	      background-color: lightgrey;
	      font-size: 20px;
	  }
	</style>
	<div>
	  
	  <label>Title</label>
	  <input type="text" name="title" class="mov" required><br>
	</div>
	<div>
	  <label>Date</label>
	  <input type="text" name="date" class="mov" pattern=""><br>
	</div>
	<div>
	  <label>Time</label>
	  <input type="text" name="time" class="mov"><br>
	</div>
	<div>
	  <label>Details</label>
	  <input type="text" name="details" class="mov"><br>
	</div>
	<input type="submit" value="Add Task!" id="submit">
      </form>
    </div>
    

  </body>

</html>
