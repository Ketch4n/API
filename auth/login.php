<?php
include '../db/database.php';

header('Content-Type: application/json'); // Set response content type to JSON

if ($con->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $con->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // $email = "nixen@gmail.com";
    // $password = 123456;

    // Sanitize input (you should use prepared statements for better security)
    $email = mysqli_real_escape_string($con, $email);

    // Fetch user data based on the provided email
    $sql = 
    // "SELECT * FROM users WHERE email = '$email'
    // UNION
    "SELECT admin.*, COALESCE(establishment.id, 'null') AS establishment_id FROM admin LEFT JOIN establishment ON establishment.creator_email = admin.email WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password']; // Assuming the password is stored as a hashed password in the database

        // Verify the password using password_verify
        if (password_verify($password, $storedPassword)) {
            // Construct a success response with user ID
            $response = [
                'success' => true,
                
                'id' => $row['id'],
                'role' => $row['role'],
                'fname' => $row['fname'],
                'lname' => $row['lname'],
                'email' => $row['email'],
                'message' => $row['fname'],
                'establishment_id' => $row['establishment_id'],
            ];
            // $response = $result->fetch_assoc();
          
           
            echo json_encode($response);
        } else {
            // Construct a failure response with an error message
            $response = [
                'success' => false,
                'message' => 'Password Incorrect',
            ];
            echo json_encode($response);
        }
    } else {
        // Construct a failure response with an error message
        $response = [
            'success' => false,
            'message' => 'User not found',
        ];
        echo json_encode($response);
    }
}
else {
    // Construct a failure response for an invalid request method
    $response = [
        'success' => false,
        'message' => 'Invalid request method',
    ];
    echo json_encode($response);
}

$con->close();
