<?php
	$username = $_SESSION['username'];
	include 'dbh.inc.php';
	$sql = "SELECT sender, COUNT(*) AS duplicates FROM messages WHERE receiver = '$username' AND gelesen = '0' GROUP BY sender ORDER BY duplicates DESC";
	$result = mysqli_query($db, $sql);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			echo "<a style='text-decoration: none; color: black;' href='chat.php?user=" . $row['sender'] . "'>You got " . $row["duplicates"] . " unread messages from " . $row['sender'] . "</a><br>";
		}
	} else {
	  echo "No unread messages";
	}
?>