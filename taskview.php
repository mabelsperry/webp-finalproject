<!DOCTYPE html>
<html lang="en">

  <?php 
   require("acquireid.php"); 
   require("tv.php");
   ?>
  
  <head>
    <meta charset="utf-8">
    <link href="normalize.css" rel="stylesheet" type="text/css"/>
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
    <!-- NEED TO IMPORT THIS: https://code.jquery.com/jquery-3.6.0.js -->
    <script src="jquery-3.6.0.js"></script>
    <title>List View</title>
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <div class="greetings-box">
    <h1>Hello, <?php echo $session_name ?></h1>
  </div>
  
  <body>
    <div class="sidebar">

      <div id="task_list_div"><p><strong>Task List</strong></p></div>
      <div id="cal_div"><p><strong>Calendar</strong></p></div>
      <button id="button_addtask">+</button>
      <button id="button_logout">L</button>
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
      ?>

    </div>

    <script type="text/javascript">
      $("#task_list_div").click(function() {assign("taskview.php");});
      $("#cal_div").click(function() {
	  let d = new Date(Date.now());
	  assign("calendarview.php?viewdate=" + d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate());
      });
      $("#button_addtask").click(function() {assign("addtask.php");});
      $("#button_logout").click(function() {assign("logout.php");});

      <?php
      foreach ($sorted_arr as $t) {
	  if($t['fID'] != 0 && $t['isFolder'] == 0) {
	      echo "$(\"#$t[taskID]\").css(\"width\", \"95%\");\n";
	  }
      }
      ?>

      function assign(link) {
          window.location.assign(link);
      }
      
    </script>
  </body>
  
</html>
