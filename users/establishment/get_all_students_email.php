<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Validate and sanitize input if necessary
// $estabId = isset($_POST['establishment_id']) ? intval($_POST['establishment_id']) : 0;

// SQL query to fetch data for a single user with left joins and filtering for null values
$sql = "SELECT users.email FROM users";

// Execute the query
$result = $con->query($sql);

// Initialize an empty array to store the results
$response = array();

if ($result) {
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch all rows
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
    }
    // Close the result set
    $result->close();
} else {
    // Handle query error
    die("Query error: " . $con->error);
}

// Close the connection
$con->close();

// Return the JSON response without brackets
header('Content-Type: application/json');
echo json_encode($response);
