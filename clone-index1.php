
<?php
// Data loading with an IIFE-like function for simulation
$loadProperties = (function() {
    // Simulated data fetch (replace with your database query if needed)
    return [
        [
            'id' => 1,
            'image' => 'img/property-1.jpg',
            'transaction_type' => 'Sale',
            'prop_type' => 'Apartment',
            'asking_price' => 120000,
            'name' => 'Luxury Apartment',
            'prop_location' => 'Downtown',
            'space' => 1500,
            'bedroom' => 3,
            'bathroom' => 2
        ],
        [
            'id' => 2,
            'image' => 'img/property-2.jpg',
            'transaction_type' => 'Rent',
            'prop_type' => 'Villa',
            'asking_price' => 3000,
            'name' => 'Seaside Villa',
            'prop_location' => 'Beachside',
            'space' => 2500,
            'bedroom' => 4,
            'bathroom' => 3
        ],
        // Add more property entries as needed
    ];
})();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Listings</title>
    <!-- Add your CSS/JS includes here -->
</head>
<body>
    <div class="container">
        <h1>Featured Properties</h1>
        <div class="row">
            <?php foreach ($loadProperties as $property): ?>
                <div class="col-md-4">
                    <div class="property-card">
                        <img src="<?= $property['image'] ?>" alt="Property Image" class="property-image">
                        <div class="property-details">
                            <h2><?= $property['name'] ?></h2>
                            <p>Type: <?= $property['prop_type'] ?></p>
                            <p>Location: <?= $property['prop_location'] ?></p>
                            <p>Price: $<?= $property['asking_price'] ?></p>
                            <p>Size: <?= $property['space'] ?> sqft</p>
                            <p><?= $property['bedroom'] ?> Beds, <?= $property['bathroom'] ?> Baths</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
