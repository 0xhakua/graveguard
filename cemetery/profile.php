<?php
session_start();
require 'db_connect.php'; // Database connection

// Initialize variables for user data
$userId = $username = $email = '';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  try {
    // Query to fetch user details based on the session user ID
    $stmt = $conn->prepare("SELECT account_id, account_uname, account_email FROM account_tbl WHERE account_id = :userId");
    $stmt->bindParam(':userId', $_SESSION['user_id']);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user exists, set the variables
    if ($user) {
      $userId = $user['account_id'];
      $username = $user['account_uname'];
      $email = $user['account_email'];
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    GraveGuard
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="css/nucleo-icons.css" rel="stylesheet" />
  <link href="css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="css/dashboard.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="dashboard.php" target="_blank">
        <img src="img/icon.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">GraveGuard</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Table pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="deceased-tbl.php">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Deceased Records</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="graveplot-tbl.php">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Barangay Records</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="account-tbl.php">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Account Records</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="profile.php">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="logout.php">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Sign Out</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tables</li>
          </ol>
        </nav>

        <!-- <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div> -->

          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>

        </div>
    </nav>

    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('img/background.jpg');">
      </div>

      <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="img/pp2.jpg" alt="Profile image of Richard Davis" class="w-100 border-radius-lg shadow-sm">
            </div>
            
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1"><?= htmlspecialchars($username) ?></h5>
              <p class="mb-0 font-weight-normal text-sm">GraveGuard</p>
            </div>
          </div>
        </div> <!-- Close row -->

    


  <div class="col-12 col-xl-4">
    <div class="card card-plain h-100">
      <div class="card-header pb-0 p-3">
        <div class="row">
          <div class="col-md-8 d-flex align-items-center">
            <h6 class="mb-0">Profile Information</h6>
          </div>
          <div class="col-md-4 text-end">
            <button class="btn btn-link p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile">
              <i class="fas fa-user-edit text-secondary text-sm"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="card-body p-3">
  <ul class="list-group">
    <li class="list-group-item border-0 ps-0 text-sm">
      <strong class="text-dark">Email:</strong> 
      <span class="text-dark">&nbsp;<?= htmlspecialchars($email) ?></span>
    </li>
    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
      <strong class="text-dark">Username:</strong> 
      <span class="text-dark">&nbsp;<?= htmlspecialchars($username) ?></span>
    </li>
    <li class="list-group-item border-0 ps-0 text-sm">
      <strong class="text-dark">User ID:</strong> 
      <span class="text-dark">&nbsp;<?= htmlspecialchars($userId) ?></span>
    </li>
  </ul>
</div>

    </div>
  </div>
</div>




  <!--   Core JS Files   -->
  <script src="js/core/popper.min.js"></script>
  <script src="js/core/bootstrap.min.js"></script>
  <script src="js/plugins/perfect-scrollbar.min.js"></script>
  <script src="js/plugins/smooth-scrollbar.min.js"></script>
  <script src="js/plugins/chartjs.min.js"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>