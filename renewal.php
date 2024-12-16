<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Renewal Application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- FontAwesome for icons -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        textarea {
            height: 120px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .input-group {
            display: flex;
            align-items: center;
        }
        .input-group input {
            flex-grow: 1;
        }
        .input-group span {
            background-color: #ddd;
            padding: 10px;
            border-radius: 5px;
            margin-left: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Rent Renewal Application</h1>
        <form action="submit_renewal.php" method="POST">
            <!-- Tenant Information Section -->
            <div class="form-group">
                <label for="tenantName">Full Name</label>
                <input type="text" id="tenantName" name="tenantName" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <!-- Property Details Section -->
            <div class="form-group">
                <label for="propertyAddress">Property Address</label>
                <input type="text" id="propertyAddress" name="propertyAddress" required>
            </div>
            <div class="form-group">
                <label for="currentLeaseEnd">Current Lease End Date</label>
                <input type="date" id="currentLeaseEnd" name="currentLeaseEnd" required>
            </div>

            <!-- Rent Renewal Preferences Section -->
            <div class="form-group">
                <label for="renewalTerm">Preferred Renewal Term</label>
                <select id="renewalTerm" name="renewalTerm" required>
                    <option value="1_year">1 Year</option>
                    <option value="2_years">2 Years</option>
                    <option value="3_years">3 Years</option>
                </select>
            </div>
            <div class="form-group">
                <label for="newRentAmount">Proposed New Rent Amount (in USD)</label>
                <input type="number" id="newRentAmount" name="newRentAmount" required>
            </div>

            <!-- Additional Requests or Notes Section -->
            <div class="form-group">
                <label for="specialRequests">Any Special Requests or Notes</label>
                <textarea id="specialRequests" name="specialRequests"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn">Submit Renewal Application</button>
        </form>
    </div>

</body>
</html>
