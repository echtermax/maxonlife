<head>
    <link rel="stylesheet" type="text/css" href="CSS/includes/navbar.css">
</head>
<nav id="navbar">
    <span><a href="index.php">Home</a></span>
    <span><a href="friends.php">Friends</a></span>
    <span><a href="chats.php">Chats</a></span>
    <span><?php
        session_start();
        echo '<a href="profile.php?user=' .  $_SESSION["username"] . '">Profile</a>';
    ?></span>
    <span><a href="settings.php">Settings</a></span>
    <span><a id="logout" href="logout.php">Logout</a></span>
</nav>
<div id="line">&nbsp;</div>