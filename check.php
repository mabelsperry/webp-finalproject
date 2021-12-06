<?php
	require('conn.php');

	$name = $_POST['name'];
	$password = $_POST['password'];

	$query = " SELECT * FROM users WHERE username='$name' AND password='$password' ";
	$qres = $conn->query($query);
	
	$arr = $qres->fetch_all();
		
	if (count($arr) > 0)
	{
		$_SESSION['name'] = $name;
		$_SESSION['password'] = $password;

		// Setting global variable to decide what month to display.
		$date_offset = 0;

		header('Location: taskview.php');
	}
	else
	{
		header('Location: login.html');
	}
	
?>