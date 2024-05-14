<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// $eid = 1;
// $estab_id = 1;
// $month = '2024-02';
$eid = $_POST['id'];
$estab_id = $_POST['estab_id'];
// $month = $_POST['month'];

// SQL query to fetch data for a single user
$sql = "SELECT * FROM dtr WHERE student_id = $eid AND estab_id = $estab_id";

// Execute the query
$result = $con->query($sql);

$response = array();
$grand_total_hours_rendered = 0; // Initialize grand total hours rendered

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Convert time from 12-hour format to 24-hour format for AM shift
        $time_in_am = date("H:i:s", strtotime($row['time_in_am']));
        $time_out_am = date("H:i:s", strtotime($row['time_out_am']));

        // Convert time from 12-hour format to 24-hour format for PM shift
        $time_in_pm = date("H:i:s", strtotime($row['time_in_pm']));
        $time_out_pm = date("H:i:s", strtotime($row['time_out_pm']));

        // Calculate total time rendered for AM and PM shifts
        $total_time_rendered_am = calculateTotalTime($time_in_am, $time_out_am);
        $total_time_rendered_pm = calculateTotalTime($time_in_pm, $time_out_pm);

        // Calculate total hours rendered for this row
        $total_hours_rendered_row = $total_time_rendered_am + $total_time_rendered_pm;

        // Accumulate total hours rendered for grand total
        $grand_total_hours_rendered += $total_hours_rendered_row;

        // // Add the modified row to the response array
        // $response[] = $row;
    }

    // Add the grand total to the response array
    $response['grand_total_hours_rendered'] = formatHourOnly($grand_total_hours_rendered);
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);

function calculateTotalTime($time_in, $time_out) {
    if ($time_in == '00:00:00' || $time_out == '00:00:00') {
        return 0;
    } else {
        $time_difference = strtotime($time_out) - strtotime($time_in);
        return $time_difference;
    }
}

function formatHourOnly($total_seconds) {
    $total_hours = floor($total_seconds / 3600); // Calculate total hours

    // Format the total hours
    $formatted_hours = sprintf('%2d', $total_hours);

    return $formatted_hours; // Return formatted hours
}
?>
