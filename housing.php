<?php
session_start();
include 'db.php';

$conn = getDatabaseConnection(); 

$query = "SELECT rentals.id, rentals.rental_type, rentals.location, rentals.floor, rentals.bedrooms, rentals.bathrooms, 
                 rentals.gas_type, rentals.monthly_rent, rentals.features, rentals.user_id as owner_id, 
                 users.first_name, users.last_name, users.phone
          FROM rentals
          JOIN users ON rentals.user_id = users.id
          WHERE rentals.id NOT IN (
              SELECT DISTINCT rental_id FROM bookings WHERE status = 'approved')";
$result = $conn->query($query);

$is_logged_in = isset($_SESSION['email']);
$user_info = [];

if ($is_logged_in) {
    // Fetch logged-in user details using email
    $user_email = $_SESSION['email'];
    $user_query = "SELECT id, first_name, phone, email FROM users WHERE email = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $user_result = $stmt->get_result();
    $user_info = $user_result->fetch_assoc();
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

    <!--owl slider stylesheet -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/info.css">
    <link rel="stylesheet" href="css/housing.css">
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


<!-- Housing Section -->
<section class="housing_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Housing <span>Options</span></h2>
      <p>Find your perfect home or list your property with our platform.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <!-- Available Rentals Section -->
        <div class="housing_box">
          <h3 class="section_heading text-center">Available Houses</h3>
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="rental_item border p-3 mb-3">
              <h4>Rental Type: <?= htmlspecialchars($row['rental_type']) ?></h4>
              <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
              <p><strong>Floor:</strong> <?= htmlspecialchars($row['floor']) ?></p>
              <p><strong>Bedrooms:</strong> <?= htmlspecialchars($row['bedrooms']) ?></p>
              <p><strong>Bathrooms:</strong> <?= htmlspecialchars($row['bathrooms']) ?></p>
              <p><strong>Gas Type:</strong> <?= htmlspecialchars($row['gas_type']) ?></p>
              <p><strong>Rent:</strong> ৳<?= htmlspecialchars($row['monthly_rent']) ?></p>
              <p><strong>Owner:</strong> <?= htmlspecialchars($row['first_name'] . " " . $row['last_name']) ?></p>
              <p><strong>Contact:</strong> <?= htmlspecialchars($row['phone']) ?></p>
              
              <?php if ($is_logged_in && !empty($user_info)): ?>
                <form action="book_house.php" method="post">
                  <input type="hidden" name="rental_id" value="<?= htmlspecialchars($row['id']) ?>">
                  <input type="hidden" name="owner_id" value="<?= htmlspecialchars($row['owner_id']) ?>">
                  <input type="hidden" name="user_name" value="<?= htmlspecialchars($user_info['first_name']) ?>">
                  <input type="hidden" name="user_phone" value="<?= htmlspecialchars($user_info['phone']) ?>">
                  <input type="hidden" name="user_email" value="<?= htmlspecialchars($user_info['email']) ?>">
                  <button type="submit" class="btn btn-primary w-100">Book House</button>
                </form>
              <?php else: ?>
                <p class="text-danger text-center">You need to <a href="login.php">log in</a> to book a house.</p>
              <?php endif; ?>
              
            </div>
          <?php endwhile; ?>
        </div>

        <!-- House Owner Section -->
        <div class="housing_box owner_box mt-5">
          <h3 class="section_heading text-center">Rent Your House or Apartment</h3>
          <div class="owner_content">
            <p class="text-center">List your property with us and reach thousands of potential tenants.</p>
            <div class="owner_cta text-center">
              <a href="rent_house.php" class="btn btn-primary list_property_btn">List Your Property</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Housing Section -->


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
