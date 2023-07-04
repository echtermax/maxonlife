<?php
	include 'includes/permission.inc.php';
	include 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="CSS/profile.css">
	<title>Profile</title>
</head>
<body>
	<?php include "includes/navbar.php" ?>
	<?php
		session_start();
		$fusername = $_GET['user'];
		$sql = "SELECT * FROM user WHERE username = '$fusername'";
		$result = mysqli_query($db, $sql);
		$resultCheck = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		$username = $_SESSION['username'];
		echo '<img id="profile-pic" src="data:image/png;base64,' . base64_encode($row["profile_picture"]) . '"/>';
		echo '<div id="box"><div id="username"><span id="name">' . $row["username"] . '</span><span id="id">ID: ' . $row["id"] . '</span></div></div>';
		if ($row['bio'] !== "") {
			echo '<div id="bio">' . $row['bio'] . '</div>';
		}

		if ($fusername !== $username) {
			echo '<a id="Chat" href="chat.php?user=' . $fusername . '"><button>Open Chat</button></a>';
			$sql = "SELECT * FROM friends WHERE username = '$username' AND fusername = '$fusername'";
			$result = mysqli_query($db, $sql);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck == 0) {
				echo '<a href="send-request.php?id=' . $row['id'] . '&name=' . $fusername . '"><button>Send Friendrequest</button></a>';
			}
		}
	?>
</body>
</html>