<?php

include'../db/database.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS face_id (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    model_data TEXT NOT NULL
)";

if ($con->query($sql) === false) {
    die("Error creating table: " . $con->error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $password = $_POST['password'];
    $modelData = $_POST['model_data'];

    $sql = "INSERT INTO face_id (user, password, model_data) VALUES ('$user', '$password', '$modelData')";

    if ($con->query($sql) === false) {
        die("Error inserting data: " . $con->error);
    }

    echo "Data inserted successfully!";
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $con->query("SELECT * FROM face_id");
    $users = array();

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode($users);
}

$con->close();

?>
