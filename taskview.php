  <?php
   
   require("conn.php");

   // print_r($_SESSION);

   $stm1 = $conn -> prepare(" SELECT userID FROM users WHERE username = ? ");
   $stm1 -> bind_param("s", $session_name);
   $session_name = $_SESSION["name"];
   
   $stm1 -> execute();
   $result1 = $stm1 -> get_result();
   $ID = $result1->fetch_assoc();
   // print_r($ID['userID']);

   // Validate that userID is an int.
   if (filter_var($ID['userID'], FILTER_VALIDATE_INT) === 0 ||
       !filter_var($ID['userID'], FILTER_VALIDATE_INT) === false) {
     
     $stm2 = $conn ->
     	   prepare(" SELECT tasks.*, users.userID 
	   FROM tasks LEFT JOIN users ON tasks.userID = users.userID 
	   WHERE users.userID = ? ");
     $stm2 -> bind_param("i", $ID['userID']);
          
     $result2 = $stm2 -> execute();
     $tasks = $stm2 -> get_result();

   }

   ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
    <title>List View</title>
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <div class="greetings-box">
	<h1>Hello, <?php echo $session_name ?></h1>
  </div>
  
  <body>
    <div class="sidebar">
      <div><p><strong>Task List</strong></p></div>
      <div><p><strong>Calendar</strong></p></div>
    </div>

    <div class="content-area">
      <?php
	if ($tasks->num_rows > 0) {
	   while ($row = $tasks->fetch_assoc()) { ?>
      <div><p>
	  <strong><?php echo $row['taskName']; ?>:  </strong>
	  <?php echo $row['taskDetails']; ?>
	  <i>
	  <?php echo $row['taskID']; ?></i>
	  
      </p></div>
      <?php } }?>
    </div>
  </body>
  
</html>
