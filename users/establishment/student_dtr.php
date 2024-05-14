<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$uid = $_POST['id'];
$month = $_POST['month'];
// $uid = 1;

$sql = "SELECT dtr.*, users.
FROM dtr
INNER JOIN users ON dtr.student_id = users.id
 WHERE student_id = $uid ORDER BY date DESC";

// Execute the query
$result = $con->query($sql);

// Initialize an empty array to store the results
$response = array();

if ($result->num_rows > 0) {
    // Loop through the result set and fetch all rows
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
