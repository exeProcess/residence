<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// Database connection
$host = 'localhost'; // Update with your database host
$dbname = 'americar_reside'; // Update with your database name
$username = 'americar_reside'; // Update with your database username
$password = 'LPcLYu2hVFAcWHU834gr'; // Update with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Fetch property types
$propertyTypesQuery = "SELECT * FROM property_types";
$propertyTypesStmt = $pdo->prepare($propertyTypesQuery);
$propertyTypesStmt->execute();
$propertyTypes = $propertyTypesStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch properties
$propertiesQuery = "SELECT 
                        *
                    FROM properties";


// Check if a property type filter is provided
// $type = isset($_GET['prop_type']) ? intval($_GET['prop_type']) : null;
// if ($type) {
//     $propertiesQuery .= " WHERE p.prop_type_id = :type";
// }

$propertiesStmt = $pdo->prepare($propertiesQuery);

// if ($type) {
//     $propertiesStmt->bindParam(':type', $type, PDO::PARAM_INT);
// }

$propertiesStmt->execute();
$properties = $propertiesStmt->fetchAll(PDO::FETCH_ASSOC);

// Return the data as JSON
echo json_encode([
    'propertyTypes' => $propertyTypes,
    'properties' => $properties,
]);
