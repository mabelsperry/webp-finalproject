<!DOCTYPE html>
<html lang="en">
  <?php
   require("conn.php");
    require("acquireid.php");
    require("tv.php");
   ?>
  <head>
    <meta charset="utf-8">
    <link href="normalize.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="stylesheet.css"  type="text/css"/>
    <!-- NEED TO IMPORT THIS: https://code.jquery.com/jquery-3.6.0.js -->
    <script src="jquery-3.6.0.js"></script>
    <title>Add Task</title>
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <body>

    <script type="text/javascript">
      function assign(link) {
          window.location.assign(link);
      }
    </script>

    <div class="AddTasksidebar">
      <a href="taskview.php" class="myButton">Task List</a>
      <a href="calendarview.php" class="myButton">Calender</a>
      <a href="addtask.php" class="myButton">Add Task</a>
      <a href="logout.php" class="myButton">Logout</a>

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

    <div id="list-content-area">

      <?php
	 $taskID = filter_input(INPUT_GET, 'taskID',FILTER_VALIDATE_INT);
	 if ($taskID !=  FALSE) {
	   $task_stats = $conn->query("SELECT tasks.* FROM tasks WHERE taskID=${taskID}");
	   $task_stats = $task_stats->fetch_assoc();
	} else {
	   $task_stats = array("taskName"=>"", "dateStart"=>"", "dateStop"=>"",
	                       "timeStart"=>"", "timeStop"=>"", "taskDetails"=>"");
	}
	 ?>

      <h1 style="text-align: center;"><?php echo ($taskID !=  FALSE) ? 'Hello ' . $session_name . ', Modify Your' : 'Hello ' . $session_name . ', Add A'; ?> Task.</h1>
      <form
	action="<?php echo ($taskID !=  FALSE) ? "modify_task.php?taskID=${taskID}" : 'insert_task.php'; ?>"
	method="post">
	<style>
	  div {
	      width: 100%;
	      border-radius: 10px;
	      border: 2px solid black;
	      padding: 10px;
	      background-color: rgba(0, 0, 0, 0);
	      font-size: 20px;
	  }

	  input[type=text] {
	      width: 90%;
	      padding: 12px 20px;
	      margin: 8px 0;
	      border: none;
	      border-radius: 4px;
	  }
	</style>
	<script>
	  function checkVal(inpObj, msg) {
	      if (!inpObj.checkValidity()) {
		  msg.innerHTML = "Input invalid :(";
	      } else {
		  msg.innerHTML = "Input valid :)";
	      }
	  }


	  function validateMinDate(inputStart, inputStop, input_msg) {
	      if (inputStop.value < inputStart.value) {
		  input_msg.innerHTML = "Cannot be before start date/time.";
		  inputStop.value = inputStart.value;
	      } else {
		  input_msg.innerHTML = "";
	      }
	  }

	</script>

	<div>

	  <label>Title</label>:
	  <input type="text" placeholder="Please Enter the Title of Your Task." name="title" class="mov"
		 value="<?php echo $task_stats['taskName'] ?>" required><br>
	</div>
	<div>
	  <label>Date Start</label>:
	  <input id="dateStart_input" type="date" name="dateStart" class="mov"
		 value="<?php echo $task_stats['dateStart'] ?>">
	</div>
	<div>
	  <label>Date Stop</label>:
	  <input id="dateStop_input" type="date" name="dateStop" class="mov"
		 value="<?php echo $task_stats['dateStop'] ?>">
	  <span id="dateStop_input_msg"></span>
	  <script>
	    document.getElementById("dateStop_input").addEventListener("change", function() {
		validateMinDate(document.getElementById("dateStart_input"),
				document.getElementById("dateStop_input"),
				document.getElementById("dateStop_input_msg"));
	    });
	  </script>
	</div>
	<div>
	  <label>Time Start</label>:
	  <input id="timeStart_input" type="time" name="timeStart" class="mov"
		 value="<?php echo $task_stats['timeStart'] ?>">
	</div>
	<div>
	  <label>Time Stop</label>:
	  <input id="timeStop_input" type="time" name="timeStop" class="mov"
		 value="<?php echo $task_stats['taskStop'] ?>">
	  <span id="timeStop_input_msg"></span>
	  <script>
	    document.getElementById("timeStop_input").addEventListener("change", function() {
		validateMinDate(document.getElementById("timeStart_input"),
				document.getElementById("timeStop_input"),
				document.getElementById("timeStop_input_msg"));
	    });
	  </script>
	</div>
	<div>
	  <label>Details</label>:
	  <input type="text" placeholder="Please Enter the Details of Your Task." name="details" class="mov"
		 value="<?php echo $task_stats['taskDetails'] ?>"><br>
	</div>
	<input type="submit" value="<?php echo ($taskID !=  FALSE) ? 'Modify' : 'Add'; ?> Task!" id="submit">
      </form>
    </div>


  </body>

</html>
