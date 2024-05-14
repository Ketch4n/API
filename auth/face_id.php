<?php
include '../db/database.php';

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to insert a user
function insertUser($user) {
    global $con;
    $stmt = $con->prepare("INSERT INTO face_id (user, password, model_data) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user['user'], $user['password'], $user['model_data']);
    $stmt->execute();
    $stmt->close();
}

// Function to query all users
function queryAllUsers() {
    global $con;
    $result = $conn->query("SELECT * FROM face_id");
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    return $users;
}

// Function to delete all users
function deleteAllUsers() {
    global $con;
    $con->query("DELETE FROM face_id");
}

// Close the connection
$con->close();
?>
