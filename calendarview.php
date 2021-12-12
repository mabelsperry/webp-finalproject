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

    <div class="newTasksidebar">
      <div id="task_list_div" class="myButton"><span><strong>Task List</strong></span></div>
      <div id="cal_div" class="myButton"><span><strong>Calendar</strong></span></div>
      <div id="button_addtask" class="myButton"><span><strong>Add Task</strong></span></div>
      <div id="button_logout" class="myButton"><span><strong>Logout</strong></span></div>

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

      <h1 style="text-align: center; width: 100%;"><?php
	   $d = date_create($viewdate);
	   echo date_format($d, "M-Y");
	   ?></h1><br>
      <div class="CalButton" id="sub_month">Previous Month</div>
      <div class="CalButton" id="add_month">Next Month</div>

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
