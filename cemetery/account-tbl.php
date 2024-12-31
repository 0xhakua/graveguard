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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
          <a class="nav-link active bg-gradient-dark text-white href=" account-tbl.php">
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
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'graveguard');

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            // Default SQL query
            $sql = "SELECT account_id, account_uname, account_email, account_pword FROM account_tbl";

            // Search functionality
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search']) && !empty($_POST['search'])) {
              $search = $conn->real_escape_string($_POST['search']);
              $search = "%" . $search . "%";
              $stmt = $conn->prepare("SELECT account_id, account_uname, account_email, account_pword FROM account_tbl WHERE account_id LIKE ? OR account_uname LIKE ? OR account_email LIKE ?");
              $stmt->bind_param("sss", $search, $search, $search);
              $stmt->execute();
              $result = $stmt->get_result();
            } else {
              $result = $conn->query($sql);
            }
            ?>

            <!-- Search Form -->
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <form method="POST" action="" class="d-flex align-items-center w-100">
                <div class="input-group input-group-outline">
                  <label class="form-label">Type here...</label>
                  <input type="text" name="search" id="search-input" class="form-control">
                </div>

                <button class="btn btn-primary" type="submit" style="margin-right: 1rem; margin-top: 1rem; background-color: #12A251; padding-right: 1.3rem">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>

                <button class="btn" type="button" id="clear-search" style="background-color: #e74a3b; color: white; margin-top: 1rem; padding-right: 2rem">
                  Clear
                </button>

              </form>
            </div>



            <!-- Humburger Menu -->
            <ul class="navbar-nav d-flex align-items-center  justify-content-end">

              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container mt-4">
      <?php
      if (isset($_GET['status'])) {
        $statusMessage = '';
        $statusType = '';

        if ($_GET['status'] === 'edited') {
          $statusMessage = 'Account successfully edited.';
          $statusType = 'alert-success';
        } elseif ($_GET['status'] === 'deleted') {
          $statusMessage = 'Account successfully deleted.';
          $statusType = 'alert-danger';
        } elseif ($_GET['status'] === 'error') {
          $statusMessage = 'An error occurred. Please try again.';
          $statusType = 'alert-warning';
        }

        if (!empty($statusMessage)) {
          echo "<div id='notification' class='alert $statusType alert-dismissible fade show' role='alert'>
                    $statusMessage
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }

        if (isset($_GET['status']) && $_GET['status'] == 'added') {
          echo "<div id='notification' class='alert alert-success'>Account added successfully!</div>";
        }
      }
      ?>
    </div>


    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">Account Table</h6>

                <!-- <button id="exportPdf" class="btn btn-sm" style="background-color: #12A251; color: white; margin-left: 74rem;">Export to PDF</button> -->

                <button class="btn btn-sm" style="background-color: #12A251; color: white; margin-right: 1rem;" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                  Add Account
                </button>
              </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <!-- PASTE THE NOTEPAD HERE-->

                <!-- PASTE THE NOTEPAD HERE-->


                <!-- DELETE THIS IF WRONG -->
                <!-- Results Table -->
                <table id="account_list" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Account ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Username</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                      <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Password</th> -->
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td class='align-middle'>{$row['account_id']}</td>
                        <td class='align-middle'>{$row['account_uname']}</td>
                        <td class='align-middle'>{$row['account_email']}</td>

                        
                        
                        <td class='align-middle'>
                            <button class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#editModal' onclick='populateEditModal({$row['account_id']}, \"{$row['account_uname']}\", \"{$row['account_email']}\", \"{$row['account_pword']}\")'>Edit</button>
                            <button class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal' onclick='populateDeleteModal({$row['account_id']})'>Delete</button>
                        </td>
                      </tr>";
                      }
                    } else {
                      echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                    }

                    $conn->close();
                    ?>
                  </tbody>
                </table>
                <!-- DELETE THIS IF WRONG -->

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    </div>
    </div>



    <!-- Add Account Modal -->
    <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addAccountModalLabel">Add Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="mod/add_account.php" method="POST">
            <div class="modal-body">
              <div class="mb-3">
                <label for="add_username" class="form-label">Username</label>
                <input type="text" class="form-control" id="add_username" name="account_uname" style="background-color: #f4f4f4;" required>
              </div>
              <div class="mb-3">
                <label for="add_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="add_email" name="account_email" style="background-color: #f4f4f4;" required>
              </div>
              <div class="mb-3">
                <label for="add_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="add_password" name="account_pword" style="background-color: #f4f4f4;" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Account</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php
    if (isset($_GET['status'])) {
      if ($_GET['status'] == 'duplicate') {
        echo "<div class='alert alert-danger' id='notification'>Username or email already exists!</div>";
      } elseif ($_GET['status'] == 'error') {
        echo "<div class='alert alert-danger' id='notification'>An error occurred. Please try again.</div>";
      }
    }
    ?>





    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="mod/edit_account.php" method="POST">
            <div class="modal-body">
              <input type="hidden" id="edit_account_id" name="account_id">
              <div class="mb-3">
                <label for="edit_username" class="form-label">Username</label>
                <input type="text" class="form-control" id="edit_username" name="account_uname" style="background-color: #f4f4f4;" required>
              </div>
              <div class="mb-3">
                <label for="edit_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="edit_email" name="account_email" style="background-color: #f4f4f4;" required>
              </div>
              <div class="mb-3">
                <label for="edit_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="edit_password" name="account_pword" style="background-color: #f4f4f4;" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>



    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="mod/delete_account.php" method="POST">
            <div class="modal-body">
              <input type="hidden" id="delete_account_id" name="account_id">
              <p>Are you sure you want to delete this account?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </main>


  <script>
    document.getElementById('addAccountModal').addEventListener('submit', function(event) {
      const password = document.getElementById('add_password').value;
      if (password.length < 5) {
        alert('Password must be at least 5 characters long.');
        event.preventDefault();
      }
    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const notification = document.getElementById('notification');
      if (notification) {
        setTimeout(() => {
          notification.classList.remove('show'); // Removes the "show" class
          notification.classList.add('fade'); // Adds a fade-out animation

          // Optional: Remove the notification from DOM entirely
          setTimeout(() => notification.remove(), 500); // Wait for fade-out animation to complete
        }, 5000);
      }
    });
  </script>

  <script>
    // Populate Edit Modal with selected account data
    function populateEditModal(id, username, email, password) {
      document.getElementById('edit_account_id').value = id;
      document.getElementById('edit_username').value = username;
      document.getElementById('edit_email').value = email;
      document.getElementById('edit_password').value = password;
    }
    // Populate Delete Modal with selected account ID
    function populateDeleteModal(id) {
      document.getElementById('delete_account_id').value = id;
    }
  </script>

  <!-- JavaScript for Clear Button -->
  <script>
    document.getElementById('clear-search').addEventListener('click', function() {
      document.getElementById('search-input').value = '';
      document.forms[0].submit();
    });
  </script>

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
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>