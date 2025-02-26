<?php
session_start(); // Ensure session is started

if (isset($_SESSION["email"])) {
    header("location: index.php");
    exit();
}

$user_type = "";
$first_name = "";
$last_name = "";
$email = "";
$phone = "";
$department = "";
$employee_id = "";

$user_type_error = "";
$first_name_error = "";
$last_name_error = "";
$email_error = "";
$phone_error = "";
$department_error = "";
$employee_id_error = "";
$password_error = "";
$confirm_password_error = "";
$terms_error = "";

$error = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_type = $_POST['userType'] ?? "";
    $first_name = $_POST['firstName'] ?? "";
    $last_name = $_POST['lastName'] ?? "";
    $email = $_POST['email'] ?? "";
    $phone = $_POST['phone'] ?? "";
    $department = $_POST['department'] ?? "";
    $employee_id = $_POST['employeeId'] ?? "";
    $password = $_POST['password'] ?? "";
    $confirm_password = $_POST['confirmPassword'] ?? "";

    if (empty($user_type)) {
        $user_type_error = "Select user type";
        $error = true;
    }

    if (empty($first_name)) {
        $first_name_error = "First name is required";
        $error = true;
    }

    if (empty($last_name)) {
        $last_name_error = "Last name is required";
        $error = true;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Email format is not valid";
        $error = true;
    }

    include "db.php";
    $dbConnection = getDatabaseConnection();

    $statement = $dbConnection->prepare("SELECT id FROM users WHERE email = ?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows > 0) {
        $email_error = "Email is already used";
        $error = true;
    }

    $statement->close();

    if (!preg_match("/^(\+|00\d{1,3})?[- ]?\d{7,12}$/", $phone)) {
        $phone_error = "Phone format is not valid";
        $error = true;
    }

    if ($user_type == "admin") {
        if (empty($department)) {
            $department_error = "Select Department";
            $error = true;
        }

        if (empty($employee_id)) {
            $employee_id_error = "Employee ID is required";
            $error = true;
        }
    }

    if (strlen($password) < 6) {
        $password_error = "Password must have at least 6 characters";
        $error = true;
    }

    if ($confirm_password != $password) {
        $confirm_password_error = "Password and Confirm Password do not match";
        $error = true;
    }

    $terms = isset($_POST['terms']) ? $_POST['terms'] : '';
    if (empty($terms)) {
        $terms_error = "You must accept the terms and conditions";
        $error = true;
    }

    if (!$error) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date("Y-m-d H:i:s");

        $statement = $dbConnection->prepare("INSERT INTO users(user_type, first_name, last_name, email, phone, password, employee_id, department, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param('sssssssss', $user_type, $first_name, $last_name, $email, $phone, $password, $employee_id, $department, $created_at);
        $statement->execute();

        $insert_id = $statement->insert_id;
        $statement->close();

        if ($insert_id) {
            $_SESSION["id"] = $insert_id;
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
            echo "Error in registration. Please try again.";
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

    <title>GoSmartCity - Register</title>

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
    <link rel="stylesheet" href="css/info.css">
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
                  <a class="nav-link" href="login.php">
                    <i class="fa fa-user" aria-hidden="true"></i> Login
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </header>
      <!-- end header section -->
    </div>

  <!-- register section -->
<section class="register_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Create an <span>Account</span></h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="register_container">
          <form method="post">
            <div class="form-group">
              <label for="userType" class="font-weight-bold">User Type</label>
              <select class="form-control" id="userType" name="userType">
                <option value="" disabled <?= empty($user_type) ? 'selected' : '' ?> >Select user type</option>
                <option value="admin" <?= $user_type == "admin" ? 'selected' : '' ?> >Admin</option>
                <option value="user" <?= $user_type == "user" ? 'selected' : '' ?> >User</option>
              </select>
              <span class="text-danger"> <?=$user_type_error?> </span>
            </div>
            <div id="departmentFields" style="display: none;">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="department" class="font-weight-bold">Department Name</label>
                    <select class="form-control" id="department" name="department" value="<?=$department ?>">
                      <option value="" selected disabled>Select department</option>
                      <option value="IT">IT</option>
                      <option value="Management">Management</option>
                    </select>
                    <span class="text-danger"><?=$department_error?> </span>                 
                   </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="departmentId" class="font-weight-bold">Employee ID</label>
                    <input type="text" class="form-control" id="employeeId" name="employeeId" value="<?= htmlspecialchars($employee_id) ?>"
                    placeholder="Enter employee ID" />
                    <span class="text-danger"> <?=$employee_id_error ?> </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstName" class="font-weight-bold">First Name</label>
                  <input type="text" class="form-control" id="firstName" name="firstName" value="<?=$first_name ?>" placeholder="Enter your first name" />
                  <span class="text-danger"> <?=$first_name_error ?> </span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastName" class="font-weight-bold">Last Name</label>
                  <input type="text" class="form-control" id="lastName" name="lastName" value="<?=$last_name ?>" placeholder="Enter your last name" />
                  <span class="text-danger"> <?=$last_name_error ?> </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="font-weight-bold">Email address</label>
              <input type="email" class="form-control" id="email" name="email" value="<?=$email ?>" placeholder="Enter your email" />
              <span class="text-danger"><?=$email_error ?></span>
            </div>
            <div class="form-group">
              <label for="phone" class="font-weight-bold">Phone Number</label>
              <input type="tel" class="form-control" id="phone" name="phone" value="<?=$phone ?>" placeholder="Enter your phone number" />
              <span class="text-danger"><?=$phone_error ?></span>
            </div>
            <div class="form-group">
              <label for="password" class="font-weight-bold">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" />
              <span class="text-danger"><?=$password_error ?></span>
            </div>
            <div class="form-group">
              <label for="confirmPassword" class="font-weight-bold">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" />
              <span class="text-danger"><?=$confirm_password_error ?></span>
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="terms" name="terms" value="1" <?= isset($_POST['terms']) ? 'checked' : '' ?> />
              <label class="form-check-label" for="terms">I agree to the Terms and Conditions</label>
              <span class="text-danger"><?=$terms_error ?></span>
            </div>
            <div class="d-flex gap-3" style="gap: 16px;">
                <button type="submit" class="btn btn-primary flex-fill">Register</button>
                <a href="index.php" class="btn btn-primary flex-fill text-center d-flex justify-content-center align-items-center">Cancel</a>
            </div>
            <div class="mt-4 text-center">
              <p>Already have an account? <a href="login.php" class="login-link">Login here</a></p>
            </div>
          </form>
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
                  <span> West Kadhurkhil, Boalkhali, Chattogram </span>
                </a>
                <a href="">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <span> Call +880 01540 336996 </span>
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
                <a class="" href="index.php"> Home </a>
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
    <!-- Add these scripts in the head section of your HTML -->
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-database.js"></script>
     <!-- custom js -->
    <script type="module" src="js/register-custom.js" ></script>
  </body>
</html>
