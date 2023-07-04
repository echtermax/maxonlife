<?php
	include 'includes/permission.inc.php';
	include 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="CSS/chat.css">
	<title>Chat with <?php echo $_GET['user']; ?></title>
	<script src="includes/chat.js" defer></script>
</head>
<body>
	<?php
		if (isset($_POST['submit'])) {
			include 'includes/dbh.inc.php';
			$sender = $_SESSION['username'];
			$receiver = $_GET['user'];
			$data = $_POST['message'];
			$cipher = "aes-256-cbc";
			$tag = NULL;
			if (in_array($cipher, openssl_get_cipher_methods())) {
				$key = "(RVo77rOvruR&itfuZ8roufV&Rcriif&";
				$ivlen = openssl_cipher_iv_length($cipher);
				$iv = openssl_random_pseudo_bytes($ivlen);
				$content = openssl_encrypt($data, $cipher, $key, $options=0, $iv, $tag);
				$iv = base64_encode($iv);
				$query = "INSERT INTO messages (sender, receiver, content, iv) VALUES ('$sender', '$receiver', '$content', '$iv')";
				mysqli_query($db, $query);
				header("Location: chat.php?user=" . $receiver);
			} else {
				header("Location: index.php?msg=encode-chat");
			}
		}
	?>
	<?php include 'includes/navbar.php' ?>
	<div id="chat-box">
		<!-- Chat messages will be displayed here -->
		<span id="end"></span>
	</div>

	<form id="chat-form" method="post">
		<div id="field">
			<input type="text" name="message" id="message" placeholder="Type your message here..." onkeyup="validate();">
		</div>
		<div id="send-btn">
			<button type="submit" name="submit">Send</button>
		</div>
	</form>
</body>
<script type="text/javascript">
	function validate() {
	    var element = document.getElementById('message');
	    element.value = element.value.replace(/[^A-Za-z0-9_.@-\s]/g, '');
	};
</script>
</html>