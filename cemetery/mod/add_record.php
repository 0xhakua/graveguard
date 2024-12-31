<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "graveguard";
$conn = new mysqli('localhost', 'root', '', 'graveguard');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deadpp_fname = $_POST['deadpp_fname'];
    $deadpp_lname = $_POST['deadpp_lname'];
    $plot_number = $_POST['plot_number'];
    $brgy_id = $_POST['brgy_id'];
  
    try {
      // Insert into deadpp_tbl
      $stmt1 = $conn->prepare("INSERT INTO deadpp_tbl (deadpp_fname, deadpp_lname, brgy_id) VALUES (?, ?, ?)");
      $stmt1->bind_param("ssi", $deadpp_fname, $deadpp_lname, $brgy_id);
      $stmt1->execute();
      $deadpp_id = $conn->insert_id;
  
      // Insert into plot_tbl
      $stmt2 = $conn->prepare("INSERT INTO plot_tbl (plot_number) VALUES (?)");
      $stmt2->bind_param("s", $plot_number);
      $stmt2->execute();
      $plot_id = $conn->insert_id;
  
      // Insert into grave_tbl
      $stmt3 = $conn->prepare("INSERT INTO grave_tbl (plot_id, deadpp_id, grave_type, grave_buried) VALUES (?, ?, 'Standard', NOW())");
      $stmt3->bind_param("ii", $plot_id, $deadpp_id);
      $stmt3->execute();
  
      echo json_encode(["success" => true]);
    } catch (Exception $e) {
      echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
  }

// Get form data
$deadpp_lname = $_POST['deadpp_lname'];
$deadpp_fname = $_POST['deadpp_fname'];
$deadpp_mname = $_POST['deadpp_mname'];
$deadpp_gender = $_POST['deadpp_gender'];
$deadpp_bdate = $_POST['deadpp_bdate'];
$deadpp_ddate = $_POST['deadpp_ddate'];
$deadpp_rep = $_POST['deadpp_rep'];
$deadpp_conNum = $_POST['deadpp_conNum'];
$brgy_id = $_POST['brgy_id'];

$plot_number = $_POST['plot_number'];
$plot_description = $_POST['plot_description'];

$grave_type = $_POST['grave_type'];
$grave_buried = $_POST['grave_buried'];
$grave_expire = $_POST['grave_expire'];
$grave_fee = $_POST['grave_fee'];

// Insert into plot_tbl (if plot is new)
$sql_plot = "INSERT INTO plot_tbl (plot_number, plot_description) 
             VALUES ('$plot_number', '$plot_description')";
if ($conn->query($sql_plot) === TRUE) {
    $plot_id = $conn->insert_id;

    // Insert into deadpp_tbl
    $sql_deadpp = "INSERT INTO deadpp_tbl (brgy_id, deadpp_lname, deadpp_fname, deadpp_mname, deadpp_gender, deadpp_bdate, deadpp_ddate, deadpp_rep, deadpp_conNum) 
                   VALUES ('$brgy_id', '$deadpp_lname', '$deadpp_fname', '$deadpp_mname', '$deadpp_gender', '$deadpp_bdate', '$deadpp_ddate', '$deadpp_rep', '$deadpp_conNum')";
    if ($conn->query($sql_deadpp) === TRUE) {
        $deadpp_id = $conn->insert_id;

        // Insert into grave_tbl
        $sql_grave = "INSERT INTO grave_tbl (plot_id, deadpp_id, grave_buried, grave_xpire, grave_fee, grave_type) 
                      VALUES ('$plot_id', '$deadpp_id', '$grave_buried', '$grave_expire', '$grave_fee', '$grave_type')";
        if ($conn->query($sql_grave) === TRUE) {
            echo "Record added successfully!";
        } else {
            echo "Error: " . $sql_grave . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_deadpp . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql_plot . "<br>" . $conn->error;
}

$conn->close();
?>
