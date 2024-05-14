<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$estab = $_POST['estab_id'];
$role = $_POST['role'];
// $estab = 4;
// $role = "Admin";

if ($role == "SUPER ADMIN") {
    $sql = "SELECT users.*, COALESCE(room.establishment_id, 'null') AS establishment_id
        FROM users
        LEFT JOIN 
        room ON room.student_id = users.id";
} else {
    $sql = "SELECT users.*, room.establishment_id, room.student_id, establishment.id AS establishment_id
    FROM users
    LEFT JOIN room ON room.student_id = users.id
    LEFT JOIN establishment ON room.establishment_id = establishment.id
    WHERE establishment.id = $estab AND users.id IS NOT NULL";
}


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
