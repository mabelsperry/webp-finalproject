<!DOCTYPE html>
<html lang="en">
  <?php
    require("acquireid.php");
    require("tv.php");
   ?>
  <head>
    <meta charset="utf-8">
    <link href="css/normalize.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/stylesheet.css"  type="text/css"/>
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

    <div class="newTasksidebar">
      <div class="Loginimgcontainer" style="height: 100px;">
	<img src="images/AVATAR3.png" alt="Avatar" class="avatar" style="width:100px;height:100px;">
      </div>
      <div id="task_list_div" class="myButton"><span><strong>Task List</strong></span></div>
      <div id="cal_div" class="myButton"><span><strong>Calendar</strong></span></div>
      <div id="button_addtask" class="myButton"><span><strong>Add Task</strong></span></div>
      <div id="button_logout" class="myButton"><span><strong>Logout</strong></span></div>
    </div>

    <div id="list-content-area">

      <?php
       // Retreive information about the task being modified, or initialize an empty task.
	 $taskID = filter_input(INPUT_GET, 'taskID',FILTER_VALIDATE_INT);
	 if ($taskID !=  FALSE) {
	   $task_stats = $conn->query("SELECT tasks.* FROM tasks WHERE taskID=${taskID}");
	   $task_stats = $task_stats->fetch_assoc();
	} else {
	   $task_stats = array("taskName"=>"", "dateStart"=>"", "dateStop"=>"",
                               "timeStart"=>"", "timeStop"=>"", "taskDetails"=>"",
                               "isFolder"=>"0", "folderID"=>"0", "color"=>"NULL");
	}
	 ?>

      <h1 style="text-align: center;">
	<?php echo ($taskID !=  FALSE) ? 'Hello ' . $session_name . ', modify a' : 'Hello ' . $session_name . ', add a'; ?> task!</h1>
      <form
	action="<?php echo ($taskID !=  FALSE) ? "modify_task.php?taskID=${taskID}" : 'insert_task.php'; ?>"
	method="post">
	<style>
	  /* Style code for the form since the form overrides the stylesheet. */
	  form > div {
	      width: 100%;
	      border-radius: 10px;
	      border: 2px solid black;
	      padding: 10px;
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
	  // Checks validity of date and time to prevent out-of-order input.
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
	    // Could not get jQuery to work for these events for some reason.
	    // Calls the validateMinDate function to validate the input.
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
		 value="<?php echo $task_stats['timeStop'] ?>">
	  <span id="timeStop_input_msg"></span>
	  <script>
	    // Calls the validateMinDate function to validate the input.
	    document.getElementById("timeStop_input").addEventListener("change", function() {
		validateMinDate(document.getElementById("timeStart_input"),
				document.getElementById("timeStop_input"),
				document.getElementById("timeStop_input_msg"));
	    });
	  </script>
	</div>
	<div id="color_selector_div"
	     <?php if ($task_stats['color'] != NULL) 
	         echo "style=\"background-color: $task_stats[color];\"";
	      ?>>
	  <label for="color">Color: </label>
	  <select id="color_selector" name="color" class="mov">
	    <option value="lightgrey" <?php if ($task_stats['color'] == NULL || $task_stats['color'] == 'lightgrey') echo 'selected' ?>>None</option>
	    <option value="aquamarine" <?php if ($task_stats['color'] == 'aquamarine') echo 'selected' ?>>Aquamarine</option>
	    <option value="darkseagreen" <?php if ($task_stats['color'] == 'darkseagreen') echo 'selected' ?>>Dark Sea Green</option>
	    <option value="mediumorchid" <?php if ($task_stats['color'] == 'mediumorchid') echo 'selected' ?>>Medium Orchid</option>
	    <option value="lightcoral" <?php if ($task_stats['color'] == 'lightcoral') echo 'selected' ?>>Light Coral</option>
	    <option value="cornsilk" <?php if ($task_stats['color'] == 'cornsilk') echo 'selected' ?>>Corn Silk</option>
	    <option value="lightseagreen" <?php if ($task_stats['color'] == 'lightseagreen') echo 'selected' ?>>Light Sea Green</option>
	    <option value="lightsteelblue" <?php if ($task_stats['color'] == 'lightsteelblue') echo 'selected' ?>>Light Steel Blue</option>
	    <option value="mediumvioletred" <?php if ($task_stats['color'] == 'mediumvioletred') echo 'selected' ?>>Medium Violet Red</option>
	    <option value="orange" <?php if ($task_stats['color'] == 'orange') echo 'selected' ?>>Orange</option>
	  </select>
	</div>
	<div>
	  <label>Details</label>:
	  <input type="text" name="details" class="mov" style="height: 200px;"
		 value="<?php echo $task_stats['taskDetails'] ?>"><br>
	</div>
	<div style="display: <?php echo ($taskID !=  FALSE) ? 'block' : 'none'; ?> ">
	  <input id="isFolderBox" type="checkbox" name="isFolder" class="mov" value="1" <?php if ($task_stats['isFolder']) {echo 'checked';} ?>><br>
	  <label for="isFolder" >Is a folder?</label>
	  <script>
	    $("#isFolderBox").click( function() {
		// Hides the "Select Folder" option if it is a folder.
		if(this.checked) {
		    document.getElementById("fID").style.display = "none";
		} else {
		    document.getElementById("fID").style.display = "block";
		}
	    });
	  </script>
	</div>
	<div id="fID">
	  <label for="folderID">Select Folder:</label>
	  <select name="folderID" class="mov">
	    <option value="0">None</option>
	    <?php 
	     foreach($tasks as $t) {
	            if ($t['isFolder']) {
		    echo "<option id=\"opt$t[taskID]\" style=\"background-color: $t[color]\" value=\"$t[taskID]\" ";
		        if (array_key_exists('fID', $task_stats) && $task_stats['fID'] == $t['taskID']) echo 'selected';
	                  echo ">$t[taskName]</option>\n";
                    }
                  }
             ?>
	  </select>
	</div>
	<input type="submit" value="<?php echo ($taskID !=  FALSE) ? 'Modify' : 'Add'; ?> Task!" id="submit">
      </form>
    </div>
    
    <script type="text/javascript">
      $("#task_list_div").click(function() {assign("taskview.php");});
      $("#cal_div").click(function() {
          let d = new Date(Date.now());
          assign("calendarview.php?viewdate=" + d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate());
      });
      $("#button_addtask").click(function() {assign("addtask.php");});
      $("#button_logout").click(function() {assign("logout.php");});
      $("#color_selector").change(function() {
          $("#color_selector_div").css("background-color", $("#color_selector").val());
      });
    </script>
  </body>

</html>
