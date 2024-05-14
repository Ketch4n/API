<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$sql = "SELECT dtr.*,users.lname, users.email FROM dtr INNER JOIN users ON users.id = dtr.student_id WHERE time_in_am > '08:00:00' OR time_in_pm > '13:00:00'";


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
