<?php 
    session_start(); 
    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
    }

    session_destroy();
    header("Location: login.php");
?>