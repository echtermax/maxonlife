<?php
	session_start();
	if ($_SESSION['username'] == "maw.sx") {
		// code...
	} else {
		header("Location: index.php?msg=denied");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="CSS/admin.css">
	<title>Admin</title>
</head>
<body>
	<h1>Dev Notes</h1>
	<table>
		<tr>
			<th>Design</th>
			<th>Feature</th>
			<th>Accesability</th>
		</tr>
		<tr>
			<td>Mail</td>
			<td>Blockier System</td>
			<td>Comment Code</td>
		</tr>
		<tr>
			<td>Settings</td>
			<td>/</td>
			<td>/</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>
				<div id="color">
					<div id="color-box" class="box-1"></div>
					<span id="color-code">#d5dbdb</span>
				</div>
			</td>
			<td>
				<div id="color">
					<div id="color-box" class="box-2"></div>
					<span id="color-code">#2F4F4F</span>
				</div>
			</td>
			<td>
				<div id="color">
					<div id="color-box" class="box-3"></div>
					<span id="color-code">#D3D3D3</span>
				</div>
			</td>
			<td>
				<div id="color">
					<div id="color-box" class="box-4"></div>
					<span id="color-code">#D33F49</span>
				</div>
			</td>
			<td>
				<div id="color">
					<div id="color-box" class="box-5"></div>
					<span id="color-code">#4CB944</span>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>