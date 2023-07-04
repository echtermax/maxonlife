<?php
	session_start();
	$username = $_SESSION['username'];
	$id = $_SESSION['id'];
	include 'dbh.inc.php';
	$sql = "DELETE * FROM user WHERE username = '$username' AND id = '$id'";
	mysqli_query($db, $sql);
	$sql = "DELETE  * FROM friends WHERE username = '$username'";
	mysqli_query($db, $sql);
	$sql = "DELETE  * FROM messages WHERE sender = '$username' OR reciever = '$username'";
	mysqli_query($db, $sql);
	session_destroy();
	header("Location: ../register.php");
?>