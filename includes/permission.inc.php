<?php 
    session_start(); 
    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
    } elseif ($_SESSION['verify'] == 0) {
        header("Location: verify.php");
    }
?>