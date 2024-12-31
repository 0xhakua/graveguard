<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'graveguard');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deadpp_id = $_POST['deadpp_id'];
    $brgy_id = $_POST['brgy_id'];
    $deadpp_lname = $_POST['deadpp_lname'];
    $deadpp_fname = $_POST['deadpp_fname'];
    $deadpp_mname = $_POST['deadpp_mname'];
    $deadpp_gender = $_POST['deadpp_gender'];
    $deadpp_bdate = $_POST['deadpp_bdate'];
    $deadpp_ddate = $_POST['deadpp_ddate'];
    $deadpp_rep = $_POST['deadpp_rep'];
    $deadpp_conNum = $_POST['deadpp_conNum'];

    // Update query
    $sql = "UPDATE deadpp_tbl 
            SET brgy_id='$brgy_id', deadpp_lname='$deadpp_lname', deadpp_fname='$deadpp_fname', deadpp_mname='$deadpp_mname', 
                deadpp_gender='$deadpp_gender', deadpp_bdate='$deadpp_bdate', deadpp_ddate='$deadpp_ddate', 
                deadpp_rep='$deadpp_rep', deadpp_conNum='$deadpp_conNum'
            WHERE deadpp_id='$deadpp_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
