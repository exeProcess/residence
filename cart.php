<?php
 // include_once "Controller/Controller.class.php";
 //    include_once "Controller/Database.php";
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
    // $userTable = 'users';
    $data = [];
   
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
    <meta charset="utf-8">
    <title>Resido - Real Estate HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
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
.modal {
  opacity: 0;
  padding: 50px;
  position: absolute;
  z-index: 1100;
  -webkit-transition: opacity 600ms linear 600ms;
  -moz-transition: opacity 600ms linear 600ms;
  -ms-transition: opacity 600ms linear 600ms;
  -o-transition: opacity 600ms linear 600ms;
  transition: opacity 600ms linear 600ms;
}

.modal_info {
  background: #FCF9F2;
  padding: 50px 100px;
  text-align: center;
}

.modal_overlay {
  background: rgba(0, 0, 0, 0.5);
  bottom: 0;
  left: 0;
  opacity: 0;
  overflow: auto;
  position: fixed;
  right: 0;
  top: 0;
  visibility: hidden;
  z-index: 900;
  -webkit-transition: opacity 200ms linear;
  -moz-transition: opacity 200ms linear;
  -ms-transition: opacity 200ms linear;
  -o-transition: opacity 200ms linear;
  transition: opacity 200ms linear;
}

.display {
  opacity: 1;
  visibility: visible;
}

.conceal {
  visibility: visible;
}

.btn_container {
  height: 100%;
  text-align: center;
}

.btn_container:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  width: 0;
}

.open_button {
  background: #363D4E;
  display: inline-block;
  height: 66px;
  position: relative;
  vertical-align: middle;
  whitespace: normal;
  width: 172px;
  z-index: 1000;
  -webkit-transition: opacity 100ms linear;
  -moz-transition: opacity 100ms linear;
  -ms-transition: opacity 100ms linear;
  -o-transition: opacity 100ms linear;
  transition: opacity 100ms linear;
}

a.open_button {
  color: #FFFFFF;
  letter-spacing: 2px;
  line-height: 66px;
  font-family: 'Helvetica', Arial, sans-serif;
  font-size: 14px;
  font-weight: bold;
  text-decoration: none;
  text-transform: uppercase;
}
 
a.open_button:hover {
  background: #3E465A;
}

a.open_button.load {
  opacity: 0;
}

button.modal_close {
  background: #363D4E;
  border: none;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  -o-border-radius: 50%;
  border-radius: 50%;
  color: #FFFFFF;
  cursor: pointer;
  outline: none;
  width: 52px;
  height: 52px;
  position: absolute;
  right: 30px;
  top: 30px;
  -webkit-transition: -webkit-transform 600ms;
  -moz-transition: -moz-transform 600ms;
  -ms-transition: -ms-transform 600ms;
  -o-transition: -o-transform 600ms;
  transition: transform 600ms;
}

button.modal_close:hover {
  background: #3E465A;
  -webkit-transform: rotate(360deg) scale(1.10);
  -moz-transform: rotate(360deg) scale(1.10);
  -ms-transform: rotate(360deg) scale(1.10);
  -o-transform: rotate(360deg) scale(1.10);
  transform: rotate(360deg) scale(1.10);
  -webkit-transition: -webkit-transform 600ms;
  -moz-transition: -moz-transform 600ms;
  -ms-transition: -ms-transform 600ms;
  -o-transition: -o-transform 600ms;
  transition: transform 600ms;
}

button.modal_close span, span:before, span:after {
  background: #FFFFFF;
  content: '';
  cursor: pointer;
  display: block;
  height: 2px;
  position: absolute;
  width: 20px;
}

button.modal_close span:first-child {
  background: none;
  bottom: 0;
  left: 0;
  margin: auto;
  position: absolute;
  right: 0;
  top: 0;
}

button.modal_close span:before {
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
}

