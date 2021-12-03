 <?php
$servername = "localhost";
$username = "root";
$password = "girlfriendisbetter";
$db = "TheDB";

// Create connection
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

session_start();

if ($result = $conn->query("SHOW TABLES LIKE 'Calendar' ")) {
   if ($result->num_rows == 0) {
        $cal_create = " CREATE TABLE Calendar (date DATETIME, dow varchar(9))";    
        $conn->query($cal_create);


	$date = date_create("2021-01-01");
	$dow_int = 5;
	$dow = "Friday";
	
	$insert = $conn -> prepare("INSERT INTO Calendar (date, dow) VALUES ( ?, ? )");
	$insert -> bind_param("ss", $date_for_insert, $dow);
	
	for($x = 0; $x <= 3650; $x++) {
		       
	       $date_for_insert = date_format($date, "Y/m/d H:i:s");
	       	       
	       switch ($dow_int) {
	       	      case 1:
		      	   $dow = "Monday";
			   break;
		      case 2:
		           $dow = "Tuesday";
			   break;
		      case 3:
		      	   $dow = "Wednesday";
			   break;
		      case 4:
		      	   $dow = "Thursday";
			   break;
		      case 5:
		      	   $dow = "Friday";
			   break;
		      case 6:
		      	   $dow = "Saturday";
			   break;
		      case 7:
		      	   $dow = "Sunday";
			   break;
	       }
	       
	       $insert -> execute();

	       date_add($date, date_interval_create_from_date_string("1 day"));
	       $dow_int++;
	       if ($dow_int == 8)
	       	  $dow_int = 1;
	       
	}

   }
}

?> 