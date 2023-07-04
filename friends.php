<?php
	include 'includes/permission.inc.php';
	include 'includes/dbh.inc.php';
	include 'includes/accept-or-delete-friends.inc.php';
	include 'error/friends.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="CSS/friends.css">
	<title>Huddle Friends</title>
</head>
<body>
	<?php include 'includes/navbar.php'; ?>
	<form action="send-request.php" method="POST">
		<table>
			<tr>
				<td><input type="text" name="username" placeholder="Username"></td>
				<td id="number"><input type="number" min="1" name="id" placeholder="ID"></td>
				<td><input type="submit" name="find-friend"></td>
			</tr>
		</table>
	</form>
	<?php include 'includes/friend-requests.inc.php'; ?>
	<div id="box">
		<h2>Friends</h2>
		<?php include 'includes/friends-list.inc.php'; ?>
	</div>
	<div id="box" class="box">
		<?php include 'includes/suggest-friends.php'; ?>
	</div>
</body>
<script type="text/javascript">
    function validate() {
        var element = document.getElementById('username');
        element.value = element.value.replace(/[^A-Za-z0-9_.@-\s]/g, '');
    };
</script>
</html>