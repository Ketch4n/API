<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$estab = $_POST['id'];
// $estab = 20;

// Query to fetch data from your table
$sql = "SELECT radius FROM establishment WHERE id = $estab";
$result = $con->query($sql);

// Fetch data as an associative array
$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows = $row;
}

// Close connection
$con->close();

// Output data as JSON
header('Content-Type: application/json');
echo json_encode($rows);
?>
