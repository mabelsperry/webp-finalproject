<!DOCTYPE html>
<html lang="en">
  <?php
   require("conn.php");
   ?>

  
  
  <head>
    <meta charset="utf-8">
    <link href="normalize.css" rel="stylesheet" type="text/css"/>
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
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
      <a href="addtask.php" class="button button_addtask">+</a>

      <script type="text/javascript">
	document.getElementById("task_list_div").addEventListener("click", function() {assign("taskview.php");});
	document.getElementById("cal_div").addEventListener("click", function() {assign("calendarview.php");});
      </script>
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
	      // console.log(inpObj.innerHTML);
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
	  <input type="text" name="title" class="mov" required><br>
	</div>
	<div>
	  <label>Date Start</label>:
	  <input id="dateStart_input" type="date" name="dateStart" class="mov">
	</div>
	<div>
	  <label>Date Stop</label>:
	  <input id="dateStop_input" type="date" name="dateStop" class="mov">
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
	  <input id="timeStart_input" type="time" name="timeStart" class="mov">
	</div>
	<div>
	  <label>Time Stop</label>:
	  <input id="timeStop_input" type="time" name="timeStop" class="mov">
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
	  <input type="text" name="details" class="mov"><br>
	</div>
	<input type="submit" value="Add Task!" id="submit">
      </form>
    </div>
    

  </body>

</html>
