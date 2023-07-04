<?php
	if (isset($_GET['fail'])) {
		$error = $_GET['fail'];
		if ($error == "pw-wrong") {
			echo "Please make sure you entered the right password";
		} elseif ($error == "pw-no-match") {
			echo "Please make sure your new passwords match";
		}
	}
?>