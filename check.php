<?php
	require('conn.php');

	$name = $_POST['name'];
	$password = $_POST['password'];

	$query = " SELECT * FROM users WHERE username='$name' AND password='$password' ";

	$conn = $conn->query($query);
	$arr = $conn->fetch_all();

	if (count($arr) > 0)
	{
		session_start();
		$_SESSION['name'] = $name;
		$_SESSION['password'] = $password;
		header('Location: taskview.html');
	}
	else
	{
		header('Location: login.html');
	}
	
?>