<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$sql = "SELECT absent.*,users.email,users.lname FROM absent INNER JOIN users ON users.id = absent.student_id";


// SQL query to fetch data for a single user


// Execute the query
$result = $con->query($sql);

// Initialize an empty array to store the results
$response = array();

if (!$result) {
    // Handle the query error
    die("Query failed: " . $con->error);
}

if ($result->num_rows > 0) {
    // Loop through the result set and fetch all rows
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
