<?php
$conn = new mysqli('localhost', 'root', '', 'graveguard');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Input from form
$grave_type = $_POST['grave_type'];
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
$date_buried = $_POST['date_buried'];
$grave_expiry = $_POST['grave_expiry'];
$grave_fee = $_POST['grave_fee'];

// Step 1: Add or Check Plot
$plot_id = null;
$plot_check = $conn->query("SELECT plot_id FROM plot_tbl WHERE plot_number = '$plot_number'");
if ($plot_check->num_rows > 0) {
    $row = $plot_check->fetch_assoc();
    $plot_id = $row['plot_id'];
} else {
    $stmt = $conn->prepare("INSERT INTO plot_tbl (plot_number, plot_description) VALUES (?, ?)");
    $stmt->bind_param("ss", $plot_number, $plot_description);
    if ($stmt->execute()) {
        $plot_id = $stmt->insert_id; // Get the newly inserted plot_id
    } else {
        die("Error adding plot: " . $stmt->error);
    }
    $stmt->close();
}

// grave type 
$valid_grave_types = [
    "Lawn Grave", "Monument Grave", "Mausoleum", "Vault",
    "Columbarium", "Natural Burial", "Cremation Plot", 
    "Infant/Child Grave", "Family Plot"
];

if (!in_array($_POST['grave_type'], $valid_grave_types)) {
    die("Error: Invalid grave type selected.");
}

$grave_type = $_POST['grave_type'];



// plot description
$valid_plot_locations = [
    "Near the main gate of the cemetery", 
    "Near the center pathway", 
    "Adjacent to the chapel", 
    "On the east side of the cemetery", 
    "On the west side of the cemetery", 
    "Under the large oak tree", 
    "Near the memorial garden", 
    "In the quiet corner"
];

if (!in_array($_POST['plot_description'], $valid_plot_locations)) {
    die("Error: Invalid plot location selected.");
}

$plot_description = $_POST['plot_description'];




// Step 2: Add or Check Deceased Person
$deadpp_id = null;
$deceased_fullname = "$deceased_fname $deceased_mname $deceased_lname";
$deceased_check = $conn->query("
    SELECT deadpp_id 
    FROM deadpp_tbl 
    WHERE deadpp_fname = '$deceased_fname' 
      AND deadpp_mname = '$deceased_mname' 
      AND deadpp_lname = '$deceased_lname'
");
if ($deceased_check->num_rows > 0) {
    $row = $deceased_check->fetch_assoc();
    $deadpp_id = $row['deadpp_id'];
} else {
    $stmt = $conn->prepare("
        INSERT INTO deadpp_tbl (deadpp_fname, deadpp_mname, deadpp_lname, deadpp_gender, deadpp_bdate, deadpp_ddate, deadpp_rep, deadpp_conNum, brgy_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssssssssi", $deceased_fname, $deceased_mname, $deceased_lname, $gender, $birth_date, $death_date, $representative, $contact_number, $barangay_id);
    if ($stmt->execute()) {
        $deadpp_id = $stmt->insert_id; // Get the newly inserted deadpp_id
    } else {
        die("Error adding deceased person: " . $stmt->error);
    }
    $stmt->close();
}

// Step 3: Insert into Grave Table
$stmt = $conn->prepare("
    INSERT INTO grave_tbl (grave_type, plot_id, deadpp_id, grave_burried, grave_xpire, grave_fee) 
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("siissi", $grave_type, $plot_id, $deadpp_id, $date_buried, $grave_expiry, $grave_fee);

if ($stmt->execute()) {
    echo "New grave record added successfully.";
} else {
    die("Error adding grave record: " . $stmt->error);
}

$stmt->close();
$conn->close();
header("Location: deceased-tbl.php");
exit;
?>
