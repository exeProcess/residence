<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set up database connection parameters
$host = "localhost"; // Replace with your database host
$username = "americar_reside"; // Replace with your database username
$password = "LPcLYu2hVFAcWHU834gr"; // Replace with your database password
$dbname = "americar_reside"; // Replace with your database name
// $host = "localhost"; // Replace with your database host
// $username = "root"; // Replace with your database username
// $password = ""; // Replace with your database password
// $dbname = "american_residence"; // Replace with your database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Connection failed: " . $conn->connect_error
    ]));
}

// Fetch data from the database
$sql = "SELECT * FROM properties LIMIT 6"; // Replace with your table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Fetch each row as an associative array
    }
    // Send a JSON response
    echo json_encode([
        "status" => "success",
        "data" => $data
    ]);
} else {
    // Send a response indicating no records found
    echo json_encode([
        "status" => "success",
        "message" => "No records found",
        "data" => []
    ]);
}

// Close the database connection
$conn->close();
?>