button.modal_close span:after {
  -webkit-transform: translateY(-2px) rotate(-45deg);
  -moz-transform: translateY(-2px) rotate(-45deg);
  -ms-transform: translateY(-2px) rotate(-45deg);
  -o-transform: translateY(-2px) rotate(-45deg);
  transform: translateY(-2px) rotate(-45deg);
  top: 2px;
}
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
                    <div class="icon p-2 me-2">
                        <img class="img-fluid" src="img/icon-deal.png" alt="Icon" style="width: 30px; height: 30px;">
                    </div>
                    <!-- <h1 class="m-0 text-primary">Makaan</h1> -->
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="property-list.php" class="nav-item nav-link">Property List</a>
                        <?php if (!isset($_SESSION['user'])): ?>
                        <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Log in
                                </a>
                                <div class="dropdown-menu rounded-0 m-0" aria-labelledby="loginDropdown">
                                    <a href="admin/pages/form/register.php" class="dropdown-item">Sign Up</a>
                                    <hr>
                                    <a href="admin/pages/form/login.php" id="login" class="dropdown-item">Log in</a>
                                </div>
                            </div>
                            <?php else: ?>
                                <!-- If the user is logged in, display user-specific options -->
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-circle"></i>
                                    </a>
                                    <div class="dropdown-menu rounded-0 m-0" aria-labelledby="userDropdown">
                                        <!-- <a href="renewal.php" class="dropdown-item">Renewal</a> -->
                                        <a href="claim.php?user=<?= $_SESSION['user']['id']?>" class="dropdown-item">Make payment</a>
                                        <!-- Optionally, you can include a logout link here -->
                                        <a href="logout.php" class="dropdown-item">Log out</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                        
                    </div>
                    <!-- <a href="" class="btn btn-primary px-3 d-none d-lg-flex">Add Property</a> -->
                
            </nav>
        </div>
        <!-- Navbar End -->

