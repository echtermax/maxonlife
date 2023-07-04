<?php
	session_start();
	include 'includes/dbh.inc.php';
	if (isset($_POST['username'])) {
		$fusername = $_POST['username'];
		$fid = $_POST['id'];
	} else {
		$fusername = $_GET['name'];
		$fid = $_GET['id'];
	}
	$username = $_SESSION['username'];
	$id = $_SESSION['id'];
	$sql = "SELECT * FROM user WHERE username = '$fusername'";
	$result = mysqli_query($db, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck == 1) {
		$row = mysqli_fetch_assoc($result);
		if ($fid == $row['id']) {
			$sql = "SELECT * FROM friends WHERE (username = '$username' AND fusername = 'fusername') OR (fusername = '$username' AND username = '$fusername')";
			$result = mysqli_query($db, $sql);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck == 0) {
				$sql = "SELECT * FROM friends_request WHERE (username = '$username' AND fusername = '$fusername') OR (fusername = '$username' AND username = '$fusername')";
				$result = mysqli_query($db, $sql);
				$resultCheck = mysqli_num_rows($result);
				if ($resultCheck == 0) {
					$sql = "INSERT INTO friends_request (username, fusername) VALUES ('$username', '$fusername')";
					mysqli_query($db, $sql);
					header("Location: friends.php?msg=send");
				} else {
					header("Location: friends.php?msg=request");
				}
			} else {
				header("Location: friends.php?msg=friends");
			}
		} else {
			header("Location: friends.php?msg=friend-id");
		}
	} else {
		header("Location: friends.php?msg=friend-exist");
	}
?>