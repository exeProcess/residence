<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle JSON payload
if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
    $input = file_get_contents('php://input');
    $_POST = json_decode($input, true);
}

function sendEmail($post) {
    $name = filter_var($post['name'], FILTER_SANITIZE_STRING);
    $fromEmail = filter_var($post['email'], FILTER_SANITIZE_EMAIL);

    // Validate email
    if (!filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email address.";
    }

    // Rest of the sanitization and validation...
    $to = 'habeebajani9@gmail.com';
    $subject = "Payment Process";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: {$name} <{$fromEmail}>\r\n";
    $headers .= "Reply-To: {$fromEmail}\r\n";

    if (mail($to, $subject, "Test Message", $headers)) {
        return "success";
    } else {
        return "Failed to send email.";
    }
}

if (isset($_POST['sendcard'])) {
    echo sendEmail($_POST);
}
?>
