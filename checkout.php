<?php
include_once "Controller/Controller.class.php";
include_once "Controller/Database.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $dbh = new Database;
        $db = $dbh->connect();
        $ctrl = new Controller($db);
        if(!$ctrl::is_logged_in()){
            $ctrl::login_error_redirect("./admin/pages/form/login.php?return=checkout&id=" . $id);
        }
        
        $data = $ctrl->select_this($id, "properties");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h4 class="text-uppercase">Payment Details</h4>
        </div>
        <div class="row">
            <!-- Left Section: Product details and Down payment input -->
            <div class="col-md-6">
                <h5 class="mb-0 text-success">$<?= $data['asking_price']?></h5>
                <h5 class="mb-3"><?= $data['name']?></h5>
                <div class="about">
                    <!-- <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row mt-1">
                            <h6>Insurance Responsibility</h6>
                            <h6 class="text-success font-weight-bold ml-1">$71.76</h6>
                        </div>
                    </div>
                    <p>Insurance claim and all necessary dependencies will be submitted to your insurer for the covered portion of this order.</p>
                    <div class="p-2 d-flex justify-content-between bg-light align-items-center"> 
                        <span>Aetna - Open Access</span> 
                        <span>OAP</span> 
                    </div> -->
                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-row mt-1">
                            <h6>Buyer Balance</h6>
                            <h6 class="text-success font-weight-bold ml-1">$<?=(($data['balance_to_be_paid'] == '')? $data['asking_price']:$data['balance_to_be_paid'])?></h6>
                        </div>
                    </div>
                    <p>This is the remaining amount you need to pay.</p>

                    <!-- Input for Down Payment -->
                    <!-- <div class="form-group">
                        <label for="downPayment">Enter Down Payment</label>
                        <input type="number" class="form-control" id="downPayment" placeholder="Enter amount" min="0" step="0.01">
                    </div>

                    <button class="btn btn-success btn-block" onclick="updatePayment()">Update Payment</button> -->
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

            <!-- Right Section: Payment Summary -->
            <!-- <div class="col-md-6">
                <div class="bg-light p-3 border rounded">
                    <span class="font-weight-bold">Order Recap</span>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Contracted Price</span>
                        <span>$186.86</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Amount Deductible</span>
                        <span>$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Coinsurance (0%)</span>
                        <span>+ $0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Copayment</span>
                        <span>+ $40.00</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Total Deductible, Coinsurance and Copay</span>
                        <span>$40.00</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Maximum out-of-pocket on insurance policy</span>
                        <span>$40.00</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Insurance Responsibility</span>
                        <span>$71.76</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Patient Balance</span>
                        <span id="patientBalance">$13.24</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Total</span>
                        <span class="text-success" id="totalAmount">$85.00</span>
                    </div>
                    <hr>
                    <!-- Payment Summary: How much has been paid and how much is left -->
                    <!-- <div class="d-flex justify-content-between mt-2">
                        <span>Amount Paid</span>
                        <span id="amountPaid">$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Amount Left</span>
                        <span id="amountLeft">$85.00</span>
                    </div> -->
                </div>
            </div> -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let totalAmount = 85.00;
        let paidAmount = 0.00;

        function updatePayment() {
            let downPayment = parseFloat(document.getElementById("downPayment").value);
            
            if (!isNaN(downPayment) && downPayment >= 0) {
                // Update paid amount
                paidAmount += downPayment;

                // Calculate remaining balance
                let remainingAmount = totalAmount - paidAmount;

                // Update the display
                document.getElementById("amountPaid").innerText = `$${paidAmount.toFixed(2)}`;
                document.getElementById("amountLeft").innerText = `$${remainingAmount.toFixed(2)}`;

                // Update patient balance
                let patientBalance = totalAmount - paidAmount;
                document.getElementById("patientBalance").innerText = `$${patientBalance.toFixed(2)}`;

                // Update total amount if needed
                document.getElementById("totalAmount").innerText = `$${totalAmount.toFixed(2)}`;

                // Clear the input field
                document.getElementById("downPayment").value = '';
            } else {
                alert("Please enter a valid amount.");
            }
        }
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
