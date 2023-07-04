<?php
	$username = $_SESSION['username'];
	$sql = "SELECT * FROM friends_request WHERE fusername ='$username'";
	$result = mysqli_query($db, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo "<div id='box'><h2>Friendsrequests</h2>";
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div id='container'>" . $row["username"] . "<button id='accept'><a href='friends.php?id=" . $row["id"] . "&accept=true'>Accept</a></button>" . "<button id='decline'><a href='friends.php?id=" . $row["id"] . "&accept=false'>Delete</a></button></div>" . "<br>";
		}
		echo "</div>";
	}
?>