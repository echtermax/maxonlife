<?php
	if (isset($_GET['msg'])) {
		$error = $_GET['msg'];
		if ($error == "friend-exist") {
			echo "Friend does not exist!";
		} elseif ($error == "friend-id") {
			echo "ID is wrong!";
		} elseif ($error == "friends") {
			echo "You are already friends!";
		} elseif ($error == "request") {
			echo "Friendrequest already exists!";
		} elseif ($error == "send") {
			echo "Friendrequest send!";
		} elseif ($error == "deleted") {
			echo "Friend succesfuly deleted!";
		}
	}
?>