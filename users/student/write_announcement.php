<?php
include '../../db/database.php';

// Assuming you have a database connection established
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get data from Flutter app
$data = json_decode(file_get_contents('php://input'), true);
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the request body


    // $uid = $data['student_id'];
    $reason = $_POST['comment'];
    // $reason = nl2br($data['comment']);
    // $date = $data['date'];


    // Directly insert into the reference table
    $sqlInsert = "INSERT INTO announcement (messageA) VALUES (?)";
    $stmtInsert = $con->prepare($sqlInsert);
    $stmtInsert->bind_param("s", $reason);

    if ($stmtInsert->execute()) {
        // Data inserted successfully
        $response = array('status' => 'Success', 'message' => "Submitted Successfully");
        echo json_encode($response);
        exit(); // Add this line to exit the script after echoing the response
    } else {
        // Error inserting data
        $response = array('status' => 'error', 'message' => "Error filing absent");
        echo json_encode($response);
        exit(); // Add this line to exit the script after echoing the response
    }
} else {
    // Invalid request method
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
    exit(); // Add this line to exit the script after echoing the response
}

header('Content-Type: application/json');

// Close the database connection
$con->close();
