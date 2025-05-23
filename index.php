<?php
session_start();

$authenticated = false;
if(isset($_SESSION["email"])) {
  $authenticated = true;
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

    <!-- Icon -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />

    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/info.css">
  </head>
  <style>
    body{
      background-color: #ffffff;
    }
    .service_section{
      background-color: #ffffff;
    }
  </style>

  <body>
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
              <span class="brand-text"> GoSmartCity </span>
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
                <li class="nav-item active">
                  <a class="nav-link" href="index.php"
                    >Home <span class="sr-only">(current)</span></a
                  >
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

                <?php
                if($authenticated) {
                  ?>

                <li class="nav-item active dropdown">
                  <a
                    class="nav-link dropdown-toggle"
                    href=""
                    id="usersDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg>  <?=$_SESSION["first_name"]?> <span class="sr-only">(current)</span>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                    <a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                  </div>
                </li>
                <?php
                } else {
                ?>

                <li class="nav-item">
                  <a class="nav-link" href="register.php">
                    <i class="fa fa-user" aria-hidden="true"></i> Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">
                    <i class="fa fa-user" aria-hidden="true"></i> Login</a>
                </li>
                <?php }
                ?>

              </ul>
            </div>
          </nav>
        </div>
      </header>
      <!-- end header section -->
      <!-- slider section -->
      <section class="slider_section">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="detail-box">
                      <h1>
                        Traffic <br />
                        Updates
                      </h1>
                      <p>
                        Stay informed with real-time traffic updates to navigate
                        the city effortlessly. <br />
                        Get live traffic reports and avoid delays with our
                        up-to-date city navigation features.
                      </p>
                      <div class="btn-box">
                        <a href="traffic.html" class="btn1"> Read More </a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="img-box">
                      <img
                        src="images/traffic-lights.png"
                        alt="Traffic monitoring system visualization"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="detail-box">
                      <h1>
                        Housing <br />
                        Search
                      </h1>
                      <p>
                        Explore a variety of housing options to find the perfect
                        home in your desired area. <br />
                        Discover affordable and convenient living spaces
                        tailored to your needs and budget.
                      </p>
                      <div class="btn-box">
                        <a href="housing.html" class="btn1"> Read More </a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="img-box">
                      <img
                        src="images/real-estate.png"
                        alt="Modern housing options"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="detail-box">
                      <h1>
                        Dining <br />
                        Spots
                      </h1>
                      <p>
                        Discover the best dining spots around the city, from
                        local gems to popular restaurants. Find the perfect
                        place to eat, whether you're in the mood for a quick
                        bite or a fine dining experience.
                      </p>
                      <div class="btn-box">
                        <a href="dining.html" class="btn1"> Read More </a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="img-box">
                      <img
                        src="images/dining-table (1).png"
                        alt="Local dining establishments"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <ol class="carousel-indicators">
            <li
              data-target="#customCarousel1"
              data-slide-to="0"
              class="active"
            ></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li>
          </ol>
        </div>
      </section>
      <!-- end slider section -->
    </div>

    <!-- service section -->

    <section class="service_section layout_padding">
      <div class="service_container">
        <div class="container">
          <div class="heading_container heading_center">
            <h2>Our <span>Services</span></h2>
            <p>
              Discover a wide range of services crafted to meet your needs,
              ensuring quality and originality without compromise.
            </p>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="box">
                <div class="img-box">
                  <img src="images/traffic-light.png" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Traffic Updates</h5>
                  <p>
                    Users will appreciate the real-time traffic updates,
                    allowing them to plan their commutes effectively and avoid
                    delays by providing accurate and timely route information.
                  </p>
                  <button class="btn btn-dark">
                    <a href="traffic.html"> Get Started </a>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box">
                <div class="img-box">
                  <img src="images/search.png" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Housing Search</h5>
                  <p>
                    Potential buyers and renters will be drawn to the clean,
                    organized layout of our housing listings, ensuring they can
                    easily browse options and find their ideal home quickly.
                  </p>
                  <button class="btn btn-dark">
                    <a href="housing.html"> Get Started</a>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box">
                <div class="img-box">
                  <img src="images/dining-table.png" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Dining Spots</h5>
                  <p>
                    Food lovers will enjoy discovering a curated list of dining
                    spots, offering a seamless experience to explore the best
                    local restaurants and eateries based on real-time
                    recommendations.
                  </p>
                  <button class="btn btn-dark">
                    <a href="dining.html"> Get Started</a>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box">
                <div class="img-box">
                  <img src="images/budget.png" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Budget Tracker</h5>
                  <p>
                    Users will find managing finances effortless with our budget
                    tracker, featuring a simple design that makes tracking
                    expenses and setting financial goals quick and efficient.
                  </p>
                  <button class="btn btn-dark">
                    <a href="budget.html"> Get Started</a>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="btn-box">
            <a href="service.html"> View All </a>
          </div>
        </div>
      </div>
    </section>

    <!-- end service section -->

    <!-- about section -->

    <section class="about_section layout_padding">
      <div class="container">
        <div class="heading_container heading_center">
          <h2>About <span>Us</span></h2>
          <p>
            GoSmartCity seeks to enhance urban living with real-time traffic
            updates, housing solutions, and navigation tools for a smarter,
            stress-free lifestyle.
          </p>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="img-box">
              <img src="images/GoSmartCitygreen.png" alt="" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="detail-box">
              <h3>We Are GoSmartCity</h3>
              <p>
                We are a platform dedicated to enhancing urban living through
                innovative technology, offering real-time traffic updates,
                housing options, and city exploration tools. Designed to
                simplify daily life, GoSmartCity provides tailored solutions for
                commuters, residents, and visitors alike.
              </p>
              <p>more of us......</p>
              <a href="about.html"> Read More </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end about section -->

    <!-- why section -->

    <section class="why_section layout_padding">
      <div class="container">
        <div class="heading_container heading_center">
          <h2>Why Choose <span>Us</span></h2>
        </div>
        <div class="why_container">
          <div class="box">
            <div class="img-box">
              <img src="images/mobile-app.png" alt="" />
            </div>
            <div class="detail-box">
              <h5>Real-Time Insights</h5>
              <p>
                Stay ahead with live traffic updates, navigation guidance, and
                current city trends. Our platform ensures you always make
                informed decisions to save time and avoid hassle.
              </p>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="images/customization.png" alt="" />
            </div>
            <div class="detail-box">
              <h5>Personalized Experiences</h5>
              <p>
                Get recommendations tailored to your preferences, whether you're
                looking for housing, dining, or transportation options. Our
                AI-powered tools adapt to your unique needs.
              </p>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="images/thumbs-up.png" alt="" />
            </div>
            <div class="detail-box">
              <h5>Verified & Reliable Services</h5>
              <p>
                Access trustworthy information, including verified housing
                listings, accurate navigation routes, and community reviews,
                ensuring a stress-free and safe experience.
              </p>
            </div>
          </div>
          <div class="box">
            <div class="img-box">
              <img src="images/life.png" alt="" />
            </div>
            <div class="detail-box">
              <h5>Simplified Urban Living</h5>
              <p>
                From helping you find affordable housing to offering dining and
                city exploration options, our platform is designed to make daily
                life easier and more efficient for everyone.
              </p>
            </div>
          </div>
        </div>
        <div class="btn-box">
          <a href="why.html"> Read More </a>
        </div>
      </div>
    </section>

    <!-- end why section -->

    <!-- team section -->
    <section class="team_section layout_padding">
      <div class="container-fluid">
        <div class="heading_container heading_center">
          <h2 class="">Our <span> Team</span></h2>
        </div>

        <div class="team_container">
          <div class="row">
            <div class="col-lg-3 col-sm-6">
              <div class="box">
                <div class="img-box">
                  <img src="images/rocky.jpg" class="img1" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Tanbirur Rahman</h5>
                  <p>Head of Urban Solutions</p>
                </div>
                <div class="social_box">
                  <a href="#">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="bi bi-twitter-x" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="box">
                <div class="img-box">
                  <img src="images/salman.jpg" class="img1" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Salman Jubayeed</h5>
                  <p>Chief Product Officer</p>
                </div>
                <div class="social_box">
                  <a href="https://www.facebook.com/salman.jubayeed/">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="bi bi-twitter-x" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="https://www.instagram.com/salman_jubayeed/">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                  <a href="https://youtube.com/@salmanjubayeed3182">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="box">
                <div class="img-box">
                  <img src="images/faraz.jpg" class="img1" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Faraz Fardin</h5>
                  <p>Community Experience Director</p>
                </div>
                <div class="social_box">
                  <a href="#">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="bi bi-twitter-x" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end team section -->

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
                <i class="bi bi-twitter-x" aria-hidden="true"></i>
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
