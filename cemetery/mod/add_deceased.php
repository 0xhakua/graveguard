<?php
include '../db_connect.php';

$conn = new mysqli('localhost', 'root', '', 'graveguard');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $deadpp_fname = $_POST['deadpp_fname'];
    $deadpp_mname = $_POST['deadpp_mname'];
    $deadpp_lname = $_POST['deadpp_lname'];
    $deadpp_gender = $_POST['deadpp_gender'];
    $deadpp_bdate = $_POST['deadpp_bdate'];
    $deadpp_ddate = $_POST['deadpp_ddate'];
    $deadpp_rep = $_POST['deadpp_rep'];
    $deadpp_conNum = $_POST['deadpp_conNum'];
    // $plot_id = $_POST['plot_id'];
    // $grave_type = $_POST['grave_type'];
    // $grave_fee = $_POST['grave_fee'];
    // $grave_buried = $_POST['grave_buried'];
    $brgy_id = $_POST['brgy_id'];

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert into deadpp_tbl
        $query1 = "INSERT INTO deadpp_tbl (brgy_id, deadpp_fname, deadpp_mname, deadpp_lname, deadpp_gender, deadpp_bdate, deadpp_ddate, deadpp_rep, deadpp_conNum)
                   VALUES ('$brgy_id', '$deadpp_fname', '$deadpp_mname', '$deadpp_lname', '$deadpp_gender', '$deadpp_bdate', '$deadpp_ddate', '$deadpp_rep', '$deadpp_conNum')";
        mysqli_query($conn, $query1);

        // Get last inserted deadpp_id
        $deadpp_id = mysqli_insert_id($conn);

        // Insert into grave_tbl
        // $query2 = "INSERT INTO grave_tbl (plot_id, deadpp_id, grave_type, grave_fee, grave_buried)
        //            VALUES ('$plot_id', '$deadpp_id', '$grave_type', '$grave_fee', '$grave_buried')";
        // mysqli_query($conn, $query2);

        // Commit transaction
        mysqli_commit($conn);

        // Redirect with success message
        header("Location: ../deceased-tbl.php?success=1");
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
}
?>
