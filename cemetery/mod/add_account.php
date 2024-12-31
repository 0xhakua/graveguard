<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'graveguard'); // Update your DB details

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['account_uname'];
    $email = $_POST['account_email'];
    $password = $_POST['account_pword'];

    // Check for duplicate username or email
    $checkSql = "SELECT * FROM account_tbl WHERE account_uname = ? OR account_email = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $username, $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Redirect with an error if username or email already exists
        header("Location: ../account-tbl.php?status=duplicate");
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $sql = "INSERT INTO account_tbl (account_uname, account_email, account_pword) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: ../account-tbl.php?status=added");
        } else {
            header("Location: ../account-tbl.php?status=error");
        }

        $stmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>
