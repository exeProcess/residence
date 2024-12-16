<?php

// Database connection details
$host = "localhost"; // Replace with your database host
$username = "americar_reside"; // Replace with your database username
$password = "LPcLYu2hVFAcWHU834gr"; // Replace with your database password
$dbname = "americar_reside"; // Replace with your database name
// $host = "localhost"; // Replace with your database host
// $username = "root"; // Replace with your database username
// $password = ""; // Replace with your database password
// $dbname = "american_residence"; // Replace with your database name

// Establish the database connection
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Connection failed: " . $e->getMessage()
    ]);
    exit;
}

// Check if 'id' is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure the ID is an integer
    $table = "properties"; // Replace with your table name
    $data = [];
    $amount_to_pay = $_GET['amount'];
    $user = $_GET['user'];
    // Prepare and execute the SQL query
    $query = "SELECT * FROM $table WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the data
    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Basic styling for the page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #888;
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .otp-input {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .otp-input input {
            width: 45px;
            height: 45px;
            text-align: center;
            font-size: 18px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        .otp-input input:focus {
            border-color: #007bff;
        }

        .otp-input input:disabled {
            background-color: #f0f0f0;
        }

        .btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <!-- OTP Verification Form -->
    <div class="container">
        <h2>OTP Verification</h2>
        <p>Enter the 6-digit OTP sent to your phone number</p>
        
        <!-- OTP Input Fields (6 digits) -->
        <div class="otp-input">
            <input type="text" id="otp1" maxlength="1" oninput="moveFocus(event, 'otp2')" />
            <input type="text" id="otp2" maxlength="1" oninput="moveFocus(event, 'otp3')" />
            <input type="text" id="otp3" maxlength="1" oninput="moveFocus(event, 'otp4')" />
            <input type="text" id="otp4" maxlength="1" oninput="moveFocus(event, 'otp5')" />
            <input type="text" id="otp5" maxlength="1" oninput="moveFocus(event, 'otp6')" />
            <input type="text" id="otp6" maxlength="1" />
        </div>

        <!-- Submit Button -->
        <button class="btn" id="submitOtp" onclick="verifyOtp()">Verify OTP</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to move focus to the next input field
        function moveFocus(event, nextId) {
            if (event.target.value.length === 1) {
                document.getElementById(nextId).focus();
            }
        }

        // Function to verify the OTP
        function verifyOtp() {
            const otp1 = document.getElementById('otp1').value;
            const otp2 = document.getElementById('otp2').value;
            const otp3 = document.getElementById('otp3').value;
            const otp4 = document.getElementById('otp4').value;
            const otp5 = document.getElementById('otp5').value;
            const otp6 = document.getElementById('otp6').value;

            const otp = otp1 + otp2 + otp3 + otp4 + otp5 + otp6;

            if (otp.length === 6) {
                // alert('OTP Verified: ' + otp);
                // You can also redirect to another page or submit the form
                let data = {
                    OTP : otp,
                    sendotp: true
                }
                $.ajax({
                    url: "mailer.php",
                    method: "POST",
                    data: data,
                    success: (res) => {
                        if(res == "success"){
                            var params = {
                                  user: '<?= $user>'
                                id: '<?=$id?>',
                                amount: <?= $amount_to_pay ?>
                            };
            
                        let uri = 'success.php?' + $.param(params);
                        window.location.href = uri
                        
                        }
                        // setTimeout(function() {
                        //     window.location.href = "verify.html"
                        // }, 8000);
                        // console.log(res);
                        
                        
                    }
                })
            } else {
                alert('Please enter the complete 6-digit OTP');
            }
            

        }
    </script>

</body>
</html>