<!-- Category Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3"></h1>
        </div>
        <div class="row g-5">
            <!-- <div class="col-lg-6 col-sm-6 wow fadeInUp" data-wow-delay="0.1s"> -->
                
                <a href="#"><div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="property-item rounded overflow-hidden">
                    <!-- Carousel Section -->
                    <div id="carousel-<?= $data['id']?>" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- ${propImages.map((image, index) => `
                                <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                    <img class="d-block w-100 img-fluid" src="data:image/jpeg;base64,${image}" alt="${property.name}">
                                </div>
                            `).join('')} -->
                            <?php
                                $imgs = explode(",",$data['image']);
                                foreach($imgs as $index => $img):
                                    $activeClass = ($index === 0) ? 'active' : '';
                            ?>
                            <div class="carousel-item <?=$activeClass?>">
                                <img class="d-block w-100 img-fluid" src="data:image/jpeg;base64,<?= $img?>" alt="<?= htmlspecialchars($data['name'])?>">
                            </div>
                            <?php
                                endforeach;
                            ?>
                        </div>
                        <!-- Carousel Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?= $data['id']?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?= $data['id']?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        <!-- Transaction Type and Property Type Tags -->
                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For <?=$data['transaction_type']?></div>
                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"><?=$data['prop_type']?></div>
                    </div>
                    <!-- Property Details -->
                    <div class="p-4 pb-0">
                        <h5 class="text-primary mb-3">$<?=$data['asking_price']?></h5>
                        <a class="d-block h5 mb-2" href="#"><?=$data['name']?></a>
                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i><?=$data['prop_location']?></p>
                    </div>
                    <!-- Additional Info -->
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i><?= $data['space']?> sqft</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i><?= $data['bedroom']?> Bed</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i><?= $data['bathroom']?> Bath</small>
                    </div>
                </div>
            </div></a>
                <div class="col-lg-6 col-md-6 wow fadeInUp">
                    <!-- <div class="col-md-6"> -->
                        
                        <!-- <h5 class="mb-3">Installmental</h5> -->
                        <div class="about">
                            <!-- <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row mt-1">
                                    <h6>Custom Payment Plan</h6>
                                    
                                </div>
                                <div class="d-flex flex-row align-items-center com-color"> <i class="fa fa-plus-circle"></i> <span class="ml-1">Add Insurer card</span> </div>
                            </div> -->
                            <p>
                                <!-- Elegant 2-bedroom, 2-bath apartment in The Heights, Unit 305, downtown Springfield. 
                                This 1,200 sq. ft. gem features an open-concept living area with hardwood floors 
                                and large windows showcasing stunning city views. The modern kitchen is equipped 
                                with stainless steel appliances, quartz countertops, and ample storage. 
                                The master suite includes a walk-in closet and a luxurious en-suite bathroom 
                                with dual sinks and a soaking tub. A private balcony extends your living space outdoors. 
                                Enjoy top-notch amenities such as a fitness center, rooftop garden, and secure parking. 
                                Located within walking distance to vibrant shops, restaurants, and public transit, 
                                this apartment offers both comfort and convenience in a prime urban setting. -->
                                <?= $data['description']?>
                            </p>
                            <!-- <div class="p-2 d-flex justify-content-between bg-pay align-items-center"> <span>Aetna - Open Access</span> <span>OAP</span> </div> -->
                            <hr>
                            <!-- <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row mt-1">
                                    <h6>Installmental Payment Plan</h6>
                                    
                                </div>
                                <div class="d-flex flex-row align-items-center com-color"> <i class="fa fa-plus-circle"></i> <span class="ml-1">Add Insurer card</span> </div>
                            </div>
                            <p>Insurance claim and all neccessary dependencies will be submitted to your insurer for the covered portion of this order.</p>
                            <div class="p-2 d-flex justify-content-between bg-pay align-items-center"> <span>Aetna - Open Access</span> <span>OAP</span> </div>
                            <hr> -->
                            <!-- <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row mt-1">
                                    <h6>Lump Sum Payment Plan</h6>
                                    
                                </div>
                                <div class="d-flex flex-row align-items-center com-color"> <i class="fa fa-plus-circle"></i> <span class="ml-1">Add Insurer card</span> </div>
                            </div>
                            <p>Insurance claim and all neccessary dependencies will be submitted to your insurer for the covered portion of this order.</p>
                            <div class="p-2 d-flex justify-content-between bg-pay align-items-center"> <span>Aetna - Open Access</span> <span>OAP</span> </div>
                            <hr> -->
                            <!-- <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row mt-1">
                                    <h6>Lump Sum Payment Plan</h6>
                                </div>
                                <div class="d-flex flex-row align-items-center com-color"> <i class="fa fa-plus-circle"></i> <span class="ml-1">Add Payment card</span> </div>
                            </div>
                            <p>Insurance claim and all neccessary dependencies will be submitted to your insurer for the covered portion of this order.</p>
                            <div class="p-2 d-flex justify-content-between bg-pay align-items-center"> <span>Aetna - Open Access</span> <span>OAP</span> </div>
                            <hr> -->
                            <!-- <div class="d-flex flex-column"> <label class="radio"> <input type="radio" name="gender" value="MALE" checked>
                                    <div class="d-flex justify-content-between"> <span>VISA</span> <span>**** 5645</span> </div>
                                </label> <label class="radio"> <input type="radio" name="gender" value="FEMALE">
                                    <div class="d-flex justify-content-between"> <span>MASTER CARD</span> <span>**** 5069</span> </div>
                                </label> </div>
                            <div class="buttons"> <button class="btn btn-success btn-block">Proceed to payment</button> </div> -->
                            <!-- <div class="buttons"> <button class="btn btn-success btn-block">Proceed</button> </div> -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row my-4">
                                    <h6> Available Payment Plans</h6>
                                </div>
                            </div>
                            <input type="hidden" name="plan" id="plan">
                            <div class="d-flex flex-column"> 
                                <label class="radio"> 
                                    <div class="d-flex justify-content-between"> 
                                        <span>Custom Payment Plan</span>
                                        
                                        <i class="fa fa-plus-circle icon" data-toggle="modal" data-target="#paymentModal" id="icon1"></i>
                                    </div>
                                </label>
                                <br> 
                                <!-- <label class="radio">
                                    <div class="d-flex justify-content-between">
                                        <span>Installmental Payment Plan</span> 
                                        <span><i class="fa fa-plus-circle icon" id="icon1"></i></span> 
                                    </div>
                                </label> -->
                                <br>
                                <label class="radio"> 
                                    <div class="d-flex justify-content-between"> 
                                        <span>Lump Sum Payment Plan</span> 
                                        <span><i class="fa fa-plus-circle icon" id="icon2"></i></span> 
                                    </div>
                                </label>  
                            </div>
                            <div class="buttons my-4"> 
                                <button class="btn btn-success btn-block" id="proceed" disabled>Proceed</button> 
                            </div>



                            
                        </div>
                    <!-- </div> -->
                </div>
            <!-- </div> -->
            <!-- <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.3s"> -->
                
            
        </div>
    </div>
