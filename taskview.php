<!DOCTYPE html>
<html lang="en">

  <?php
   require("acquireid.php");
   require("tv.php");
   ?>

  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="normalize.css" type="text/css"/>
    <link rel="stylesheet" href="stylesheet.css" type="text/css"/>
    <!-- NEED TO IMPORT THIS: https://code.jquery.com/jquery-3.6.0.js -->
    <script src="jquery-3.6.0.js"></script>
    <title>List View</title>



  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <div class="greetings-box">
    <h1>Hello, <?php echo $session_name . "! Today's Date: " . date("m-d-Y")?></h1>
    <img class="taskviewImage" src="images/pic1.png" alt="taskviewicon" style="width:85px;height:100px;">
    <img class="taskviewImage2" src="images/pic1.png" alt="taskviewicon" style="width:85px;height:100px;">
  </div>

  <body>
    <div class="newTasksidebar">
      <div id="task_list_div" class="myButton"><p><strong>Task List</strong></p></div>
      <div id="cal_div" class="myButton"><p><strong>Calendar</strong></p></div>
      <div id="button_addtask" class="myButton"><p><strong>Add Task</strong></p></div>
      <div id="button_logout" class="myButton"><p><strong>Logout</strong></p></div>

    </div>

    <script type="text/javascript">
  function assign(link) {
     window.location.assign(link);
    }
</script>

    <div id="list-content-area">

      <?php
      $noResults = "Nooooooooooooooooooooooooooooooooooooooooo";
       if ($tasks->num_rows > 0) {
         while ($row = $tasks->fetch_assoc()) {
            printTask($row);
         }
       }
       else {
         echo "<p style='color: black;
             font-size: 20px;
             bottom: 100px;
             text-align: center;
             padding-left: 0%;
             padding-top: 200px;'>" . "You Currently Have 0 Task! Add A Task To Begin! " . "</p>";
       }
      ?>

    </div>

    <script type="text/javascript">
    $("#cal_div").click(function() {
  let d = new Date(Date.now());
  assign("calendarview.php?viewdate=" + d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate());
    });
    $("#button_addtask").click(function() {assign("addtask.php");});
    $("#button_logout").click(function() {assign("logout.php");});

    function assign(link) {
        window.location.assign(link);
    }
    </script>
  </body>

</html>
