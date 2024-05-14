<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Initialize an empty array to store the counts
$response = array();

// Define SQL queries for each table
$tables = array(
    'users' => 'SELECT COUNT(*) AS total_users FROM users',
    'estab' => 'SELECT COUNT(*) AS total_estab FROM establishment',
      'absent' => 'SELECT COUNT(*) AS total_absent FROM absent',
      'late' => "SELECT COUNT(*) AS total_late FROM dtr WHERE time_in_am > '08:00:00' OR time_in_pm > '13:00:00'",
    
  
      
   
    // Add more tables as needed
);

// Execute queries for each table
foreach ($tables as $tableName => $sql) {
    $result = $con->query($sql);

    if ($result) {
        // Fetch the result row
        $row = $result->fetch_assoc();
        // Add count to response array
        $response[$tableName] = $row['total_' . $tableName];
    } else {
        // Handle query execution error
        $response[$tableName] = "Error executing query for table: $tableName";
    }
}

// Close the connection
$con->close();

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
