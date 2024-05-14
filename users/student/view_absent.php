<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$uid = $_POST['student_id']; // Sanitize user input
$sectId = $_POST['section_id'];
$status = $_POST['status'];
$purpose = $POST['purpose'];

if($purpose == "Intern"){
    if($status == "Pending"){
    $sql = "SELECT * FROM absent WHERE student_id = '$uid' AND section_id = '$sectId' AND status = '$status'";
}
else {
    $sql = "SELECT * FROM absent WHERE student_id = '$uid' AND section_id = '$sectId' AND status != 'Pending'";
}
}
else{
     if($status == "Pending"){
    $sql = "SELECT absent.*,users.email,users.lname FROM absent INNER JOIN users ON users.id = absent.student_id WHERE section_id = '$sectId' AND status = '$status'";
}
else {
    $sql = "SELECT absent.*,users.email,users.lname FROM absent INNER JOIN users ON users.id = absent.student_id WHERE section_id = '$sectId' AND status != 'Pending'";
}
}
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
