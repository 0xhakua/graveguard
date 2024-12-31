<?php

$conn = new mysqli('localhost', 'root', '', 'graveguard');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data
$record_id = $_POST['record_id'];
$plot_number = $_POST['plot_number'];
$plot_description = $_POST['plot_description'];
$deceased_fname = $_POST['deceased_fname'];
$deceased_mname = $_POST['deceased_mname'];
$deceased_lname = $_POST['deceased_lname'];
$gender = $_POST['gender'];
$birth_date = $_POST['birth_date'];
$death_date = $_POST['death_date'];
$representative = $_POST['representative'];
$contact_number = $_POST['contact_number'];
$barangay_id = $_POST['barangay_id'];
$grave_type = $_POST['grave_type'];
$date_buried = $_POST['date_buried'];
$grave_expiry = $_POST['grave_expiry'];
$grave_fee = $_POST['grave_fee'];

// Update logic
$stmt = $conn->prepare("
    UPDATE grave_tbl g
    JOIN plot_tbl p ON g.plot_id = p.plot_id
    JOIN deadpp_tbl d ON g.deadpp_id = d.deadpp_id
    SET 
        p.plot_number = ?, 
        p.plot_description = ?, 
        d.deadpp_fname = ?, 
        d.deadpp_mname = ?, 
        d.deadpp_lname = ?, 
        d.deadpp_gender = ?, 
        d.deadpp_bdate = ?, 
        d.deadpp_ddate = ?, 
        d.deadpp_rep = ?, 
        d.deadpp_conNum = ?, 
        d.brgy_id = ?, 
        g.grave_type = ?, 
        g.grave_burried = ?, 
        g.grave_xpire = ?, 
        g.grave_fee = ?
    WHERE g.grave_id = ?
");
$stmt->bind_param(
    "sssssssssssssssi", 
    $plot_number, 
    $plot_description, 
    $deceased_fname, 
    $deceased_mname, 
    $deceased_lname, 
    $gender, 
    $birth_date, 
    $death_date, 
    $representative, 
    $contact_number, 
    $barangay_id, 
    $grave_type, 
    $date_buried, 
    $grave_expiry, 
    $grave_fee, 
    $record_id
);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to a confirmation page or back to the form with a success message
            header("Location: ../deceased-tbl.php?status=added");
        } else {
            // Handle the case if the query failed
            header("Location: ../deceased-tbl.php?status=error");
        }
        

// Close the database connection
$conn->close();
?>
