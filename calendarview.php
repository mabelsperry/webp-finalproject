<!DOCTYPE html>
<html lang="en">

<?php
 
     require('conn.php');
     require('cal.php');

     

?>

  <head>
    <meta charset="utf-8">
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
    <title>Calendar View</title>
    
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <body>
    

      <div class="greetings-box">
	<h1>Hello, <?php echo $session_name ?></h1>
      </div>

    
    <div class="sidebar">
      <div><p><strong><a href="taskview.php">Task List</a></strong></p></div>
      <div><p><strong><a href="calendarview.php">Calendar</a></strong></p></div>
      <a href="addtask.php" class="button button_addtask">+</a>
    </div>

    <div id="cal-content-area">
      <?php
       $year = date("Y");
       $month = date("M");
       $day = date("d");
       $df = 0;
       $wc_query = $conn -> query(" SELECT Calendar.wc FROM Calendar
                                    WHERE Calendar.year = '$year'
                                    AND Calendar.month = '$month'
                                    AND Calendar.day = '$day' ");

       $row = $wc_query->fetch_assoc();
       $wc = $row['wc'];
       $wc_end = $wc + 6;
       $month_query = $conn -> query(" SELECT Calendar.wc, Calendar.year, Calendar.month, Calendar.day, Calendar.dow
                        FROM Calendar 
                        WHERE Calendar.wc >= $wc AND Calendar.wc <= $wc_end");
      
       
       function printDay($q) {
      	     $row = $q->fetch_assoc();
	     echo " $row[day] ";
       }
       
             
       ?>

      
      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>

      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
      <div>
	<?php printDay($month_query); ?>
      </div>
      
    </div>
    
  </body>
  
</html>
