<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'graveguard');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data
$brgy_id = $_POST['brgy_id'];
$deadpp_lname = $_POST['deadpp_lname'];
$deadpp_fname = $_POST['deadpp_fname'];
$deadpp_mname = $_POST['deadpp_mname'];
$deadpp_gender = $_POST['deadpp_gender'];
$deadpp_bdate = $_POST['deadpp_bdate'];
$deadpp_ddate = $_POST['deadpp_ddate'];
$deadpp_rep = $_POST['deadpp_rep'];
$deadpp_conNum = $_POST['deadpp_conNum'];

// Insert record
$sql = "INSERT INTO deadpp_tbl (brgy_id, deadpp_lname, deadpp_fname, deadpp_mname, deadpp_gender, deadpp_bdate, deadpp_ddate, deadpp_rep, deadpp_conNum) 
        VALUES ('$brgy_id', '$deadpp_lname', '$deadpp_fname', '$deadpp_mname', '$deadpp_gender', '$deadpp_bdate', '$deadpp_ddate', '$deadpp_rep', '$deadpp_conNum')";

if ($conn->query($sql) === TRUE) {
    echo "Record added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: ../index.php"); // Redirect back to your page
exit;
?>
