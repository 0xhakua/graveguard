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

    // Delete data from grave_tbl
    $sql = "DELETE FROM grave_tbl WHERE grave_id = '$grave_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect with success
        header("Location: ../grave_management.php?status=success&message=Grave deleted successfully");
    } else {
        // Redirect with error
        header("Location: ../grave_management.php?status=error&message=" . $conn->error);
    }
}

$conn->close();
?>
