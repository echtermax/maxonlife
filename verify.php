<?php 
    session_start(); 
    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
    } elseif ($_SESSION['verify'] != 0) {
        header("Location: index.php");
    }

    $username = $_SESSION['username'];
    $id = $_GET['name'];
    include('includes/dbh.inc.php');
    $sql = "SELECT verifyed FROM user WHERE username = '$username'";
    $result = mysqli_query($db, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if ($row['verifyed'] == 1) {
        $_SESSION['verify'] = 1;
        header("Location: index.php");
    } elseif ($_SESSION['username'] == $id) {
        $sql = "UPDATE user SET verifyed = 1 WHERE username = '$id'";
        $_SESSION['verify'] = 1;
        mysqli_query($db, $sql);
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="CSS/verify.css">
	<title>Please verify your Huddle Account</title>
</head>
<body>
	<h1>Please check your E-Mail and verify yourself to join Huddle</h1>
    <a href="mail.php"><button>Resend Mail</button></a>
</body>
</html>