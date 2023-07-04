<?php
    session_start();
    $to = $_SESSION['email'];
    $subject = 'Delte your Huddle';

    $headers = 'From: no-reply@maxonlife.de' . "\r\n";
    $headers .= 'Reply-To: no-reply@maxonlife.de' . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = "<html><body style='background-color = #d5dbdb'>";
    $message .= '<h1>Delete your Huddle</h1>';
    $message .= '<p><a href="https://www.maxonlife.de/includes/delete-profile.php?name=' .  $_SESSION["username"] . '">Click here</a> to Delete your Huddle Account!</p>';
    $message .= '<p>We are sad seeing you leave <a href="https://www.maxonlife.de" style="textdecoration = none; color = lightgray;">Huddle</a> :(</p>';
    $message .= "</body></html>";

    mail($to, $subject, $message, $headers);
    header("Location: ../index.php");
?>