<!DOCTYPE html>
<html lang="en">

  <?php
   require("acquireid.php");
   require("tv.php");
   ?>

  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/normalize.css" type="text/css"/>
    <link rel="stylesheet" href="css/stylesheet.css" type="text/css"/>
    <!-- NEED TO IMPORT THIS: https://code.jquery.com/jquery-3.6.0.js -->
    <script src="jquery-3.6.0.js"></script>
    <title>List View</title>
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <body>
    <div class="newTasksidebar">
      <div class="Loginimgcontainer" style="height: 100px;">
	<img src="images/AVATAR3.png" alt="Avatar" class="avatar" style="width:100px;height:100px;">
      </div>
      <div id="task_list_div" class="myButton"><span><strong>Task List</strong></span></div>
      <div id="cal_div" class="myButton"><span><strong>Calendar</strong></span></div>
      <div id="button_addtask" class="myButton"><span><strong>Add Task</strong></span></div>
      <div id="button_logout" class="myButton"><span><strong>Logout</strong></span></div>
    </div>

    <script type="text/javascript">
      function assign(link) {
	  window.location.assign(link);
      }
    </script>
       
    <div class="greetings-box">
      <h1>Hello, <?php echo $session_name . "! Today's Date is " . date("M d, Y")?></h1>
    </div>

    <div id="list-content-area">

      <?php

       // Retrieve data and sort ascending by folder and folder content.
       $arr = $tasks->fetch_all(MYSQLI_ASSOC);
       $sorted_arr = sortByFolder($arr);

       // If a folder ID is given, first print that folder.
       if (array_key_exists("taskID", $_GET)) {
           $pop = array_filter($sorted_arr, "filterFolderParent");
           $val = array_shift($pop);
           while ($val != NULL && $val['taskID'] != $_GET['taskID'] ) {
             $val = array_shift($pop);
           }
           printTask($val);
       }

       // Prints the whole list or according to folder ID.
       if (count($sorted_arr) > 0) {
         foreach ($sorted_arr as $row) {
           if ((array_key_exists("taskID", $_GET)
                && $row['fID'] == $_GET['taskID']
                && $row['taskID'] != $_GET['taskID'])
                || !array_key_exists("taskID", $_GET)) {
                    printTask($row);
           }
         }
       }
       else {
         echo "<p style='color: black;
             font-size: 20px;
             bottom: 100px;
             text-align: center;
             padding-left: 0%;
             padding-top: 200px;'>" . "You don't have any tasks yet ! " . "</p>";
       }
       ?>
    </div>

    <script type="text/javascript">
      $("#cal_div").click(function() {
	  let d = new Date(Date.now());
	  assign("calendarview.php?viewdate=" + d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate());
      });
      $("#button_addtask").click(function() {assign("addtask.php");});
      $("#button_logout").click(function() {assign("logout.php")});

      <?php
      foreach ($sorted_arr as $t) {
	  if($t['fID'] != 0 && $t['isFolder'] == 0) {
	      echo "$(\"#$t[taskID]\").css(\"width\", \"95%\");\n";
	  }
      }
      ?>
    </script>
  </body>

</html>
