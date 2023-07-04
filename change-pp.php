<?php
	session_start();
	$username = $_SESSION['username'];
	$file = $_FILES['profile_picture'];
	$fp = fopen($file['tmp_name'], 'r');
	$content = fread($fp, filesize($file['tmp_name']));
	fclose($fp);
	$blob = addslashes($content);
	$sql = "UPDATE user SET profile_picture = '$blob' WHERE username = '$username'";
	mysqli_query($db, $sql);
	header("Location: ../index.php?msg=pp-set");
?>