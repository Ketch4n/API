<?php
// Include your database connection file
include '../../db/database.php';

// Check if absent_id is set in the POST request
if (isset($_POST['absent_id'])) {
    // Sanitize the input to prevent SQL injection
    $absent_id = mysqli_real_escape_string($con, $_POST['absent_id']);

    // SQL query to delete the absent record
    $sql = "DELETE FROM absent WHERE id = '$absent_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If deletion is successful, return success response
        echo json_encode(array("message" => "Absent record deleted successfully"));
    } else {
        // If deletion fails, return error response
        echo json_encode(array("message" => "Failed to delete absent record"));
    }
} else {
    // If absent_id is not set in the POST request, return error response
    echo json_encode(array("message" => "Absent ID not provided"));
}
