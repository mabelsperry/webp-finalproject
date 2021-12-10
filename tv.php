<?php

function printTask($t) {

	echo "<div style=\"background-color: $t[color]\" class=\"list-content-div\" id=\"$t[taskID]\">
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

	if ( strncasecmp($t['timeStart'], "00:00:00", 11 ) != 0 ) {
	   echo "<br><b>Start Time: </b>" . $t['timeStart'] ;
	}
	if ( strncasecmp($t['timeStop'], "00:00:00", 11 ) != 0 ) {
	   echo "<br><b>End Time: </b>" . $t['timeStop'] ;
	}

	echo "<br><b>Task ID: </b>" . $t['taskID'] ;

	if ($t['fID'] != 0 && $t['fID'] != NULL) {
	   echo "<br><b>Folder ID: </b>" . $t['fID'] ;
	}

	echo "<br></p>
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

?>