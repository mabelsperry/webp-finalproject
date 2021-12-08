<?php

function printTask($t) {

	echo "<div class=\"list-content-div\" id=\"$t[taskID]\">
	<p width=\"90%\"><strong>$t[taskName]</strong>";
	if ($t['taskDetails']) {
	   echo "<strong>: </strong>" . $t['taskDetails'] ;
	}
	if ( strncasecmp($t['dateStart'], "1970-01-01",11) != 0 ) {
	   echo "<br><b>Start Date: </b>" . $t['dateStart'] ;
	}
	if ( strncasecmp($t['dateStop'], "1970-01-01",11) != 0 ) {
	   echo "<br><b>End Date: </b>" . $t['dateStop'] ;
	}

	if ( strncasecmp($t['timeStart'], "00:00:00", 11 ) != 0) {
	   echo "<br><b>Start Time: </b>" . $t['timeStart'] ;
	}
	if ( strncasecmp($t['timeStop'], "00:00:00", 11 ) != 0) {
	   echo "<br><b>End Time: </b>" . $t['timeStop'] ;
	}
	echo "<br><i>" . $t['taskID'] . "</i></p>
			<div id=\"d$t[taskID]\" class=\"delete_task\">D</div>
			<div id=\"m$t[taskID]\" class=\"modify_task\">M</div>
			</div>";

	echo "<script type=\"text/javascript\">
		      $(\"#d$t[taskID]\").click(function() {assign(\"deleteTask.php?taskID=$t[taskID]\");});
		      $(\"#m$t[taskID]\").click(function() {assign(\"addtask.php?taskID=$t[taskID]\");});
	      </script>";
}

?>