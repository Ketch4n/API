<?php
include '../../db/database.php';

// Assuming you have a database connection established

// Check if the request method is POST
$data = json_decode(file_get_contents('php://input'), true);
// Retrieve the values from the request body
$eid = $_POST['estab_id'];
$meter = $_POST['meter'];

// Perform the update operation
$sqlUpdate = "UPDATE establishment SET radius = ? WHERE id = ?";
$stmtUpdate = $con->prepare($sqlUpdate);
$stmtUpdate->bind_param("si", $meter, $eid);

if ($stmtUpdate->execute()) {
    // Row updated successfully
    $response = array('status' => 'Success', 'message' => "Status changed successfully");
    echo json_encode($response);
} else {
    // Error updating status
    $response = array('status' => 'error', 'message' => "Error changing status");
    echo json_encode($response);
}

// Close the prepared statement
$stmtUpdate->close();

// Close the database connection
$con->close();
