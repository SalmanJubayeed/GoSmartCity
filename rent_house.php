<?php
session_start();
include 'db.php';

$conn = getDatabaseConnection(); // Call the function to get the connection

// Check if user is logged in using email
if (!isset($_SESSION['email'])) {
    echo "<script>alert('You must be logged in to rent your house.'); window.location.href='login.php';</script>";
    exit(); 
}

$email = $_SESSION['email'];

global $conn;

// Fetch user details using email
$query = "SELECT id, first_name, last_name, phone FROM users WHERE email=?";
$stmt = $conn->prepare($query);

if(!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user exists
if (!$user) {
    echo "User not found.";
    exit();
}

// Assign user data
$user_id = $user['id']; // You may need this for saving rentals
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$phone = $user['phone'];

// Initialize form variables
$rental_type = '';
$location = '';
$floor = '';
$bedrooms = '';
$bathrooms = '';
$gas_type = '';
$monthly_rent = '';
$features = '';


// Initialize error flags and variables
$rental_type_error = "";
$location_error = "";
$floor_error = "";
$bedrooms_error = "";
$bathrooms_error = "";
$gas_type_error = "";
$rent_error = "";
$features_error = "";

$error = false;

// Process form on POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $rental_type = $_POST['rentalType'] ?? '';
    $location = $_POST['location'] ?? '';
    $floor = $_POST['floor'] ?? '';
    $bedrooms = $_POST['bedrooms'] ?? '';
    $bathrooms = $_POST['bathrooms'] ?? '';
    $gas_type = $_POST['gasType'] ?? '';
    $monthly_rent = $_POST['monthlyRent'] ?? '';
    $features = $_POST['features'] ?? '';

    // Validation checks
    if (empty($rental_type)) {
        $rental_type_error = "Rental type is required";
        $error = true;
    }

    if (empty($location)) {
        $location_error = "Location is required";
        $error = true;
    }

    if (empty($floor)) {
        $floor_error = "Floor number is required";
        $error = true;
    }

    if (empty($bedrooms)) {
        $bedrooms_error = "Number of bedrooms is required";
        $error = true;
    }

    if (empty($bathrooms)) {
        $bathrooms_error = "Number of bathrooms is required";
        $error = true;
    }

    if (empty($gas_type)) {
        $gas_type_error = "Gas type is required";
        $error = true;
    }

    if (empty($monthly_rent) || !is_numeric($monthly_rent)) {
        $rent_error = "Valid monthly rent is required";
        $error = true;
    }

    // if (empty($features)) {
    //     $features_error = "Additional features description is required";
    //     $error = true;
    // }

    // If no errors, save the property listing to the database
    if (!$error) {
        $stmt = $conn->prepare("INSERT INTO rentals (user_id, rental_type, location, floor, bedrooms, bathrooms, gas_type, monthly_rent, features, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("isssiisss", $user_id, $rental_type, $location, $floor, $bedrooms, $bathrooms, $gas_type, $monthly_rent, $features);
        if ($stmt->execute()) {
            echo "<script>alert('Your house has been listed successfully!'); window.location.href='index.php';</script>";
            exit();
        } else {
            echo "Error in listing your property. Please try again.";
        }
    }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/GoSmartCitygreen.png" type="" />

    <title>GoSmartCity</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap"
      rel="stylesheet"
    />


    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/info.css">
    <link rel="stylesheet" href="css/rent_house.css">
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
  </head>

  <body class="sub_page">
    <div class="hero_area">
      <div class="hero_bg_box">
        <div class="bg_img_box">
          <img src="images/hero-bg.png" alt="" />
        </div>
      </div>

      <!-- header section strats -->
      <header class="header_section">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="index.php">
              <img
                src="images/GoSmartCitygreen.png"
                alt="GoSmartCity Logo"
                class="brand-logo"
              />
              <span> GoSmartCity </span>
            </a>

            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.html"> About</a>
                </li>
                <li class="nav-item active dropdown">
                  <a
                    class="nav-link dropdown-toggle"
                    href="service.html"
                    id="serviceDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >Services <span class="sr-only">(current)</span>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                    <a class="dropdown-item" href="traffic.html">Traffic Updates</a>
                    <a class="dropdown-item" href="dining.html">Dining Spots</a>
                    <a class="dropdown-item" href="budget.html">Budget Tracker</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="why.html">Why Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="team.html">Team</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </header>
      <!-- end header section -->
    </div>

 <!-- housing section -->
<section class="housing_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Housing <span>Options</span></h2>
      <p>
        List your property with our comprehensive
        housing solutions
      </p>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <!-- House Owner Section -->
        <div class="housing_box owner_box">
          <h3 class="section_heading text-center">Rent Your House or Apartment</h3>
          <form method="post" class="owner_form">
            <div class="row g-3">
              <!-- Rental Type -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Rental Type</label>
                  <select class="form-select" name="rentalType">
                    <option value="" disabled <?= empty($rental_type) ? 'selected' : '' ?>>Select Rental Type</option>
                    <option value="Family" <?= $rental_type == "Family" ? 'selected' : '' ?>>Family</option>
                    <option value="Bachelor" <?= $rental_type == "Bachelor" ? 'selected' : '' ?>>Bachelor</option>
                  </select>
                  <span class="text-danger"><?= $rental_type_error ?></span>
                </div>
              </div>

              <!-- Location -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Location</label>
                  <select class="form-select" name="location">
                    <option value="" disabled <?= empty($location) ? 'selected' : '' ?>>Select Location</option>
                    <option value="Chawk Bazar" <?= $location == "Chawk Bazar" ? 'selected' : '' ?>>Chawk Bazar</option>
                    <option value="Bakalia" <?= $location == "Bakalia" ? 'selected' : '' ?>>Bakalia</option>
                    <option value="Jamal Khan" <?= $location == "Jamal Khan" ? 'selected' : '' ?>>Jamal Khan</option>
                  </select>
                  <span class="text-danger"><?= $location_error ?></span>
                </div>
              </div>

              <!-- Floor Number -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Floor Number</label>
                  <select class="form-select" name="floor">
                    <option value="" disabled <?= empty($floor) ? 'selected' : '' ?>>Select Floor</option>
                    <option value="Ground Floor" <?= $floor == "Ground Floor" ? 'selected' : '' ?>>Ground Floor</option>
                    <option value="1st Floor" <?= $floor == "1st Floor" ? 'selected' : '' ?>>1st Floor</option>
                    <option value="2nd Floor" <?= $floor == "2nd Floor" ? 'selected' : '' ?>>2nd Floor</option>
                    <!-- Add more floors as needed -->
                  </select>
                  <span class="text-danger"><?= $floor_error ?></span>
                </div>
              </div>

              <!-- Bedrooms -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Number of Bedrooms</label>
                  <select class="form-select" name="bedrooms">
                    <option value="" disabled <?= empty($bedrooms) ? 'selected' : '' ?>>Select Number of Bedrooms</option>
                    <option value="2" <?= $bedrooms == "2" ? 'selected' : '' ?>>2</option>
                    <option value="3" <?= $bedrooms == "3" ? 'selected' : '' ?>>3</option>
                    <option value="4" <?= $bedrooms == "4" ? 'selected' : '' ?>>4</option>
                  </select>
                  <span class="text-danger"><?= $bedrooms_error ?></span>
                </div>
              </div>

              <!-- Bathrooms -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Number of Bathrooms</label>
                  <select class="form-select" name="bathrooms">
                    <option value="" disabled <?= empty($bathrooms) ? 'selected' : '' ?>>Select Number of Bathrooms</option>
                    <option value="1" <?= $bathrooms == "1" ? 'selected' : '' ?>>1</option>
                    <option value="2" <?= $bathrooms == "2" ? 'selected' : '' ?>>2</option>
                    <option value="3" <?= $bathrooms == "3" ? 'selected' : '' ?>>3</option>
                  </select>
                  <span class="text-danger"><?= $bathrooms_error ?></span>
                </div>
              </div>

              <!-- Gas Type -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Gas Type</label>
                  <select class="form-select" name="gasType">
                    <option value="" disabled <?= empty($gas_type) ? 'selected' : '' ?>>Select Gas Type</option>
                    <option value="Gas Meter" <?= $gas_type == "Gas Meter" ? 'selected' : '' ?>>Gas Meter</option>
                    <option value="Gas Cylinder" <?= $gas_type == "Gas Cylinder" ? 'selected' : '' ?>>Gas Cylinder</option>
                  </select>
                  <span class="text-danger"><?= $gas_type_error ?></span>
                </div>
              </div>

              <!-- Monthly Rent -->
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">Monthly Rent (৳)</label>
                  <input type="number" class="form-control" name="monthlyRent" value="<?= $monthly_rent ?>" placeholder="Enter monthly rent" />
                  <span class="text-danger"><?= $rent_error ?></span>
                </div>
              </div>

              <!-- Additional Features -->
              <div class="col-12">
                <div class="form-group">
                  <label class="form-label">Additional Features</label>
                  <textarea class="form-control" name="features" rows="3" placeholder="Describe any additional features or requirements"><?= $features ?></textarea>
                  <span class="text-danger"><?= $features_error ?></span>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="col-12">
                <button type="submit" class="btn btn-primary w-100 list_property_btn">List Your Property</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end housing section -->

    <!-- info section -->

    <section class="info_section layout_padding2">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 info_col">
            <div class="info_contact">
              <h4>Address</h4>
              <div class="contact_link_box">
                <a href="">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <span> West Kadhurkhil, Boalkhali, Chattogram </span>
                </a>
                <a href="">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <span> Call +880 1540 336996 </span>
                </a>
                <a href="">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <span> gosmartcity@gmail.com </span>
                </a>
              </div>
            </div>
            <div class="info_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 info_col">
            <div class="info_detail">
              <h4>Info</h4>
              <p>
                GoSmartCity offers real-time traffic updates, housing options,
                and navigation tools, enhancing urban living with smart
                solutions for a more convenient, efficient, and stress-free
                lifestyle.
              </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-2 mx-auto info_col">
            <div class="info_link_box">
              <h4>Links</h4>
              <div class="info_links">
                <a class="active" href="index.php"> Home </a>
                <a class="" href="about.html"> About </a>
                <a class="" href="service.html"> Services </a>
                <a class="" href="why.html"> Why Us </a>
                <a class="" href="team.html"> Team </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end info section -->

    <!-- footer section -->
    <section class="footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <b>GoSmartCity</b>
        </p>
      </div>
    </section>
    <!-- footer section -->

    <!-- jQery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- custom js -->
    <script type="text/javascript" src="js/custom.js"></script>
  </body>
</html>
