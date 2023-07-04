<?php
	session_start();

	$cookie = [];
	$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
	foreach ($cookies as $el) {
		[$key, $value] = explode('=', $el);
		$cookie[trim($key)] = $value;
	}
	$json = $cookie['users'];
	$arr = json_decode($json, true);

	$groupName = $_GET['name'];

	$usernamesarr = $arr;

	include 'includes/dbh.inc.php';

    $sql = "SELECT id FROM user WHERE username IN ('" . implode("','", $usernamesarr) . "')";
	$result = mysqli_query($db, $sql);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$ids[] = $row['id'];
		}
		$userIDs = $ids;
	} else {
		echo "error";
	}
	
	$userIDs[count($userIDs)] = $_SESSION['id'];
	$all_ids = implode("|", $userIDs);

	if ($groupName === "") {
		$groupName = "Unknown Group";
	}

	$sql = "INSERT INTO groups (name) VALUES ('$groupName')";

	if (mysqli_query($db, $sql)) {
		echo "New record created successfully";
		$insertedId = mysqli_insert_id($db);
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db);
	}

	foreach ($userIDs as $id) {
		$sql = "INSERT INTO group_members (group_id, user_id) VALUES ('$insertedId', '$id')";

		if (mysqli_query($db, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}
	}

	header("Location: chats.php");
?>