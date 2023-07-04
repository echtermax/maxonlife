<?php
	if (isset($_GET['msg'])) {
		$error = $_GET['msg'];
		if ($error == "pw-set") {
			echo "New password is set!";
		} elseif ($error == "encode-chat") {
			echo "There was an error encrypting the message. Please try again later!";
		} elseif ($error == "decode-chat") {
			echo "There was an error decrypting the messages. Please try again later!";
		} elseif ($error == "bio-set") {
			echo "New bio is set!";
		} elseif ($error == "denied") {
			echo "Acces denied!";
		} elseif ($error == "pp-set") {
			echo "New profile picture is set!";
		}
	}
?>