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
    
    <div class="sidebar">
      <div id="task_list_div"><p><strong>Task List</strong></p></div>
      <div id="cal_div"><p><strong>Calendar</strong></p></div>
      <button id="button_addtask">+</button>
      <button id="button_logout">L</button>
    </div>
    
    <div id="list-content-area">

      <?php
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
      
      <h1><?php echo ($taskID !=  FALSE) ? 'Modify' : 'Add'; ?> Task</h1>
      <form
	action="<?php echo ($taskID !=  FALSE) ? "modify_task.php?taskID=${taskID}" : 'insert_task.php'; ?>"
	method="post">
	<style>
	  form > div {
	      width: 100%;
	      border: 1px dashed black;
	      padding: 10px;
	      background-color: lightgrey;
	      font-size: 20px;
	      display: block;
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
	    <option value="NULL" <?php if ($task_stats['color'] == NULL) echo 'selected' ?>>None</option>
	    <option value="aquamarine" <?php if ($task_stats['color'] == 'aquamarine') echo 'selected' ?>>Aquamarine</option>
	    <option value="darkseagreen" <?php if ($task_stats['color'] == 'darkseagreen') echo 'selected' ?>>Dark Sea Green</option>
	    <option value="mediumorchid" <?php if ($task_stats['color'] == 'mediumorchid') echo 'selected' ?>>Medium Orchid</option>
	    <option value="lightcoral" <?php if ($task_stats['color'] == 'lightcoral') echo 'selected' ?>>Light Coral</option>
	    <option value="cornsilk" <?php if ($task_stats['color'] == 'cornsilk') echo 'selected' ?>>Corn Silk</option>
	    <option value="lightseagreen" <?php if ($task_stats['color'] == 'lightseagreen') echo 'selected' ?>>Light Sea Green</option>
	    <option value="lightsteelblue" <?php if ($task_stats['color'] == 'lightsteelblue') echo 'selected' ?>>Light Steel Blue</option>
	    <option value="mediumvioletred" <?php if ($task_stats['color'] == 'mediumvioletred') echo 'selected' ?>>Medium Violet Red</option>
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
      $("#folderID").change(function() {
          var folderval = $("#folderID").val();
          $("#color_selector").val($("#opt" + folderval).css("background-color"));
      });

      function assign(link) {
      window.location.assign(link);
      }

    </script>
  </body>

</html>
