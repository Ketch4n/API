<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


// $sectId = $_POST['section_id'];
// $status = $_POST['status'];
$sectId = 2;
$status = "Pending";

if($status == "Pending"){
    $sql = "SELECT absent.*, users.email,users.lname
    FROM absent
    INNER JOIN users ON absent.student_id = users.id
    WHERE absent.section_id = '$sectId' AND absent.status = '$status'";

}
else {
    $sql = "SELECT absent.*, users.email,users.lname
    FROM absent
    INNER JOIN users ON absent.student_id = users.id
    WHERE absent.section_id = '$sectId' AND absent.status != 'Pending'";

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
