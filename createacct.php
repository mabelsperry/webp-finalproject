<?php
	require('conn.php');

	$name = $_POST['name'];
	$password = $_POST['password'];
	$email = $_POST['email'];


	$query = " INSERT INTO users (`username`, `password`, `email`) VALUES ('$name', '$password', '$email')";
	if( $conn->query($query) ) {
	  header('Location: login.html');
	} else {
	  header('Location: createacct.html');
	}


?>
