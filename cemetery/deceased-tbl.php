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
          <a class="nav-link active bg-gradient-dark text-white href=" deceased-tbl.php">
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
          <a class="nav-link text-dark" href=" account-tbl.php">
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



          <?php
          // Database connection
          $conn = new mysqli('localhost', 'root', '', 'graveguard');

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Default SQL query
          $sql = "
SELECT 
    g.grave_id, 
    g.grave_type, 
    p.plot_number, 
    p.plot_description, 
    CONCAT(d.deadpp_fname, ' ', d.deadpp_mname, ' ', d.deadpp_lname) AS deceased_name, 
    d.deadpp_gender AS gender, 
    d.deadpp_bdate AS birth_date, 
    d.deadpp_ddate AS death_date, 
    d.deadpp_rep AS representative, 
    d.deadpp_conNum AS contact_number, 
    b.brgy_name AS barangay, 
    g.grave_burried AS date_buried, 
    g.grave_xpire AS grave_expiry, 
    g.grave_fee AS grave_fee
FROM grave_tbl g
LEFT JOIN plot_tbl p ON g.plot_id = p.plot_id
LEFT JOIN deadpp_tbl d ON g.deadpp_id = d.deadpp_id
LEFT JOIN brgy_tbl b ON d.brgy_id = b.brgy_id";

          // Search functionality
          if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search']) && !empty($_POST['search'])) {
            $search = $conn->real_escape_string($_POST['search']);
            $search = "%" . $search . "%";

            $sql = "
    SELECT 
        g.grave_id, 
        g.grave_type, 
        p.plot_number, 
        p.plot_description, 
        CONCAT(d.deadpp_fname, ' ', d.deadpp_mname, ' ', d.deadpp_lname) AS deceased_name, 
        d.deadpp_gender AS gender, 
        d.deadpp_bdate AS birth_date, 
        d.deadpp_ddate AS death_date, 
        d.deadpp_rep AS representative, 
        d.deadpp_conNum AS contact_number, 
        b.brgy_name AS barangay, 
        g.grave_burried AS date_buried, 
        g.grave_xpire AS grave_expiry, 
        g.grave_fee AS grave_fee
    FROM grave_tbl g
    LEFT JOIN plot_tbl p ON g.plot_id = p.plot_id
    LEFT JOIN deadpp_tbl d ON g.deadpp_id = d.deadpp_id
    LEFT JOIN brgy_tbl b ON d.brgy_id = b.brgy_id
    WHERE 
        g.grave_id LIKE ? OR 
        g.grave_type LIKE ? OR 
        p.plot_number LIKE ? OR 
        p.plot_description LIKE ? OR 
        CONCAT(d.deadpp_fname, ' ', d.deadpp_mname, ' ', d.deadpp_lname) LIKE ? OR
        d.deadpp_gender LIKE ? OR 
        d.deadpp_bdate LIKE ? OR 
        d.deadpp_ddate LIKE ? OR 
        d.deadpp_rep LIKE ? OR 
        d.deadpp_conNum LIKE ? OR
        b.brgy_name LIKE ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
              "sssssssssss",
              $search,
              $search,
              $search,
              $search,
              $search,
              $search,
              $search,
              $search,
              $search,
              $search,
              $search
            );
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
                <h6 class="text-white text-capitalize ps-3">Deceased Table</h6>
                <button id="exportPdf" class="btn btn-sm" style="background-color: #12A251; color: white;  margin-right: 1rem;">Export to PDF</button>

                <button class="btn btn-sm" style="background-color: #12A251; color: white; margin-right: 1rem;" data-bs-toggle="modal" data-bs-target="#addModal">
                  Add Deceased
                </button>

              </div>
            </div>

            <!-- DELETE THIS IF WRONG -->

            <div class="card-body px-0 pb-2">

              <div class="table-responsive p-0">
                <table id="combined_list" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>Grave ID</th>
                      <th>Grave Type</th>
                      <th>Plot Number</th>
                      <th>Plot Description</th>
                      <th>Deceased Name</th>
                      <th>Gender</th>
                      <th>Birth Date</th>
                      <th>Death Date</th>
                      <th>Representative</th>
                      <th>Contact Number</th>
                      <th>Barangay</th>
                      <th>Date Buried</th>
                      <th>Grave Expiry</th>
                      <th>Grave Fee</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo "
                <tr>
                    <td>{$row['grave_id']}</td>
                    <td>{$row['grave_type']}</td>
                    <td>{$row['plot_number']}</td>
                    <td>{$row['plot_description']}</td>
                    <td>{$row['deceased_name']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['birth_date']}</td>
                    <td>{$row['death_date']}</td>
                    <td>{$row['representative']}</td>
                    <td>{$row['contact_number']}</td>
                    <td>{$row['barangay']}</td>
                    <td>{$row['date_buried']}</td>
                    <td>{$row['grave_expiry']}</td>
                    <td>{$row['grave_fee']}</td>
                    <td>
                        <button 
                            class='btn btn-sm btn-primary' 
                            data-bs-toggle='modal' 
                            data-bs-target='#editModal' 
                            onclick='populateEditModal({
                                grave_id: \"{$row['grave_id']}\",
                                grave_type: \"{$row['grave_type']}\",
                                plot_number: \"{$row['plot_number']}\",
                                plot_description: \"{$row['plot_description']}\",
                                deceased_fname: \"{$row['deceased_name']}\",
                                gender: \"{$row['gender']}\",
                                birth_date: \"{$row['birth_date']}\",
                                death_date: \"{$row['death_date']}\",
                                representative: \"{$row['representative']}\",
                                contact_number: \"{$row['contact_number']}\",
                                barangay: \"{$row['barangay']}\",
                                date_buried: \"{$row['date_buried']}\",
                                grave_expiry: \"{$row['grave_expiry']}\",
                                grave_fee: \"{$row['grave_fee']}\"
                            })'>Edit</button>
                        <button 
                            class='btn btn-sm btn-danger' 
                            data-bs-toggle='modal' 
                            data-bs-target='#deleteModal' 
                            onclick='populateDeleteModal({$row['grave_id']})'>Delete</button>
                    </td>
                </tr>";
                      }
                    } else {
                      echo "<tr><td colspan='15' class='text-center'>No records found</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>




              <!-- Add Data Modal -->
              <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h5 class="modal-title" id="addModalLabel">Add New Record</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Form -->
                    <form method="POST" action="add_data.php">
                      <div class="modal-body">
                        <div class="container-fluid">
                          <div class="row g-3">
                            <!-- Plot Information -->
                            <div class="col-md-6">
                              <label for="plot_number" class="form-label">Plot Number</label>
                              <input type="text" name="plot_number" id="plot_number" class="form-control dark-input" required>
                            </div>
                            <div class="col-md-6">
                              <label for="plot_description" class="form-label">Plot Location</label>
                              <select name="plot_description" id="plot_description" class="form-select dark-input" required>
                                <option value="">-- Select Plot Location --</option>
                                <option value="Near the main gate of the cemetery">Near the main gate of the cemetery</option>
                                <option value="Near the center pathway">Near the center pathway</option>
                                <option value="Adjacent to the chapel">Adjacent to the chapel</option>
                                <option value="On the east side of the cemetery">On the east side of the cemetery</option>
                                <option value="On the west side of the cemetery">On the west side of the cemetery</option>
                                <option value="Under the large oak tree">Under the large oak tree</option>
                                <option value="Near the memorial garden">Near the memorial garden</option>
                                <option value="In the quiet corner">In the quiet corner (far end of the cemetery)</option>
                              </select>
                            </div>

                            <!-- Deceased Information -->
                            <div class="col-md-4">
                              <label for="deceased_fname" class="form-label">First Name</label>
                              <input type="text" name="deceased_fname" id="deceased_fname" class="form-control dark-input" required>
                            </div>
                            <div class="col-md-4">
                              <label for="deceased_mname" class="form-label">Middle Name</label>
                              <input type="text" name="deceased_mname" id="deceased_mname" class="form-control dark-input">
                            </div>
                            <div class="col-md-4">
                              <label for="deceased_lname" class="form-label">Last Name</label>
                              <input type="text" name="deceased_lname" id="deceased_lname" class="form-control dark-input" required>
                            </div>
                            <div class="col-md-6">
                              <label for="gender" class="form-label">Gender</label>
                              <select name="gender" id="gender" class="form-select dark-input" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label for="birth_date" class="form-label">Birth Date</label>
                              <input type="date" name="birth_date" id="birth_date" class="form-control dark-input" required>
                            </div>
                            <div class="col-md-6">
                              <label for="death_date" class="form-label">Death Date</label>
                              <input type="date" name="death_date" id="death_date" class="form-control dark-input" required>
                            </div>
                            <div class="col-md-6">
                              <label for="representative" class="form-label">Representative</label>
                              <input type="text" name="representative" id="representative" class="form-control dark-input">
                            </div>
                            <div class="col-md-6">
                              <label for="contact_number" class="form-label">Contact Number</label>
                              <input type="text" name="contact_number" id="contact_number" class="form-control dark-input">
                            </div>

                            <!-- Barangay Information -->
                            <div class="col-md-6">
                              <label for="barangay_id" class="form-label">Barangay</label>
                              <select name="barangay_id" id="barangay_id" class="form-select dark-input" required>
                                <?php
                                $conn = new mysqli('localhost', 'root', '', 'graveguard');
                                $result = $conn->query("SELECT brgy_id, brgy_name FROM brgy_tbl");
                                while ($row = $result->fetch_assoc()) {
                                  echo "<option value='{$row['brgy_id']}'>{$row['brgy_name']}</option>";
                                }
                                $conn->close();
                                ?>
                              </select>
                            </div>

                            <!-- Grave Information -->
                            <div class="col-md-6">
                              <label for="grave_type" class="form-label">Grave Type</label>
                              <select name="grave_type" id="grave_type" class="form-select dark-input" required>
                                <option value="">-- Select Grave Type --</option>
                                <option value="Lawn Grave">Lawn Grave</option>
                                <option value="Monument Grave">Monument Grave</option>
                                <option value="Mausoleum">Mausoleum</option>
                                <option value="Vault">Vault</option>
                                <option value="Columbarium">Columbarium</option>
                                <option value="Natural Burial">Natural Burial</option>
                                <option value="Cremation Plot">Cremation Plot</option>
                                <option value="Infant/Child Grave">Infant/Child Grave</option>
                                <option value="Family Plot">Family Plot</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label for="date_buried" class="form-label">Date Buried</label>
                              <input type="date" name="date_buried" id="date_buried" class="form-control dark-input" required>
                            </div>
                            <div class="col-md-6">
                              <label for="grave_expiry" class="form-label">Grave Expiry</label>
                              <input type="date" name="grave_expiry" id="grave_expiry" class="form-control dark-input" required>
                            </div>
                            <div class="col-md-6">
                              <label for="grave_fee" class="form-label">Grave Fee</label>
                              <input type="number" name="grave_fee" id="grave_fee" class="form-control dark-input" required>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm" style="background-color: #12A251; color: white;">Add Record</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Custom CSS for Dark Inputs -->
              <style>
                .dark-input {
                  background-color: #f4f4f4;
                }

                .dark-input::placeholder {
                  color: #adb5bd;
                }

                .dark-input:focus {
                  background-color: #f4f4f4;
                }
              </style>







              <!-- Edit Record Modal -->
              <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="mod/edit_record.php" method="POST">
                      <div class="modal-body">
                        <input type="hidden" id="edit_record_id" name="record_id">

                        <!-- Plot Information -->
                        <div class="mb-3">
                          <label for="edit_plot_number" class="form-label">Plot Number:</label>
                          <input type="text" class="form-control dark-input" id="edit_plot_number" name="plot_number" required>
                        </div>
                        <div class="mb-3">
                          <label for="edit_plot_description" class="form-label">Plot Location:</label>
                          <select class="form-select dark-input" id="edit_plot_description" name="plot_description" required>
                            <option value="">-- Select Plot Location --</option>
                            <option value="Near the main gate of the cemetery">Near the main gate of the cemetery</option>
                            <option value="Near the center pathway">Near the center pathway</option>
                            <option value="Adjacent to the chapel">Adjacent to the chapel</option>
                            <option value="On the east side of the cemetery">On the east side of the cemetery</option>
                            <option value="On the west side of the cemetery">On the west side of the cemetery</option>
                            <option value="Under the large oak tree">Under the large oak tree</option>
                            <option value="Near the memorial garden">Near the memorial garden</option>
                            <option value="In the quiet corner">In the quiet corner (far end of the cemetery)</option>
                          </select>
                        </div>

                        <!-- Deceased Information -->
                        <div class="mb-3">
                          <label for="edit_deceased_fname" class="form-label">Deceased First Name:</label>
                          <input type="text" class="form-control dark-input" id="edit_deceased_fname" name="deceased_fname" required>
                        </div>
                        <div class="mb-3">
                          <label for="edit_deceased_mname" class="form-label">Deceased Middle Name:</label>
                          <input type="text" class="form-control dark-input" id="edit_deceased_mname" name="deceased_mname">
                        </div>
                        <div class="mb-3">
                          <label for="edit_deceased_lname" class="form-label">Deceased Last Name:</label>
                          <input type="text" class="form-control dark-input" id="edit_deceased_lname" name="deceased_lname" required>
                        </div>
                        <div class="mb-3">
                          <label for="edit_gender" class="form-label ">Gender:</label>
                          <select class="form-select dark-input" id="edit_gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="edit_birth_date" class="form-label">Birth Date:</label>
                          <input type="date" class="form-control dark-input" id="edit_birth_date" name="birth_date" required>
                        </div>
                        <div class="mb-3">
                          <label for="edit_death_date" class="form-label">Death Date:</label>
                          <input type="date" class="form-control dark-input" id="edit_death_date" name="death_date" required>
                        </div>
                        <div class="mb-3">
                          <label for="edit_representative" class="form-label">Representative:</label>
                          <input type="text" class="form-control dark-input" id="edit_representative" name="representative">
                        </div>
                        <div class="mb-3">
                          <label for="edit_contact_number" class="form-label">Contact Number:</label>
                          <input type="text" class="form-control dark-input" id="edit_contact_number" name="contact_number">
                        </div>

                        <!-- Barangay Information -->
                        <div class="mb-3">
                          <label for="edit_barangay_id" class="form-label">Barangay:</label>
                          <select class="form-select dark-input" id="edit_barangay_id" name="barangay_id" required>
                            <?php
                            // Populate barangays dynamically
                            $conn = new mysqli('localhost', 'root', '', 'graveguard');
                            $result = $conn->query("SELECT brgy_id, brgy_name FROM brgy_tbl");
                            while ($row = $result->fetch_assoc()) {
                              echo "<option value='{$row['brgy_id']}'>{$row['brgy_name']}</option>";
                            }
                            $conn->close();
                            ?>
                          </select>
                        </div>

                        <!-- Grave Information -->
                        <div class="mb-3">
                          <label for="edit_grave_type" class="form-label">Grave Type:</label>
                          <select class="form-select dark-input" id="edit_grave_type" name="grave_type" required>
                            <option value="">-- Select Grave Type --</option>
                            <option value="Lawn Grave">Lawn Grave</option>
                            <option value="Monument Grave">Monument Grave</option>
                            <option value="Mausoleum">Mausoleum</option>
                            <option value="Vault">Vault</option>
                            <option value="Columbarium">Columbarium</option>
                            <option value="Natural Burial">Natural Burial</option>
                            <option value="Cremation Plot">Cremation Plot</option>
                            <option value="Infant/Child Grave">Infant/Child Grave</option>
                            <option value="Family Plot">Family Plot</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="edit_date_buried" class="form-label ">Date Buried:</label>
                          <input type="date" class="form-control dark-input" id="edit_date_buried" name="date_buried" required>
                        </div>
                        <div class="mb-3">
                          <label for="edit_grave_expiry" class="form-label ">Grave Expiry:</label>
                          <input type="date" class="form-control dark-input" id="edit_grave_expiry" name="grave_expiry" required>
                        </div>
                        <div class="mb-3">
                          <label for="edit_grave_fee" class="form-label ">Grave Fee:</label>
                          <input type="number" class="form-control dark-input" id="edit_grave_fee" name="grave_fee" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm" style="background-color: #12A251; color: white;">Save Changes</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>






              <!-- Delete Modal -->
              <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="mod/delete_deceased.php" method="POST">
                      <div class="modal-header">
                        <h5 class="modal-title">Delete Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" id="delete_record_id" name="deadpp_id">
                        <p>Are you sure you want to delete this record?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>


  </main>\

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

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
    document.getElementById('clear-search').addEventListener('click', () => {
      window.location.href = window.location.pathname; // Reloads the page
    });
  </script>


  <script>
    document.getElementById('exportPdf').addEventListener('click', function() {
      const {
        jsPDF
      } = window.jspdf;
      const doc = new jsPDF({
        orientation: 'landscape'
      });

      doc.autoTable({
        html: '#combined_list',
        startY: 10,
        didParseCell: function(data) {
          if (data.column.index === 11) {
            data.cell.styles.cellWidth = 0;
            data.cell.text = '';
          }
        },
      });

      doc.save('table.pdf'); // Save the file
    });
  </script>




  <script>
    function populateEditModal(data) {
      // Populate each field in the modal with the selected row's data
      document.getElementById('edit_record_id').value = data.grave_id;
      document.getElementById('edit_plot_number').value = data.plot_number;
      document.getElementById('edit_plot_description').value = data.plot_description;
      document.getElementById('edit_deceased_fname').value = data.deceased_fname.split(' ')[0]; // First Name
      document.getElementById('edit_deceased_mname').value = data.deceased_fname.split(' ')[1] || ''; // Middle Name
      document.getElementById('edit_deceased_lname').value = data.deceased_fname.split(' ')[2] || ''; // Last Name
      document.getElementById('edit_gender').value = data.gender;
      document.getElementById('edit_birth_date').value = data.birth_date;
      document.getElementById('edit_death_date').value = data.death_date;
      document.getElementById('edit_representative').value = data.representative;
      document.getElementById('edit_contact_number').value = data.contact_number;
      document.getElementById('edit_barangay_id').value = data.barangay;
      document.getElementById('edit_grave_type').value = data.grave_type;
      document.getElementById('edit_date_buried').value = data.date_buried;
      document.getElementById('edit_grave_expiry').value = data.grave_expiry;
      document.getElementById('edit_grave_fee').value = data.grave_fee;
    }
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



  <script>
    function populateDeleteModal(grave_id) {
      // Assign the grave_id to the hidden input field in the delete modal
      document.getElementById('delete_record_id').value = grave_id;
    }
  </script>



  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>