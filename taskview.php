  <?php
   
   require("conn.php");

   print_r($_SESSION);

   $stm1 = $conn -> prepare(" SELECT userID FROM users WHERE username = ? ");
   $stm1 -> bind_param("s", $session_name);
   $session_name = $_SESSION["name"];
   
   $stm1 -> execute();
   $result1 = $stm1 -> fetch();
   $row = $result1 -> fetch_row();
   

   // Validate that userID is an int.
   if (filter_var($int, FILTER_VALIDATE_INT) === 0 || !filter_var($ID, FILTER_VALIDATE_INT) === false) {
     
     $stm2 = $conn ->
     	   prepare(" SELECT tasks.*, users.userID 
	   FROM tasks LEFT JOIN users ON tasks.userID = users.userID 
	   WHERE users.userID = ? ");
     $stm2 -> bind_param("i", $ID);
     $ID = $row["userID"];
     
     $result2 = $stm2 -> execute($stm2);
     $tasks = $stm2 -> fetch_assoc();
   }

   $stm1 -> closeCursor();
   $stm2 -> closeCursor();

   ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <body>
    <div class="sidebar">
      <div><p><strong>Task List</strong></p></div>
      <div><p><strong>Calendar</strong></p></div>
    </div>

    <div class="content-area">
    <h1>Hello, <?php echo $session_name ?></h1>
      <?php foreach ($tasks as $task) : ?>
      <div><h1>
	  <?php
	   echo $task['taskName'];
	   echo '   ';
	   echo $task['taskDetails'];
	   echo '     ';
	   echo $task['taskID'];
	   ?>
      </h1></div>
      <?php endforeach; ?>
    </div>
  </body>
  
</html>
