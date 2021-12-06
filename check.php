<?php
	require('conn.php');

	$name = $_POST['name'];
	$password = $_POST['password'];

	$query = " SELECT * FROM users WHERE username='$name' AND password='$password' ";

	$conn = $conn->query($query);
	$arr = $conn->fetch_all();
	// session_start();
	
	if (count($arr) > 0)
	{
		$_SESSION['name'] = $name;
		$_SESSION['password'] = $password;
		header('Location: taskview.php');
	}
	else
	{
		header('Location: login.html');
	}
	
?>













