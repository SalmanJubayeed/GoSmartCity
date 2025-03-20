<?php
session_start();
include 'db.php';

$conn = getDatabaseConnection();

if(!isset($_SESSION["email"])) {
    header("location: login.php");
    exit;
}

if (!isset($_SESSION["id"])) {
    die("Error: User ID is not set. Please log in again.");
}

$user_id = $_SESSION["id"];
$user_email = $_SESSION["email"];

// Fetch user's rentals
$query1 = "SELECT * FROM rentals WHERE user_id = ?";
$stmt1 = $conn->prepare($query1);
$stmt1->bind_param("i", $user_id);
$stmt1->execute();
$rentals = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch bookings for the user's rentals
$query2 = "SELECT b.id, b.owner_id, b.user_name, b.user_phone, b.rental_id, b.status, b.created_at,
          r.location, r.monthly_rent
          FROM bookings b
          JOIN rentals r ON b.rental_id = r.id
          WHERE b.owner_id = ?";  // Fixed from r.user_id to b.owner_id

$stmt2 = $conn->prepare($query2);
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$bookings = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch user bookings with rental details
$query3 = "SELECT 
            bookings.id AS booking_id, bookings.status, bookings.created_at,
            rentals.rental_type, rentals.location, rentals.floor, rentals.bedrooms, rentals.bathrooms, 
            rentals.gas_type, rentals.monthly_rent, rentals.features
          FROM bookings
          JOIN rentals ON bookings.rental_id = rentals.id
          WHERE bookings.user_email = ? 
          ORDER BY bookings.created_at DESC";

$stmt3 = $conn->prepare($query3);
$stmt3->bind_param("s", $user_email);
$stmt3->execute();
$result = $stmt3->get_result();


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
    <link rel="stylesheet" href="css/info.css">
    <style>
      /* Container styling for profile sections */
.profile-section {
  background-color: #002147;
  color: white;
  padding: 20px;
  border-radius: 5px;
  margin-bottom: 30px;
}

/* Table heading styling */
h3 {
  color: #00bbf0;
  margin-bottom: 15px;
  font-size: 22px;
  text-align: center;
  padding-bottom: 10px;
  border-bottom: 1px solid #0078B6;
}

/* Table styling */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  background-color: #001836;
  border: 1px solid #0078B6;
}

th {
  background-color: #001430;
  color: #00bbf0;
  padding: 10px;
  text-align: center;
  font-weight: bold;
  border: 1px solid #0078B6;
}

td {
  padding: 8px 10px;
  text-align: center;
  border: 1px solid #0078B6;
  color: white;
}

/* Alternating row colors for better readability */
tr:nth-child(even) {
  background-color: #002856;
}

/* Hover effect */
tr:hover td {
  background-color: #003366;
}

/* Empty state message */
p {
  color: #8eacc5;
  text-align: center;
  font-style: italic;
  padding: 15px 0;
}

/* Responsive adjustments */
@media screen and (max-width: 768px) {
  table {
    font-size: 14px;
  }
  
  th, td {
    padding: 6px 4px;
  }
  
  .profile-section {
    padding: 15px 10px;
  }
}

/* Extra small screens */
@media screen and (max-width: 480px) {
  table {
    font-size: 12px;
  }
  
  h3 {
    font-size: 18px;
  }
}
    </style>
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

<!-- Rented House Info -->
<div class="profile-section">
    <?php if (!empty($rentals)): ?>
        <h3>Your Rentals</h3>
        <table>
            <tr>
                <th>Rental ID</th>
                <th>Location</th>
                <th>Rental Type</th>
                <th>Monthly Rent</th>
                <th>Floor</th>
                <th>Bedrooms</th>
                <th>Bathrooms</th>
                <th>Gas Type</th>
            </tr>
            <?php foreach ($rentals as $rental): ?>
            <tr>
                <td><?= htmlspecialchars($rental['id']) ?></td>
                <td><?= htmlspecialchars($rental['location']) ?></td>
                <td><?= htmlspecialchars($rental['rental_type']) ?></td>
                <td><?= htmlspecialchars($rental['monthly_rent']) ?></td>
                <td><?= htmlspecialchars($rental['floor']) ?></td>
                <td><?= htmlspecialchars($rental['bedrooms']) ?></td>
                <td><?= htmlspecialchars($rental['bathrooms']) ?></td>
                <td><?= htmlspecialchars($rental['gas_type']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>You have not listed any rentals.</p>
    <?php endif; ?>
</div>

<!-- Booked info -->
<div class="profile-section">
    <?php if (!empty($bookings)): ?>
        <h3>Bookings for Your Rentals</h3>
        <table>
            <tr>
                <th>Rental ID</th>
                <th>Booker Name</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Booked at</th>


            </tr>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= htmlspecialchars($booking['rental_id']) ?></td>
                <td><?= htmlspecialchars($booking['user_name']) ?></td>
                <td><?= htmlspecialchars($booking['user_phone']) ?></td>
                
                <td>
                <?php if ($booking['status'] == 'Pending'): ?>
        <a href="approve_booking.php?booking_id=<?= $booking['id'] ?>&action=approve" class="btn btn-success">Approve</a>
        <a href="approve_booking.php?booking_id=<?= $booking['id'] ?>&action=reject" class="btn btn-danger">Reject</a>
    <?php elseif ($booking['status'] == 'Approved'): ?>
        <span class="badge bg-success">Confirmed</span>
    <?php elseif ($booking['status'] == 'Rejected'): ?>
        <span class="badge bg-danger">Rejected</span>
    <?php else: ?>
        <span class="badge bg-warning">Unknown</span>
    <?php endif; ?>
</td>

</td>

                <td><?= htmlspecialchars($booking['created_at']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No bookings for your rentals yet.</p>
    <?php endif; ?>
</div>

<!-- Bookings Status -->
<div class="profile-section">
    <?php if ($result->num_rows > 0): ?>
        <h3>Your Bookings</h3>
        <table>
            <tr>
                <th>Rental Type</th>
                <th>Location</th>
                <th>Floor</th>
                <th>Bedrooms</th>
                <th>Bathrooms</th>
                <th>Gas Type</th>
                <th>Monthly Rent</th>
                <th>Booking Date</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['rental_type']) ?></td>
                <td><?= htmlspecialchars($row['location']) ?></td>
                <td><?= htmlspecialchars($row['floor']) ?></td>
                <td><?= htmlspecialchars($row['bedrooms']) ?></td>
                <td><?= htmlspecialchars($row['bathrooms']) ?></td>
                <td><?= htmlspecialchars($row['gas_type']) ?></td>
                <td>৳<?= htmlspecialchars($row['monthly_rent']) ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
                <td>
                    <?php if ($row['status'] == 'Approved'): ?>
                        <span class="badge bg-success">Approved</span>
                    <?php elseif ($row['status'] == 'Pending'): ?>
                        <span class="badge bg-warning text-dark">Pending</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Rejected</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p class="text-center">No bookings found.</p>
    <?php endif; ?>
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