<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'graveguard');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if grave_id is set in POST request
if (isset($_POST['deadpp_id'])) {
    $grave_id = intval($_POST['deadpp_id']);
    
    // SQL query to delete the record
    $sql = "DELETE FROM grave_tbl WHERE grave_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $grave_id);
    
    if ($stmt->execute()) {
        header("Location: ../deceased-tbl.php?status=deleted");
    } else {
        header("Location: ../deceased-tbl.php?status=error");
    }
    
    $stmt->close();
} else {
    echo "No record ID provided.";
}

$conn->close();
?>
