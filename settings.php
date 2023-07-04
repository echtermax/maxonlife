<?php
    include 'includes/permission.inc.php';
    include 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="CSS/settings.css">
	<title>Settings</title>
</head>
<body onload="send()">
	<?php
		include 'includes/navbar.php';
		include 'error/settings.php';
	?>
	<h1>Settings</h1>
	<form action="/includes/change-pw.php" method="POST">
		<h2>Change Password</h2>
		<label for="old_pw">Old Password</label>
		<input type="password" name="old_pw" required>
		<label for="new_pw">New Password</label>
		<input type="password" name="new_pw" required>
		<label for="conf_new_pw">Confirm New Password</label>
		<input type="password" name="conf_new_pw" required>
		<input type="submit" name="submit">
	</form>
	<form action="/includes/change-bio.php" method="POST">
		<h2>Change Bio</h2>
		<label for="bio">Change Your Bio</label>
		<input type="text" name="bio" onkeyup="validate();" id="bio" required>
		<input type="submit" name="submit">
	</form>
	<form action="/includes/change-pp.php" method="POST">
		<h2>Change Profile Picture</h2>
		<input type="file" id="profile_picture" name="profile_picture" accept="image/jpeg, image/png">
		<input type="submit" name="submit">
	</form>
	<a href="includes/verify-delete.php">
		<button>Delete Profile</button>
	</a>
</body>
</html>