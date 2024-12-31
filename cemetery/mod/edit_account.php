<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'graveguard');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $account_id = $_POST['account_id'];
    $username = $_POST['account_uname'];
    $email = $_POST['account_email'];
    $password = $_POST['account_pword'];

    // Update query
    $sql = "UPDATE account_tbl SET account_uname=?, account_email=?, account_pword=? WHERE account_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $password, $account_id);

    if ($stmt->execute()) {
        // Redirect back to account-tbl.php with success message
        header("Location: ../account-tbl.php?status=edited");
    } else {
        // Redirect back to account-tbl.php with error message
        header("Location: ../account-tbl.php?status=error");
    }
    $stmt->close();
}
$conn->close();
?>
