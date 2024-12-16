<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Application Form</title>
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
        .green{
    color: rgb(15, 207, 143);
    font-weight: 680;
}
/* .icon-container {
    display: flex;
    gap: 20px;
} */

.icon {
    /* font-size: 50px; */
    cursor: pointer;
    color: gray; /* Default color */
    transition: color 0.3s;
}

.icon.selected {
    color: blue; /* Selected color */
}

@media(max-width:567px){
    .mobile{
        padding-top: 40px;
    }
}
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
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
        <h1>Real Estate Property Buyer Application Form</h1>
        <form action="submit_application.php" method="POST">
            <!-- Personal Information Section -->
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <!-- Property Preferences Section -->
            <!-- <div class="form-group">
                <label for="propertyType">Preferred Property Type</label>
                <select id="propertyType" name="propertyType" required>
                    <option value="house">House</option>
                    <option value="apartment">Apartment</option>
                    <option value="land">Land</option>
                    <option value="commercial">Commercial Property</option>
                </select>
            </div> -->
            <div class="form-group">
                <label for="location">Property Code</label>
                <input type="text" id="location" name="Code" required>
            </div>
            <!-- <div class="d-flex flex-column"> 
                <label class="radio"> 
                    <div class="d-flex justify-content-between"> 
                        <span>Custom Payment Plan</span>
                        
                        <i class="fa fa-plus-circle icon" id="icon1"></i>
                    </div>
                </label>
                <br> 
                <label class="radio">
                    <div class="d-flex justify-content-between">
                        <span>Installmental Payment Plan</span> 
                        <span><i class="fa fa-plus-circle icon" id="icon1"></i></span> 
                    </div>
                </label>
                <br>
                <label class="radio"> 
                    <div class="d-flex justify-content-between"> 
                        <span>Lump Sum Payment Plan</span> 
                        <span><i class="fa fa-plus-circle icon" id="icon1"></i></span> 
                    </div>
                </label>  
            </div> -->
            <br>
            <!-- Financing and Additional Information -->
            <!-- <div class="form-group">
                <label for="financing">Do you need financing assistance?</label>
                <select id="financing" name="financing" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div> -->
            <!-- <div class="form-group">
                <label for="downPayment">Down Payment (in USD)</label>
                <input type="number" id="downPayment" name="downPayment">
            </div> -->
            <div class="form-group">
                <label for="additionalNotes">Additional Notes</label>
                <textarea id="additionalNotes" name="additionalNotes"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn">Submit Application</button>
        </form>
    </div>
    <script>
        const icons = document.querySelectorAll('.icon');

icons.forEach(icon => {
    icon.addEventListener('click', () => {
        // Remove 'selected' class from all icons
        icons.forEach(i => i.classList.remove('selected'));
        
        // Add 'selected' class to the clicked icon
        icon.classList.add('selected');
    });
});
    </script>
</body>
</html>
