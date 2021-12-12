<?php

function printTask($t) {

	echo "<div style=\"background-color: $t[color]\" class=\"list-content-div\" id=\"$t[taskID]\">
	<span style=\"float: left;\"><strong>$t[taskName]</strong>";
	if ($t['taskDetails']) {
	   echo "<strong>: </strong>" . $t['taskDetails'] ;
	}
	if ( strncasecmp($t['dateStart'], "1970-01-01",11) != 0 ) {
	   echo "<br><b>Start Date: </b>" . $t['dateStart'] ;
	}
	if ( strncasecmp($t['dateStop'], "1970-01-01",11) != 0 ) {
	   echo "<br><b>End Date: </b>" . $t['dateStop'] ;
	}

	if ( strncasecmp($t['timeStart'], "00:00:00", 11 ) != 0 ) {
	   echo "<br><b>Start Time: </b>" . $t['timeStart'] ;
	}
	if ( strncasecmp($t['timeStop'], "00:00:00", 11 ) != 0 ) {
	   echo "<br><b>End Time: </b>" . $t['timeStop'] ;
	}
	echo "<br></span>
			<div id=\"d$t[taskID]\" class=\"delete_task\">D</div>
			<div id=\"m$t[taskID]\" class=\"modify_task\">M</div>";
			if ($t['isFolder'] != 0) {
			   echo "<div id=\"vf$t[taskID]\" class=\"view_folder\">View Folder</div></div>";
			} else {
			  echo "</div>";
			}

	echo "<script type=\"text/javascript\">
		      $(\"#d$t[taskID]\").click(function() {assign(\"deleteTask.php?taskID=$t[taskID]\");});
		      $(\"#m$t[taskID]\").click(function() {assign(\"addtask.php?taskID=$t[taskID]\");}); ";

        if ($t['isFolder'] != 0) {
	   echo "$(\"#vf$t[taskID]\").click(function() {assign(\"taskview.php?taskID=$t[taskID]\");}); ";
	}
	echo "</script>";
}

// Callback function to find the parent of a folder.
function filterFolderParent ($t) {
	 return ($t['isFolder'] == 1 && $t['fID'] == $t['taskID']);
}

function sortByFolder($arr) {
	 $sorted_arr = array();

	 foreach ($arr as $rowx) {
	     if($rowx['isFolder'] == 1 && $rowx['fID'] == $rowx['taskID']) {
	         array_push($sorted_arr, $rowx);
		 foreach ($arr as $rowy) {
		     if($rowy['isFolder'] != 1 && $rowy['fID'] == $rowx['taskID']) {
		         array_push($sorted_arr, $rowy);
		     }
		 }
	     }
	 }

	 foreach ($arr as $rowz) {
	     if($rowz['isFolder'] != 1 && $rowz['fID'] == 0) {
	         array_push($sorted_arr, $rowz);
	     }
	 }

	 return $sorted_arr;
}

?>
