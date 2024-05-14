<?php
include '../db/database.php';

// Check if the connection to the database was successful
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get data from Flutter app
$data = json_decode(file_get_contents('php://input'), true);

// Check if JSON decoding was successful
if ($data === null) {
    // JSON decoding failed
    $response["status"] = "error";
    $response["message"] = "Failed to decode JSON data";
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Extract the data from the request
$email = $data['email'];
$password = $data['password'];
$name = $data['fname'];
$user_id = $data['lname'];
$role = $data['role'];
$bday = $data['bday'];
$uid = $data['uid'];
$address = $data['address'];
$section = $data['section'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Use prepared statements to prevent SQL injection
$sqlCheckEmail = "SELECT email FROM users WHERE email = ? UNION SELECT email FROM admin WHERE email = ?";
$stmtCheckEmail = $con->prepare($sqlCheckEmail);
$stmtCheckEmail->bind_param("ss", $email, $email);
$stmtCheckEmail->execute();
$resultCheckEmail = $stmtCheckEmail->get_result();

if ($resultCheckEmail->num_rows > 0) {
    // Email is already taken
    $response["status"] = "error";
    $response["message"] = "Email is already taken";
} else {
    if ($role === 'Intern') {
        // Insert data into the users table with hashed password
        $sqlUsers = "INSERT INTO users (email, password, fname, lname, role, bday, uid, address, section) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtUsers = $con->prepare($sqlUsers);
        $stmtUsers->bind_param("sssssssss", $email, $hashedPassword, $name, $user_id, $role, $bday, $uid, $address, $section);
        if ($stmtUsers->execute()) {
            // Data inserted successfully into users table
            $response["status"] = "Success";
            $response["message"] = "Account created successfully";
        } else {
            // Error occurred while inserting data into users table
            $response["status"] = "error";
            $response["message"] = "Failed to Sign-up";
        }
    } else {
        // Insert data into the admin table with hashed password
        $sqlAdmin = "INSERT INTO admin (email, password, fname, lname, role) VALUES (?, ?, ?, ?, ?)";
        $stmtAdmin = $con->prepare($sqlAdmin);
        $stmtAdmin->bind_param("sssss", $email, $hashedPassword, $name, $user_id, $role);
        if ($stmtAdmin->execute()) {
            // Data inserted successfully into admin table
            $response["status"] = "Success";
            $response["message"] = "Admin account created successfully";
        } else {
            // Error occurred while inserting data into admin table
            $response["status"] = "error";
            $response["message"] = "Failed to insert data into admin table";
        }
    }
}

// Close prepared statements
$stmtCheckEmail->close();
if (isset($stmtUsers)) {
    $stmtUsers->close();
}
if (isset($stmtAdmin)) {
    $stmtAdmin->close();
}

// Close database connection
$con->close();

// Return response to Flutter app
header('Content-Type: application/json');
echo json_encode($response);
?>
