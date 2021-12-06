<?php

function printTask($t) {
	echo "<div><p><strong>" . $t['taskName'] . ": </strong>" . $t['taskDetails'] . "<br>";
	if ( strncasecmp($t['dateStart'], "1970-01-01",11) != 0 ) {
	   echo "<b>Start Date: </b>" . $t['dateStart'] . "<br>";
	}
	if ( $t['dateStop'] ) {
	   echo "<b>End Date: </b>" . $t['dateStop'] . "<br>";
	}

	if ( strncasecmp($t['timeStart'], "00:00:00", 11 ) != 0) {
	   echo "<b>Start Time: </b>" . $t['timeStart'] . "<br>";
	}
	if ( strncasecmp($t['timeStop'], "00:00:00", 11 ) != 0) {
	   echo "<b>End Time: </b>" . $t['timeStop'] . "<br>";
	}
	echo "<i>" . $t['taskID'] . "</i></p></div>";
	
}

?>