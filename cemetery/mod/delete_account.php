<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'graveguard');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $account_id = $_POST['account_id'];

    // Check the number of records in the table
    $countSql = "SELECT COUNT(*) AS total FROM account_tbl";
    $result = $conn->query($countSql);
    $row = $result->fetch_assoc();
    $totalRecords = $row['total'];

    if ($totalRecords > 1) {
        // Delete query
        $sql = "DELETE FROM account_tbl WHERE account_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $account_id);

        if ($stmt->execute()) {
            // Redirect back to account-tbl.php with success message
            header("Location: ../account-tbl.php?status=deleted");
        } else {
            // Redirect back to account-tbl.php with error message
            header("Location: ../account-tbl.php?status=error");
        }
        $stmt->close();
    } else {
        // Redirect with a message indicating the last record cannot be deleted
        header("Location: ../account-tbl.php?status=last_record_error");
    }
}
$conn->close();
?>