</div>
<!-- Call to Action Start -->
<div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded p-3">
                    <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                        <div class="row g-5 align-items-center">
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid rounded w-100" src="img/call-to-action.jpg" alt="">
                            </div>
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="mb-4">
                                    <h1 class="mb-3">Contact With Our Certified Agent</h1>
                                    <p>Ready to take the next step? Our certified agents are here to provide expert advice and guide you through every part of your real estate journey. Reach out today for personalized support!</p>
                                </div>
                                <a href="contact.php#contact-form" class="btn btn-primary py-3 px-4 me-2"><i class="fa fa-calendar-alt me-2"></i>Contact an agent</a>
                                <!-- <a href="" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get Appoinment</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->
<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="mb-0 text-success">$85.00</h5>
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
                        </div>
                        <p>Insurance claim and all necessary dependencies will be submitted to your insurer for the covered portion of this order.</p>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text">.00</span>
                        </div>
                        <div class="buttons">
                            <a href="cc/index.html" class="btn btn-success btn-block">Proceed to payment</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- You can add another button here if needed -->
                </div>
            </div>
        </div>
    </div>
<!-- Category End -->

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>307 Sand Ln, Staten Island, NY 10305, United States</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+1 (212) 518 6963</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>americar@americareside.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Photo Gallery</h5>
                        <div class="row g-2 pt-2">
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-1.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-2.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-3.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-4.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-5.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-6.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Subsribe to our news letter</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Americaresides</a>, All Right Reserved. 
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        <div class="modal_info">
        <h1>Simple jQuery Modal</h1>
        <p>It may not look like much, but it still does exactly what it says straight out of the box.</p>
        </div>
        <div class="modal_overlay">

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        
    //  $(document).ready(function () {
        // Handle form submission
    //     $('#paymentForm').on('submit', function (e) {
    //         e.preventDefault();
    //         const selectedOption = $('input[name="paymentOption"]:checked').val();

    //         if (selectedOption === 'lumpSum') {
    //             // Redirect for lump sum payment
    //             window.location.href = 'lump_sum_payment.php';
    //         } else if (selectedOption === 'customPlan') {
    //             // Show the modal for custom payment
    //             $('#customPaymentModal').modal('show');
    //         } Handle custom payment proceed button
    //     $('#proceedCustomPayment').on('click', function () {
    //         const paymentAmount = $('#paymentAmount').val();

    //         if (paymentAmount && paymentAmount > 0) {
    //             // Redirect to custom payment processing page with the amount
    //             const url = `custom_payment_plan.php?amount=${paymentAmount}`;
    //             window.location.href = url;
    //         } else {
    //             alert('Please enter a valid amount.');
    //         }
    //     });
    
        const icons = document.querySelectorAll('.icon');

icons.forEach(icon => {
    icon.addEventListener('click', () => {
        // Remove 'selected' class from all icons
        icons.forEach((i) => {
            i.classList.remove('selected')
            // console.log(i);
            
        });
        
        // Add 'selected' class to the clicked icon
        icon.classList.add('selected');
        if(icon.id == "icon1"){
            $("#plan").val("custom")
            // console.log($("#plan").val());
        }
        if(icon.id == "icon2"){
            $("#plan").val("full")
        }
        $("#proceed").prop("disabled", false)
    
    });

});

        //

    $("#proceed").click(() => {
        if($("#plan").val() == "custom"){
            window.location.href = "checkout.php?id=<?=$id?>"
        }
        // if($("#userId).val() == ""){
        //   var params = {
        //         returnPage: "cart"
        //     };

        //     let uri = 'admin/pages/form/login.php?' + $.param(params);
        //     window.location.href = uri
        // }
        if($("#plan").val() == "full"){
            var params = {
                id: '<?=$id?>',
                amount: <?=$data['final_price']?>
            };

            let uri = 'buy.php?' + $.param(params);
            window.location.href = uri
        }
    })
    </script>
</body>

</html>
