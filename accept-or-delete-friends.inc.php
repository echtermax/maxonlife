<?php
	$accept = $_GET['accept'];
	$id = $_GET['id'];
	$username = $_SESSION['username'];

	$sql = "SELECT * FROM friends_request WHERE id = '$id'";
	$result = mysqli_query($db, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck == 1) {
		$row = mysqli_fetch_assoc($result);
		$fusername = $row['username'];
		if ($_GET['accept'] == "true") {
			$sql = "INSERT INTO friends (username, fusername) VALUES ('$username', '$fusername')";
			mysqli_query($db, $sql);
            $sql = "INSERT INTO friends (username, fusername) VALUES ('$fusername', '$username')";
            mysqli_query($db, $sql);
		}
		$sql = "DELETE FROM friends_request WHERE id = '$id'";
		mysqli_query($db, $sql);
		header("Location: friends.php");
	}
?>