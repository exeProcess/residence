<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure the PHPMailer package is loaded

// Ensure the script processes only POST requests 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Invalid request method"]);
    exit;
}





// Extract and validate required fields
$requiredFields = ['name', 'email', 'subject', 'message'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Missing field: $field"]);
        exit;
    }
}

// Sanitize input _$_POST
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
$to = 'americanresidence435@gmail.com'; // Recipient email address

// Prepare email content
$emailBody = "<h3>New Contact Message</h3>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Subject:</strong> $subject</p>
    <p><strong>Message:</strong> $message</p>";

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
    $mail->setFrom($email, $name); // Sender's email and name
    $mail->addAddress($to, 'Resido'); // Recipient's email and name
    $mail->addReplyTo($email, $name); // Set the reply-to address

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $emailBody;

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
