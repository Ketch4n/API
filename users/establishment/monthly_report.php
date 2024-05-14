<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$eid = $_POST['id'];
$estab_id = $_POST['estab_id'];
$month = $_POST['month'];
// $eid = 11;
// $estab_id = 20;
// $month = "none";
if($month != "none"){
    $sql = "SELECT dtr.*, users.email, users.lname
    FROM dtr
    INNER JOIN users ON dtr.student_id = users.id
    WHERE estab_id = $eid AND  DATE_FORMAT(date, '%Y-%m') = '$month' ORDER BY date DESC";
}
else{
   $sql = "SELECT dtr.*, users.email, users.lname, establishment.latitude, establishment.longitude, establishment.radius
    FROM dtr
    INNER JOIN users ON dtr.student_id = users.id 
    LEFT JOIN establishment ON establishment.id = dtr.estab_id
    WHERE dtr.student_id = $eid AND dtr.estab_id = $estab_id
    ORDER BY dtr.date DESC";

    
     
}


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
