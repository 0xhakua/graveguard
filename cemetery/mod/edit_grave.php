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
    $grave_id = $conn->real_escape_string($_POST['grave_id']);
    $grave_type = $conn->real_escape_string($_POST['grave_type']);
    $plot_id = $conn->real_escape_string($_POST['plot_id']);
    $deadpp_id = $conn->real_escape_string($_POST['deadpp_id']);
    $grave_burried = $conn->real_escape_string($_POST['grave_burried']);
    $grave_xpire = $conn->real_escape_string($_POST['grave_xpire']);
    $grave_fee = $conn->real_escape_string($_POST['grave_fee']);

    // Update data in the grave_tbl
    $sql = "UPDATE grave_tbl 
            SET grave_type = '$grave_type', 
                plot_id = '$plot_id', 
                deadpp_id = '$deadpp_id', 
                grave_burried = '$grave_burried', 
                grave_xpire = '$grave_xpire', 
                grave_fee = '$grave_fee'
            WHERE grave_id = '$grave_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect with success
        header("Location: ../grave_management.php?status=success&message=Grave updated successfully");
    } else {
        // Redirect with error
        header("Location: ../grave_management.php?status=error&message=" . $conn->error);
    }
}

$conn->close();
?>
