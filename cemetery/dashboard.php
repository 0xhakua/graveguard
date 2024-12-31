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
  <!-- Bootstrap CSS -->

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
          <a class="nav-link active bg-gradient-dark text-white" href="dashboard.php">
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
          <a class="nav-link text-dark" href="profile.php">
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
    <div class="container-fluid py-2">

      <div class="row">
        <div class="ms-3">
          <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
          <p class="mb-4">
            Tracking the data of the deceased ones.
          </p>
          <!-- <button type="button" class="btn btn-primary" onclick="window.location.href='add.php';">
            Add Deceased
          </button> -->

        </div>





        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'graveguard');

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Fetch total grave sales
        $queryGraveSales = "SELECT SUM(grave_fee) AS total_grave_sales FROM grave_tbl";
        $resultGraveSales = $conn->query($queryGraveSales);

        $totalGraveSales = 0;
        if ($resultGraveSales && $row = $resultGraveSales->fetch_assoc()) {
          $totalGraveSales = $row['total_grave_sales'] ?: 0;
        }
        ?>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Total GraveGuards</p>
                  <h4 class="mb-0">
                    <?php
                    $query = "SELECT COUNT(*) AS total_users FROM account_tbl"; // Replace 'users_tbl' with your actual users table name
                    $result = $conn->query($query);

                    if ($result && $row = $result->fetch_assoc()) {
                      echo $row['total_users']; // Display total number of users
                    } else {
                      echo "0"; // Fallback in case of no users
                    }

                    $conn->close();
                    ?>
                  </h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">group</i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm">Number of graveguards</p>
            </div>
          </div>
        </div>


        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Total Deceased</p>
                  <h4 class="mb-0">
                    <?php
                    // Database connection
                    $conn = new mysqli('localhost', 'root', '', 'graveguard');

                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to count all deceased
                    $query = "SELECT COUNT(*) AS total_deceased FROM grave_tbl"; // Replace 'deadpp_tbl' with your deceased table name
                    $result = $conn->query($query);

                    if ($result && $row = $result->fetch_assoc()) {
                      echo $row['total_deceased']; // Display total number of deceased
                    } else {
                      echo "0"; // Fallback in case of no records
                    }

                    $conn->close();
                    ?>
                  </h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">person_off</i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm">Tracking total numbers of the deceased</p>
            </div>
          </div>
        </div>



        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Total Barangays</p>
                  <h4 class="mb-0">
                    <?php
                    // Database connection
                    $conn = new mysqli('localhost', 'root', '', 'graveguard');

                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to count all graves
                    $query = "SELECT COUNT(*) AS total_brgy FROM brgy_tbl"; // Replace 'grave_tbl' with your grave table name
                    $result = $conn->query($query);

                    if ($result && $row = $result->fetch_assoc()) {
                      echo $row['total_brgy']; // Display total number of graves
                    } else {
                      echo "0"; // Fallback in case of no records
                    }

                    $conn->close();
                    ?>
                  </h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">weekend</i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm">Total barangay included</p>
            </div>
          </div>
        </div>



        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Grave Fees</p>
                  <h4 class="mb-0">₱<?php echo number_format($totalGraveSales, 2); ?></h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">weekend</i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm">Total grave fees</p>
            </div>
          </div>
        </div>



        <div class="col-lg-12 mt-4 mb-3"> 
  <div class="card w-100">
    <div class="card-body">
      <h6 class="mb-0">Cemetery satellite view</h6>
      <div class="d-flex">
        <i class="material-symbols-rounded text-sm my-auto me-1">place</i>
        <p class="mb-0 text-sm">Barili Public/Private Cemetery</p>
      </div>
      <hr class="dark horizontal">
      <div class="image-container">
        <img src="img/location2.png" alt="Cemetery Satellite View" class="img-fluid" style="width: 100%; height: auto; border-radius: 0.5rem; object-fit: cover;">
      </div>
    </div>
  </div>
</div>


          </div>
        </div>
      </div>

      <!-- Add Deceased Modal -->
      <div class="modal fade" id="addDeceasedModal" tabindex="-1" aria-labelledby="addDeceasedLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <form action="add_record.php" method="POST">
              <h3>Deceased Information</h3>
              <label>Last Name:</label>
              <input type="text" name="deadpp_lname" required>
              <label>First Name:</label>
              <input type="text" name="deadpp_fname" required>
              <label>Middle Name:</label>
              <input type="text" name="deadpp_mname">
              <label>Gender:</label>
              <select name="deadpp_gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <label>Birth Date:</label>
              <input type="date" name="deadpp_bdate" required>
              <label>Death Date:</label>
              <input type="date" name="deadpp_ddate" required>
              <label>Representative:</label>
              <input type="text" name="deadpp_rep" required>
              <label>Contact Number:</label>
              <input type="text" name="deadpp_conNum" required>
              <label>Barangay:</label>
              <select name="brgy_id" required>
                <!-- Populate dynamically with PHP -->
                <option value="1">Barangay Uno</option>
                <option value="2">Barangay Dos</option>
              </select>

              <h3>Plot Information</h3>
              <label>Plot Number:</label>
              <input type="text" name="plot_number" required>
              <label>Plot Description:</label>
              <input type="text" name="plot_description">

              <h3>Grave Information</h3>
              <label>Grave Type:</label>
              <input type="text" name="grave_type" required>
              <label>Date Buried:</label>
              <input type="date" name="grave_buried" required>
              <label>Grave Expiry:</label>
              <input type="date" name="grave_expire" required>
              <label>Grave Fee:</label>
              <input type="number" step="0.01" name="grave_fee" required>

              <button type="submit">Submit</button>
            </form>



          </div>
        </div>
      </div>

  </main>

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