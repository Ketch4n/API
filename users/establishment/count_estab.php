<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// SQL query to count all rows in the users table
$sql = "SELECT COUNT(*) AS total_estab FROM establishment";

// Execute the query
$result = $con->query($sql);

// Initialize an empty array to store the results
$response = array();

if ($result->num_rows > 0) {
    // Fetch the result row
    $row = $result->fetch_assoc();
    $response['total_estab'] = $row['total_estab'];
}

// Close the connection
$con->close();

// Return the JSON response without brackets
header('Content-Type: application/json');
echo json_encode($response);
?>
