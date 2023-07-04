<?php
	session_start();
	include 'dbh.inc.php';
	$username = $_SESSION['username'];
	$bio = $_POST['bio'];
	$sql = "UPDATE user SET bio = '$bio' WHERE username = '$username'";
	mysqli_query($db, $sql);
	header("Location: ../index.php?msg=bio-set");
?>