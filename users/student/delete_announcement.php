<?php
// Include your database connection file
include '../../db/database.php';

// Check if absent_id is set in the POST request
if (isset($_POST['id'])) {
    $an_id = $_POST['id'];

    // SQL query to delete the announcement record
    $sql = "DELETE FROM announcement WHERE an_id = '$an_id'"; // Corrected the column name

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If deletion is successful, return success response
        echo json_encode(array("status" => "Success", "message" => "Announcement deleted successfully"));
    } else {
        // If deletion fails, return error response
        echo json_encode(array("status" => "error", "message" => "Failed to delete announcement"));
    }
} else {
    // If 'id' is not provided in the POST request, return error response
    echo json_encode(array("status" => "error", "message" => "ID not provided"));
}
