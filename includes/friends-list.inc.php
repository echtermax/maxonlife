<?php
	$username = $_SESSION['username'];
	$sql = "SELECT * FROM friends WHERE username ='$username'";
	$result = mysqli_query($db, $sql);

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo "<a id='friend-link' href='profile.php?user=" . $row["fusername"] . "'>";
				echo "<span id='text'>";
					echo $row["fusername"];
				echo "</span>";
			echo "</a>";
			echo "<div id='dropdown'>";
				echo "<button class='dropbtn' onclick='dropdown(\"" . $row["id"] . "\")'></button>";
				echo "<div class='dropdown-content' id='" . $row["id"] . "'>";
					echo "<a href='profile.php?user=" . $row["fusername"] . "'><center>Profile</center></a>";
					echo "<a href='includes/delete-friend.php?user=" . $row["fusername"] . "' id='delete'><center>Delete Friend</center></a>";
				echo "</div>";
			echo "</div>";
			echo "<br><div id='space'></div><br>";
		}
	} else {
	  echo "No friends found";
	}
?>

<script type="text/javascript">
	function dropdown(arguments) {
		document.getElementById(arguments).classList.toggle("show");
	}

	window.onclick = function(event) {
		if (!event.target.matches('.dropbtn')) {
			var dropdowns = document.getElementsByClassName("dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
				}
			}
		}
	}
</script>