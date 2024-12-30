<?php
    include_once "Controller/Controller.class.php";
    include_once "Controller/Database.php";

    // Establish database connection
    $dbh = new Database;
    $db = $dbh->connect();
    $ctrl = new Controller($db);

    // Set response type to JSON
    header('Content-Type: application/json');

    try {
        // Get the search parameters from the request
        $request = json_decode(file_get_contents('php://input'), true);

        $keyword = (isset($request['keyword']) && $request['keyword'] != "") ? $request['keyword'] : '';
        $propertyType = (isset($request['propertyType']) && $request['propertyType'] != "null") ? $request['propertyType'] : '';
        $location = (isset($request['location']) && $request['location'] != "mull") ? $request['location'] : '';

        // SQL query to filter properties based on search parameters
        $sql = "SELECT * FROM properties WHERE 
                (name LIKE :keyword OR description LIKE :keyword) 
                AND (:propertyType = '' OR prop_type = :propertyType) 
                AND (:state = '' OR state = :state)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':keyword' => "%$keyword%",
            ':propertyType' => $propertyType,
            ':state' => $location
        ]);

        // Fetch the results
        $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Process property images for JSON output
        foreach ($properties as &$property) {
            $property['images'] = explode(",", $property['image']); // Assuming images are stored as a comma-separated string
        }

        // Return the properties as JSON
        echo json_encode($properties);
    } catch (Exception $e) {
        // Handle errors and return an error response
        echo json_encode(['error' => 'Failed to fetch properties. Please try again later.']);
    }
?>
