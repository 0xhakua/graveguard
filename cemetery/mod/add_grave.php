<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'graveguard');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $grave_type = $conn->real_escape_string($_POST['grave_type']);
    $plot_id = $conn->real_escape_string($_POST['plot_id']);
    $deadpp_id = $conn->real_escape_string($_POST['deadpp_id']);
    $grave_burried = $conn->real_escape_string($_POST['grave_burried']);
    $grave_xpire = $conn->real_escape_string($_POST['grave_xpire']);
    $grave_fee = $conn->real_escape_string($_POST['grave_fee']);

    // Insert data into the grave_tbl
    $sql = "INSERT INTO grave_tbl (grave_type, plot_id, deadpp_id, grave_burried, grave_xpire, grave_fee) 
            VALUES ('$grave_type', '$plot_id', '$deadpp_id', '$grave_burried', '$grave_xpire', '$grave_fee')";

    if ($conn->query($sql) === TRUE) {
        // Redirect with success
        header("Location: ../grave_management.php?status=success&message=Grave added successfully");
    } else {
        // Redirect with error
        header("Location: ../grave_management.php?status=error&message=" . $conn->error);
    }
}

$conn->close();
?>
