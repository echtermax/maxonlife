<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="CSS/newGroup.css">
	<title>Create a new Group</title>
</head>
<body>
	<button class="x"><a href="chats.php"><h1>X</h1></a></button>
	<form>
		<h1>Create a new group</h1>
		<label>Name:</label>
		<input type="text" id="name" name="name">
		<!-- Show friends list where user can select and unselect users for the group -->
		<div id="friendlist">
			<h3>Friends</h3>
			<?php
				include 'includes/dbh.inc.php';
				session_start();
				$username = $_SESSION['username'];
				$sql = "SELECT * FROM friends WHERE username ='$username'";
				$result = mysqli_query($db, $sql);

				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<div class='group' onclick='addPerson(\"" . $row["fusername"] . "\")'>";
							echo $row["fusername"];
							echo "<span id='" . $row["fusername"] . "' class='symbol'>+</span>";
						echo "</div>";
					}
				}
			?>
		</div>
		<div class="finish" onclick="finish()">
			Finish
		</div>
	</form>
	<script type="text/javascript">
		function addPerson(username) {
			var symbol = document.getElementById(username);

			if (symbol.innerHTML === "+") {
				symbol.innerHTML = "&#10003;";
			} else {
				symbol.innerHTML = "+";
			}
		}

		function finish() {
			var spanElements = document.getElementsByTagName("span");

			// Create an array to store the IDs of matching <span> tags
			var matchingIDs = [];

			// Iterate through each <span> element
			for (var i = 0; i < spanElements.length; i++) {
			  var span = spanElements[i];

			  // Check if the <span> contains the desired text "&#10003;"
			  if (span.innerHTML !== "+") {
			    // Store the ID of the matching <span> in the array
			    matchingIDs.push(span.id);
			  }
			}

			var json_str = JSON.stringify(matchingIDs);
			document.cookie = "users=" + json_str;

			var name = document.getElementById('name').value;

			location.href = "newGroupCode.php?name=" + name;
		}
	</script>
</body>
</html>