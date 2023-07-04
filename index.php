<?php
    include('includes/permission.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="CSS/index.css">
    <title>Home of Huddle</title>
</head>
<body>
    <?php
        include 'includes/navbar.php';
        include 'error/index.php';
    ?>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <?php include 'includes/new-msg.php'; ?>
    <footer>
        <!-- <a href="includes/new-entry.php"><button>Create new Entry</button></a> -->
    </footer>
</body>
</html>