<?php
include '../../db/database.php';
// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$uid = $_POST['id'];
$estab = $_POST['estab_id'];
$date = $_POST['date'];
// $uid = 1;
// $estab = 1;
// $date = '2024-02-26';
// SQL query to fetch data for a single user
$sql = "SELECT * FROM dtr WHERE student_id = $uid AND estab_id = $estab AND date = '$date'";

// Execute the query
$result = $con->query($sql);

// Convert the result set to JSON
$response = array();

if ($result->num_rows > 0) {
    // Fetch the row
    $response = $result->fetch_assoc();

   $response['time_rendered_am'] = "00:00";
   $response['time_rendered_pm'] = "00:00";
   $response['total_hours_rendered'] = "00:00";
   $response['grand_total_hours_rendered'] = "00:00";


}

// Close the connectionx
$con->close();

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
