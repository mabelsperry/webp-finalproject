<!DOCTYPE html>
<html lang="en">

  <?php
   $GLOBALS['viewdate'] = $_GET['viewdate'];
   require("cal.php");
   ?>

  <head>
    <meta charset="utf-8">
    <link href="normalize.css" rel="stylesheet" type="text/css"/>
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
    <!-- NEED TO IMPORT THIS: https://code.jquery.com/jquery-3.6.0.js -->
    <script src="jquery-3.6.0.js"></script>
    <title>Calendar View</title>

    <script type="text/javascript">
      function assign(link) {
         window.location.assign(link);
        }
    </script>

  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <body>

    <div class="sidebar">

      <button id="task_list_div" class="myButton">Task List</button>
      <button id="cal_div" class="myButton">Calendar</button>
      <button id="button_addtask" class="myButton">Add Task</button>
      <button id="button_logout" class="myButton">Logout</button>

      <script type="text/javascript">
	$("#task_list_div").click(function() {assign("taskview.php");});
	$("#cal_div").click(function() {
	    let d = new Date(Date.now());
	    assign("calendarview.php?viewdate=" + d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate());
	});
	$("#button_addtask").click(function() {assign("addtask.php");});
	$("#button_logout").click(function() {assign("logout.php");});
      </script>
    </div>

    <?php $tasks_as_assoc_array = $tasks->fetch_all(MYSQLI_ASSOC); ?>

    <div id="cal-control">

      <h1 style="text-align: center;"><?php
	   $d = date_create($viewdate);
	   echo date_format($d, "M-Y");
	   ?></h1>
      <button class="CalButton" id="sub_month">Previous Month</button>
      <button class="CalButton" id="add_month">Next Month</button>

      <script type="text/javascript">
	$("#sub_month").click( function() {
	    let d = new Date("<?php echo $_GET['viewdate'] ?>" );
	    d.setMonth(d.getMonth() - 1);
	    assign("?viewdate=" + d.getFullYear() + "-" + (d.getMonth()+1) + "-" + (d.getDate()+1));
	});
	$("#add_month").click( function() {
	    let d = new Date("<?php echo $_GET['viewdate'] ?>");
	    d.setMonth(d.getMonth() + 1);
	    assign("?viewdate=" + d.getFullYear() + "-" + (d.getMonth()+1) + "-" + (d.getDate()+1));
	});
      </script>
    </div>
    <div id="cal-content-area">

      <!-- printDay method is located in cal.php. There's a foreach method that echos the HTML code
	   that handles how the individual tasks should look.-->

      <?php printDay($month_query, $tasks_as_assoc_array); ?>

    </div>

  </body>

</html>
