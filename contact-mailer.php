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

// Get the raw POST data
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

// Validate JSON decoding
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Invalid JSON data"]);
    exit;
}

// Extract and validate required fields
$requiredFields = ['name', 'email', 'subject', 'message'];
foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Missing field: $field"]);
        exit;
    }
}

// Sanitize input data
$name = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars($data['subject'], ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8');
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
    $mail->Username = 'americanresidence435@gmail.com'; // Your Gmail address
    $mail->Password = 'dtwh cnul jqfq uxol'; // App-specific password
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

    // Send the email
    $mail->send();
    http_response_code(200); // OK
    echo json_encode(["success" => "Message sent successfully"]);
} catch (Exception $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
}

exit;
