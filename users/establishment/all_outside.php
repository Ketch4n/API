<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Assuming you have received IDs as POST parameters in a JSON array format
// $json_data = $_POST['ids'];
$json_data = '["3","4"]';


// Decode the JSON data into PHP array
$idArray = json_decode($json_data);

// Sanitize each ID to prevent SQL injection
$idArray = array_map(function ($id) use ($con) {
    return $con->real_escape_string($id);
}, $idArray);

// Construct the IN clause for the SQL query
$idList = "'" . implode("','", $idArray) . "'";

// Query to get data from the database based on IDs
$sql = "SELECT dtr.*, users.lname, users.email FROM dtr INNER JOIN users ON dtr.student_id = users.id WHERE dtr.id IN ($idList)";

$result = $con->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Encode the data into JSON format
echo json_encode($data);
header('Content-Type: application/json');

// Close connection
$con->close();
