<?php

session_start();

if(isset($_SESSION["email"])) {
  header("location: index.php");
  exit;
}

$error = false;
$user_type = "";
$email = "";
$user_type_error = "";
$email_error = "";
$password_error = "";
$login_error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user_type = $_POST['userType'] ?? "";
  $email = $_POST['email'] ?? "";
  $password = $_POST['password'] ?? "";

  if (isset($_POST['login'])) {
    if (empty($user_type)) {
      $user_type_error = "Select user type!";
      $error = true;
    }
      
    if(empty($email)) {
      $email_error = "Email is required!";
      $error = true;
    }

    if(empty($password)) {
      $password_error = "Password is required!";
      $error = true;
    }

    if (!$error) {
      require_once "db.php";  // Changed from include to require_once
      $dbConnection = getDatabaseConnection();  // Directly call the function

      $statement = $dbConnection->prepare("SELECT id, user_type, first_name, last_name, phone, password, employee_id, department, created_at FROM users WHERE email = ? AND user_type = ?");
      
      if ($statement) {  // Add error checking for prepare
        $statement->bind_param('ss', $email, $user_type);
        $statement->execute();
        $statement->bind_result($id, $user_type, $first_name, $last_name, $phone, $stored_password, $employee_id, $department, $created_at);

        if($statement->fetch()) {
          if(password_verify($password, $stored_password)) {
            session_start();  // Make sure session is started
            $_SESSION["id"] = $id;
            $_SESSION["user_type"] = $user_type;
            $_SESSION["first_name"] = $first_name;
            $_SESSION["last_name"] = $last_name;
            $_SESSION["email"] = $email;
            $_SESSION["phone"] = $phone;
            $_SESSION["employee_id"] = $employee_id;
            $_SESSION["department"] = $department;
            $_SESSION["created_at"] = $created_at;
            
            header("location: index.php");
            exit;
          } else {
            $login_error = "Invalid password!";
          }
        } else {
          $login_error = "Invalid email or user type!";
        }
        $statement->close();
      } else {
        $login_error = "Database error occurred!";
      }
      $dbConnection->close();
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

    <title>GoSmartCity - Login</title>

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
    <link href="css/style.css" rel="stylesheet" />
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
                <li class="nav-item">
                  <a class="nav-link" href="service.html">Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="why.html">Why Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="team.html">Team</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="#">
                    <i class="fa fa-user" aria-hidden="true"></i> Login
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </header>
      <!-- end header section -->
    </div>

    <!-- login section -->
    <section class="login_section layout_padding">
      <div class="container">
        <div class="heading_container heading_center">
          <h2>Login to <span>GoSmartCity</span></h2>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="login_container">
              <form method="POST">
                <div class="form-group">
                  <label for="userType" class="font-weight-bold"
                    >User Type</label
                  >
                  <select
                    class="form-control"
                    id="userType"
                    name="userType"
                    placeholder="Select user type">
                    <option value=""  disabled <?= empty($user_type) ? 'selected' : '' ?> >Select user type</option>
                    <option value="admin" <?= $user_type == "admin" ? 'selected' : '' ?> >Admin</option>
                    <option value="user" <?= $user_type == "user" ? 'selected' : '' ?> >User</option>
                  </select>
                  <span class="text-danger"> <?=$user_type_error?> </span>
                </div>
                <div class="form-group">
                  <label for="email" class="font-weight-bold"
                    >Email address</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="<?=$email ?>"
                    placeholder="Enter your email"/>
                    <span class="text-danger"><?=$email_error ?></span>
                </div>
                <div class="form-group">
                  <label for="password" class="font-weight-bold"
                    >Password</label
                  >
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                  />
                  <span class="text-danger"><?=$password_error ?></span>
                </div>

                <?php if(!empty($login_error)): ?>
                  <div class="alert alert-danger"><?= htmlspecialchars($login_error) ?></div>
                <?php endif; ?>

                <div class="d-flex gap-3" style="gap: 16px;">
                  <button type="submit" name="login" class="btn btn-primary flex-fill">Login</button>
                  <a href="index.php" class="btn btn-primary flex-fill text-center d-flex justify-content-center align-items-center">Cancel</a>
                </div>
                <div class="mt-4 text-center">
                  <p>
                    Don't have an account?
                    <a href="register.php" class="register-link"
                      >Register here</a
                    >
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end login section -->

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
          <div class="col-md-6 col-lg-3 info_col">
            <h4>Subscribe</h4>
            <form action="#">
              <input type="text" placeholder="Enter email" />
              <button type="submit">Subscribe</button>
            </form>
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
