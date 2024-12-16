<?php
include_once "Controller/Controller.class.php";
include_once "Controller/Database.php";
    if(isset($_GET['id'])){
        $dbh = new Database;
        $db = $dbh->connect();
        $ctrl = new Controller($db);
        $id = $_GET['id'];
        $data = $ctrl->select_this($id, "properties");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Basic styling for centering */
        html, body {
            height: 100%; /* Full height */
            margin: 0; /* Remove any default margin */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 900px; /* Max width of the content */
            width: 100%; /* Make it take full width */
        }

        .row {
            width: 100%;
        }

        .col-md-6 {
            border: 1px solid #ccc; /* Border for visual purposes */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Shadow for better aesthetics */
            background-color: #fff;
        }

        /* Center the text inside the columns */
        .col-md-6 h5, .col-md-6 h6, .col-md-6 p {
            text-align: center;
        }

        .input-group-text {
            padding: 10px 15px;
        }

        .com-color {
            cursor: pointer;
            color: #007bff;
        }

        .btn-block {
            width: 100%;
        }
    </style>
    <script>
        // Function to check input field and enable/disable button
        function toggleButton() {
            var inputField = document.getElementById("amount");
            var submitButton = document.getElementById("proceed");
            
            // Check if input field is not empty
            if (inputField.value.trim() !== "") {
                submitButton.disabled = false;  // Enable button
            } else {
                submitButton.disabled = true;   // Disable button
            }
        }
    </script>
</head>
<body>

    <div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- <h5 class="mb-0 text-success">$85.00</h5>
                <h5 class="mb-3">Diabetes Pump & Supplies</h5>
                <div class="about">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row mt-1">
                            <h6>Insurance Responsibility</h6>
                            <h6 class="text-success font-weight-bold ml-1">$71.76</h6>
                        </div>
                        <div class="d-flex flex-row align-items-center com-color">
                            <i class="fa fa-plus-circle"></i> <span class="ml-1">Add Insurer card</span> 
                        </div>
                    </div>
                    <p>Insurance claim and all necessary dependencies will be submitted to your insurer for the covered portion of this order.</p>
                    <div class="p-2 d-flex justify-content-between bg-pay align-items-center"> 
                        <span>Aetna - Open Access</span> <span>OAP</span> 
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-row mt-1">
                            <h6>Patient Balance</h6>
                            <h6 class="text-success font-weight-bold ml-1">$13.24</h6>
                        </div>
                        <div class="d-flex flex-row align-items-center com-color"> 
                            <i class="fa fa-plus-circle"></i> <span class="ml-1">Add Payment card</span> 
                        </div>
                    </div> -->
                    <p>
                        A land contract (or contract for deed) is a type of installment sale where the seller finances the purchase of the property. The buyer makes periodic payments (often monthly) to the seller, 
                        and the buyer does not receive full ownership of the property until the final payment is made.
                    </p>
                    <h4>How much would you like to pay?</h4>
                    <!-- <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Payment code" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">@americareside.com</span>
                      </div> -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="text" required class="form-control" id="amount" oninput="toggleButton()" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text">.00</span>
                    </div>
                    <div class="buttons">
                        <button class="btn btn-success btn-block" disabled id="proceed">Proceed to payment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        $("#proceed").click(() => {
            var params = {
                id: '<?=$id?>',
                amount: $("#amount").val()
            };

            let uri = 'buy.php?' + $.param(params);
            window.location.href = uri

            // console.log(data.amount);
            
            // $.ajax({
            //     url: uri,
            //     type: 'GET',
            //                 success: function(response) {
            //         // Handle the success response
            //     },
            //     error: function(xhr, status, error) {
            //         // Handle any errors
            //     }
            // });
        })

    </script>
</body>
</html>
