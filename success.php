<?php

// Database connection details
$host = "localhost"; // Replace with your database host
$username = "americar_reside"; // Replace with your database username
$password = "LPcLYu2hVFAcWHU834gr"; // Replace with your database password
$dbname = "americar_reside"; // Replace with your database name

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

    // Prepare and execute the SQL query to fetch data
    $query = "SELECT * FROM $table WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the data
    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Log or output the fetched data (optional)
        // echo json_encode([
        //     "status" => "success",
        //     "message" => "Data fetched successfully",
        //     "data" => $data
        // ]);

        // Update the fetched data (example logic, replace with actual requirements)
        $newAmount = $_GET['amount'] ?? $data['amount']; // Example field
        $newUser = $_GET['user'] ?? $data['user']; // Example field
        $balance = intval($data['final_price']) - intval($_GET['amount']);

        $updateQuery = "UPDATE $table SET balance_to_be_paid = :amount, buyer_id = :user WHERE id = :id";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bindParam(':amount', $balance, PDO::PARAM_STR);
        $updateStmt->bindParam(':user', $newUser, PDO::PARAM_STR);
        $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($updateStmt->execute()) {
            // echo json_encode([
            //     "status" => "success",
            //     "message" => "Data updated successfully",
            //     "updated_data" => [
            //         "id" => $id,
            //         "amount" => $newAmount,
            //         "user" => $newUser
            //     ]
            // ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to update the data"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "No data found for the given ID"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "ID parameter is missing"
    ]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success | Real Estate</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* General Page Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        /* Container for the success message */
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            font-size: 2.5rem;
            color: #28a745;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .details {
            text-align: left;
            background-color: #f1f1f1;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            border-left: 5px solid #28a745;
        }

        .details p {
            margin: 10px 0;
            font-size: 1rem;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .icon {
            font-size: 3rem;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <h1>Payment Successful!</h1>
        <p>Thank you for your payment. Your transaction has been processed successfully.</p>

        <div class="details">
            <p><strong>Transaction ID:</strong> #TX123456789</p>
            <p><strong>Property:</strong> <?= $data['name']?></p>
            <p><strong>Amount Paid:</strong> <?= $amount_to_pay?></p>
            <p><strong>Date:</strong> <?= date('Y-m-d)?></p>
        </div>

        <p>What happens next?</p>
        <p>Our team will process your purchase and contact you within the next 24 hours with further instructions. Thank you for choosing us for your new property!</p>

        <a href="index.php" class=" btn">Return to Homepage</a>
    </div>

</body>
</html>
