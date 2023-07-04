<?php
    session_start();
    $to = $_SESSION['email'];
    $subject = 'Verify your Huddle-Acount';

    $headers = 'From: no-reply@maxonlife.de' . "\r\n";
    $headers .= 'Reply-To: no-reply@maxonlife.de' . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = "<html><body style='background-color = #d5dbdb'>";
    $message .= '<h1>Complete Your Account Setup and Get Verified Today</h1>';
    $message .= '<p>Dear ' . $_SESSION['username'] . ',</p>';
    $message .= '<p>Thank you for signing up for Huddle. To ensure the safety and security of our users, we require all accounts to be verified.</p>';
    $message .= '<p>Please click the following to verify your account: <a href="https://www.maxonlife.de/verify.php?name=' .  $_SESSION["username"] . '">Verify here</a></p>';
    $message .= '<p>Thank you for choosing Huddle. We look forward to seeing you online.</p>';
    $message .= '<p>Best regards,</p>';
    $message .= '<p>Max</p>';
    $message .= "</body></html>";

    mail($to, $subject, $message, $headers);
    header("Location: index.php");
?>