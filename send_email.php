<?php
// send_email.php

function sendThankYouEmail($name, $email) {
    $subject = "Thank you for registering";
    $message = "Dear $name,\n\nThank you for registering on our website.\n\nBest regards,\nThe Team";
    $headers = "From: no-reply@example.com";

    mail($email, $subject, $message, $headers);
}
?>
