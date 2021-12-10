<!DOCTYPE html>
<html lang="en">
  <?php
   require("acquireid.php");
   
   ?>
  <head>
    <meta charset="utf-8">
    <link href="normalize.css" rel="stylesheet" type="text/css"/>
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
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
    
    <div class="sidebar">
      <div id="task_list_div"><p><strong>Task List</strong></p></div>
      <div id="cal_div"><p><strong>Calendar</strong></p></div>
      <button id="button_addtask">+</button>
      <button id="button_logout">L</button>
     
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
      
      <h1><?php echo ($taskID !=  FALSE) ? 'Modify' : 'Add'; ?> Task</h1>
      <form
	action="<?php echo ($taskID !=  FALSE) ? "modify_task.php?taskID=${taskID}" : 'insert_task.php'; ?>"
	method="post">
	<style>
	  div {
	      width: 100%;
	      border-radius: 10px;
	      border: 1px dashed black;
	      padding: 10px;
	      background-color: lightgrey;
	      font-size: 20px;
	  }

	  input[type=text] {
	      width: 40%;
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
	  <input type="text" name="title" class="mov"
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
	    $("#dateStop_input").change( function() {
		validateMinDate($("#dateStart_input"),
				$("#dateStop_input"),
				$("#dateStop_input_msg"));
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
	    $("#timeStop_input").change( function() {
		validateMinDate($("#timeStart_input"),
				$("#timeStop_input"),
				$("#timeStop_input_msg"));
	    });
	  </script>
	</div>
	<div>
	  <label>Details</label>:
	  <input type="text" name="details" class="mov"
		 value="<?php echo $task_stats['taskDetails'] ?>"><br>
	</div>
	<div>
	  <input type="checkbox" name="isFolder" class="mov" value="1"><br>
	  <label for="isFolder">Is a folder?</label>
	</div>
	<div>
	  <label for="folderID">Select Folder:</label>
	  <select name="folderID" class="mov">
	    <?php foreach($tasks as $t) {
	       if ($t['isFolder']) {
	         echo "<option value=\"$t[taskID]\"> $t[taskName] </option>";
	       }
	     }
	    ?>
	    </select>
	</div>
	<input type="submit" value="<?php echo ($taskID !=  FALSE) ? 'Modify' : 'Add'; ?> Task!" id="submit">
      </form>
    </div>
    

  </body>

</html>
