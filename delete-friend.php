<?php
	session_start();
	$friend = $_GET['user'];
	$username = $_SESSION['username'];
	include 'dbh.inc.php';
	$sql = "DELETE FROM friends WHERE (username = '$username' AND fusername = '$friend') OR (username = '$friend' AND fusername = '$username')";
	mysqli_query($db, $sql);
	header("Location: ../friends.php?msg=deleted");
?>