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
    <h1>Hello, <?php echo $session_name ?></h1>
  </div>

  <body>
    <div class="sidebar">

      <a href="taskview.php" class="myButton">Task List</a>
      <a href="calendarview.php" class="myButton">Calender</a>
      <a href="addtask.php" class="myButton">Add Task</a>
      <a href="logout.php" class="myButton">Logout</a>

    </div>

    <script type="text/javascript">
  function assign(link) {
     window.location.assign(link);
    }
</script>

    <div id="list-content-area">

      <?php
       if ($tasks->num_rows > 0) {
         while ($row = $tasks->fetch_assoc()) {
            printTask($row);
         }
       }
      ?>

    </div>

    <script type="text/javascript">
    document.getElementById("task_list_div").addEventListener("click", href="calview.php";});
      $("#cal_div").click(function() {
	  let d = new Date(Date.now());
	  assign("calendarview.php?viewdate=" + d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate());
      });
      $("#button_addtask").click(function() {assign("addtask.php");});
    document.getElementById("button_logout").addEventListener("click", function() {assign("logout.php");});

      function assign(link) {
          window.location.assign(link);
      }

    </script>
  </body>

</html>
