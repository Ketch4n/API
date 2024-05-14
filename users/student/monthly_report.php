<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// $eid = 1;
// $estab_id = 2;
// $month = "all";
// $month = '2024-03';
$eid = $_POST['id'];
$estab_id = $_POST['estab_id'];
$month = $_POST['month'];
if($month != "all"){
    $sql = "SELECT * FROM dtr WHERE student_id = $eid AND estab_id = $estab_id AND DATE_FORMAT(date, '%Y-%m') = '$month' ORDER BY date DESC";

}
else{
    $sql = "SELECT * FROM dtr WHERE student_id = $eid AND estab_id = $estab_id ORDER BY date DESC";

}
// SQL query to fetch data for a single user

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

        // Format total time rendered for AM and PM shifts
        $row['time_rendered_am'] = formatTime($total_time_rendered_am);
        $row['time_rendered_pm'] = formatTime($total_time_rendered_pm);

        // Calculate total hours rendered for this row
        $total_hours_rendered_row = $total_time_rendered_am + $total_time_rendered_pm;

        // Add total hours rendered to this record
        $row['total_hours_rendered'] = formatTime($total_hours_rendered_row);
// Accumulate total hours rendered for grand total
$grand_total_hours_rendered += $total_hours_rendered_row;
// Return the JSON response with grand total
$row['grand_total_hours_rendered'] = formatHourOnly($grand_total_hours_rendered);
        // Add the modified row to the response array
        $response[] = $row;


    }
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

function formatTime($total_seconds) {
    $negative = $total_seconds < 0; // Check if the time difference is negative
    $total_seconds = abs($total_seconds); // Make the time difference positive
    $total_hours = floor($total_seconds / 3600);
    $total_minutes = floor(($total_seconds % 3600) / 60);
    
    // If the time difference is negative, prepend a minus sign
    $prefix = $negative ? "-" : "";
    
    return $prefix . sprintf('%02d:%02d', $total_hours, $total_minutes);
}
function formatHourOnly($total_seconds) {
    $total_hours = floor($total_seconds / 3600); // Calculate total hours

    // Format the total hours
    $formatted_hours = sprintf('%2d', $total_hours);

    return $formatted_hours; // Return formatted hours
}

?>
