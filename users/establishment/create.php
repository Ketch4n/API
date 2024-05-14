<?php
include '../../db/database.php';

// Assuming you have a database connection established

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    $code = $data['code'];
    $sname = $data['establishment_name'];
    $aid = $data['creator_id'];
    $loc = $data['location'];
    $longitude = $data['longitude'];
    $latitude = $data['latitude'];
    $hours = $data['hours_required'];
    $radius = $data['radius'];



    // Directly insert into the reference table
    $sqlInsert = "INSERT INTO establishment (establishment_name, creator_email, code, location, longitude,latitude,hours_required,radius) VALUES (?, ?, ?,?,?,?,?,?)";
    $stmtInsert = $con->prepare($sqlInsert);
    $stmtInsert->bind_param("ssssssss", $sname, $aid,  $code, $loc,$longitude,$latitude,$hours,$radius);

    if ($stmtInsert->execute()) {
        // Data inserted successfully
        $response = array('status' => 'Success', 'message' => "$sname added successfully");
        echo json_encode($response);
    } else {
        // Error inserting data
        $response = array('status' => 'error', 'message' => "Error adding $sname");
        echo json_encode($response);
    }
} else {
    // Invalid request method
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}

header('Content-Type: application/json');

// Close the database connection
$con->close();
