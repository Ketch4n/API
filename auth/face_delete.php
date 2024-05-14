<?php
include '../db/database.php';


// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON data sent from Flutter
    // $userData = json_decode($_POST['user'], true);

    // Insert the user into the database
    $stmt = $con->prepare("DELETE * FROM face_id ");
    // $stmt->bind_param("sss", $userData['user'], $userData['password'], json_encode($userData['modelData']));
    $stmt->execute();
    $stmt->close();

    // Send a success response back to Flutter
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success']);
} else {
    // Handle other request methods if needed
    http_response_code(405); // Method Not Allowed
}

// Close the connection
$con->close();
?>
