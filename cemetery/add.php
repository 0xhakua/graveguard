<?php
$host = "localhost";
$dbname = "graveguard";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
include 'db_connect.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Deceased</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <style>
    form {
      margin-top: 30%;
    }
  </style>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="addDeceasedForm" method="POST" action="add_deceased.php">
        <div class="modal-header">
          <h5 class="modal-title" id="addDeceasedLabel">Add Deceased</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.href='dashboard.php';"></button>

        </div>
        <div class="modal-body">
          <!-- Section: Personal Information -->
          <h5>Personal Information</h5>
          <div class="row">
            <div class="col-md-4">
              <label for="deadpp_fname" class="form-label">First Name</label>
              <input type="text" class="form-control" id="deadpp_fname" name="deadpp_fname" required>
            </div>
            <div class="col-md-4">
              <label for="deadpp_mname" class="form-label">Middle Name</label>
              <input type="text" class="form-control" id="deadpp_mname" name="deadpp_mname">
            </div>
            <div class="col-md-4">
              <label for="deadpp_lname" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="deadpp_lname" name="deadpp_lname" required>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-4">
              <label for="deadpp_gender" class="form-label">Gender</label>
              <select class="form-select" id="deadpp_gender" name="deadpp_gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="deadpp_bdate" class="form-label">Birth Date</label>
              <input type="date" class="form-control" id="deadpp_bdate" name="deadpp_bdate" required>
            </div>
            <div class="col-md-4">
              <label for="deadpp_ddate" class="form-label">Death Date</label>
              <input type="date" class="form-control" id="deadpp_ddate" name="deadpp_ddate" required>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-6">
              <label for="deadpp_rep" class="form-label">Representative</label>
              <input type="text" class="form-control" id="deadpp_rep" name="deadpp_rep">
            </div>
            <div class="col-md-6">
              <label for="deadpp_conNum" class="form-label">Contact Number</label>
              <input type="text" class="form-control" id="deadpp_conNum" name="deadpp_conNum">
            </div>
          </div>

          <!-- Section: Grave Details -->
          <h5 class="mt-4">Grave Details</h5>
          <div class="row">
            <div class="col-md-6">
              <label for="plot_id" class="form-label">Plot Number</label>
              <select class="form-select" id="plot_id" name="plot_id" required>
                <option value="">Select Plot</option>
                <?php
                $query = "SELECT plot_id, plot_number FROM plot_tbl";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='{$row['plot_id']}'>{$row['plot_number']}</option>";
                }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="grave_fee" class="form-label">Grave Fee</label>
              <input type="number" step="0.01" class="form-control" id="grave_fee" name="grave_fee">
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-6">
              <label for="grave_type" class="form-label">Grave Type</label>
              <input type="text" class="form-control" id="grave_type" name="grave_type">
            </div>
            <div class="col-md-6">
              <label for="grave_expire" class="form-label">Expiration Date</label>
              <input type="date" class="form-control" id="grave_expire" name="grave_expire">
            </div>
          </div>

          <!-- Section: Barangay -->
          <h5 class="mt-4">Barangay</h5>
          <div class="row">
            <div class="col-md-6">
              <label for="brgy_id" class="form-label">Barangay</label>
              <select class="form-select" id="brgy_id" name="brgy_id" required>
                <option value="">Select Barangay</option>
                <?php
                $query = "SELECT brgy_id, brgy_name FROM brgy_tbl";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='{$row['brgy_id']}'>{$row['brgy_name']}</option>";
                }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="plot_description" class="form-label">Plot Description</label>
              <input type="text" class="form-control" id="plot_description" name="plot_description" readonly>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
