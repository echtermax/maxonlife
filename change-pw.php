<?php
	session_start();
	include 'dbh.inc.php';
	$username = $_SESSION['username'];
	$sql = "SELECT * FROM user WHERE username = '$username'";
	$result = mysqli_query($db, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$old_pw = $row['password'];
		if ($_POST['new_pw'] == $_POST['conf_new_pw']) {
			if (password_verify($_POST['old_pw'], $old_pw)) {
				$password = password_hash($_POST['new_pw'], PASSWORD_DEFAULT);
	            $sql = "UPDATE user SET password = '$password' WHERE username = '$username'";
	            mysqli_query($db, $sql);
	            header("Location: ../index.php?msg=pw-set");
			} else {
				header("Location: ../settings.php?fail=pw-wrong");
			}
		} else {
			header("Location: ../settings.php?fail=pw-no-match");
		}
	}
?>