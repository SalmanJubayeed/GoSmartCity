<?php
session_start();

if(!isset($_SESSION["email"])) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
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

    <title>GoSmartCity - Profile</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap"
      rel="stylesheet"
    />

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
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
                <li class="nav-item">
                  <a class="nav-link" href="service.html">Services</a>
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

    <!-- Profile section -->
<section class="profile_section layout_padding">
  <div class="container-fluid">
    <div class="heading_container heading_center">
      <h2 class="">User <span>Profile</span></h2>
    </div>

    <div class="profile_container">
      <div class="row">
        <div class="col-lg-6 mx-auto">
          <div class="box">
            
            <!-- Profile Details -->
            <div class="detail-box">
              <!-- User Type -->
              <div class="profile-row">
                <div class="label">User Type</div>
                <div class="value"><?=$_SESSION["user_type"]?></div>
              </div>
              
              <!-- First Name -->
              <div class="profile-row">
                <div class="label">First Name</div>
                <div class="value"><?=$_SESSION["first_name"]?></div>
              </div>
              
              <!-- Last Name -->
              <div class="profile-row">
                <div class="label">Last Name</div>
                <div class="value"><?=$_SESSION["last_name"]?></div>
              </div>
              
              <!-- Email -->
              <div class="profile-row">
                <div class="label">Email</div>
                <div class="value"><?=$_SESSION["email"]?></div>
              </div>
              
              <!-- Phone -->
              <div class="profile-row">
                <div class="label">Phone</div>
                <div class="value"><?=$_SESSION["phone"]?></div>
              </div>
              
              <!-- Admin Only Information -->
              <?php if($_SESSION["user_type"] === "admin"): ?>
                <!-- Employee ID -->
                <div class="profile-row">
                  <div class="label">Employee ID</div>
                  <div class="value"><?=$_SESSION["employee_id"]?></div>
                </div>
                
                <!-- Department -->
                <div class="profile-row">
                  <div class="label">Department</div>
                  <div class="value"><?=$_SESSION["department"]?></div>
                </div>
              <?php endif; ?>
              
              <!-- Created At -->
              <div class="profile-row">
                <div class="label">Created at</div>
                <div class="value"><?=$_SESSION["created_at"]?></div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="social_box">
              <a href="index.php" class="btn-home">
                <i class="fa fa-home" aria-hidden="true"></i> Home
              </a>
              <a href="logout.php" class="btn-logout">
                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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
                  <span> Location </span>
                </a>
                <a href="">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <span> Call +01 1234567890 </span>
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
                <a class="" href="index.html"> Home </a>
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

    <!-- Scripts -->

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