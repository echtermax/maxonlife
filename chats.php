<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="CSS/chats.css">
	<title>Chats</title>
</head>
<body>
	<?php
		include "includes/navbar.php";
		session_start();
		$username = $_SESSION['username'];
		include 'includes/dbh.inc.php';
	?>
	<button onclick="openChats()" class="dropbtn line" id="dropChats">Show Chats</button>
	<div id="chats" class="chats-content">
		<?php include 'includes/getChats.inc.php'; ?>
	</div>
	<table class="line">
		<tr>
			<td><button onclick="openGroups()" class="dropbtn" id="dropGroups">Show Groups</button></td>
			<td><button class="newGroup"><a href="newGroup.php">New Group</a></button></td>
		</tr>
	</table>
	<div id="groups" class="groups-content">
		<?php include 'includes/getGroups.inc.php'; ?>
	</div>
</body>
<script type="text/javascript">
	function openChats() {
		document.getElementById("chats").classList.toggle("show");
		var dropdowns = document.getElementsByClassName("chats-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				document.getElementById("dropChats").innerHTML = "Hide Chats";
			} else {
				document.getElementById("dropChats").innerHTML = "Show Chats";
			}
		}
	}

	window.onclick = function(event) {
		if (!event.target.matches('.dropbtn')) {
			var dropdowns = document.getElementsByClassName("chats-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
				}
			}
		}
	}

	function openGroups() {
		document.getElementById("groups").classList.toggle("show");
		var dropdowns = document.getElementsByClassName("groups-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				document.getElementById("dropGroups").innerHTML = "Hide Groups";
			} else {
				document.getElementById("dropGroups").innerHTML = "Show Groups";
			}
		}
	}

	window.onclick = function(event) {
		if (!event.target.matches('.dropbtn')) {
			var dropdowns = document.getElementsByClassName("groups-content");
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
</html>