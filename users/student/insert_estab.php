<?php
include '../../db/database.php';

$data = json_decode(file_get_contents('php://input'), true);

    $student_id = $data['student_id'];
    $estab_id = $data['estab_id'];
    $time_in_am = $data['time_in_am'];
    $in_am_lat = $data['in_am_lat'];
      $in_am_long = $data['in_am_long'];
    $time_out_am = $data['time_out_am'];
    $out_am_lat = $data['out_am_lat'];
    $out_am_long = $data['out_am_long'];
    $time_in_pm = $data['time_in_pm'];
    $in_pm_lat = $data['in_pm_lat'];
     $in_pm_long = $data['in_pm_long'];
    $time_out_pm = $data['time_out_pm'];
    $out_pm_lat = $data['out_pm_lat'];
     $out_pm_long = $data['out_pm_long'];
    $date = $data['date'];

    // Check if data already exists for the given student_id and date
    $checkIfExists = $con->prepare("SELECT id FROM dtr WHERE student_id = ? AND date = ?");
    $checkIfExists->bind_param("is", $student_id, $date);
    $checkIfExists->execute();
    $checkIfExists->store_result();
    $rows = $checkIfExists->num_rows;
    $checkIfExists->close();

    if ($rows > 0) {
        // Update the existing row if data for the student_id and date already exist
        $sql = "UPDATE dtr SET time_in_am = ?, in_am_lat = ?,in_am_long = ?, time_out_am = ?, out_am_lat = ?,out_am_long = ?, time_in_pm = ?, in_pm_lat = ?, in_pm_long = ?,time_out_pm = ?, out_pm_lat = ?, out_pm_long = ? WHERE student_id = ? AND date = ?";
        if ($stmtUpdate = $con->prepare($sql)) {
            $stmtUpdate->bind_param("ssssssssssssis", $time_in_am, $in_am_lat,$in_am_long, $time_out_am, $out_am_lat,$out_am_long, $time_in_pm, $in_pm_lat,$in_pm_long, $time_out_pm, $out_pm_lat,$out_pm_long, $student_id, $date);

            if ($stmtUpdate->execute()) {
                $response = array('status' => 'Success', 'message' => "Updated existing entry");
                echo json_encode($response);
            } else {
                $response = array('status' => 'error', 'message' => $stmtUpdate->error);
                echo json_encode($response);
                // Optionally, log the error for debugging purposes
                error_log("Update Error: " . $stmtUpdate->error);
            }
        } else {
            $response = array('status' => 'error', 'message' => $con->error);
            echo json_encode($response);
            // Optionally, log the error for debugging purposes
            error_log("Prepare Error: " . $con->error);
        }
    } else {
        // Insert a new row if data for the student_id and date doesn't exist
        $sql = "INSERT INTO dtr (student_id, estab_id, time_in_am, in_am_lat,in_am_long, time_out_am, out_am_lat,out_am_long, time_in_pm, in_pm_lat,in_pm_long, time_out_pm, out_pm_lat,out_pm_long, date) VALUES (?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmtInsert = $con->prepare($sql)) {
            $stmtInsert->bind_param("iisssssssssssss", $student_id, $estab_id, $time_in_am, $in_am_lat,$in_am_long, $time_out_am, $out_am_lat,$out_am_long, $time_in_pm, $in_pm_lat,$in_pm_long, $time_out_pm, $out_pm_lat,$out_pm_long, $date);

            if ($stmtInsert->execute()) {
                $response = array('status' => 'Success', 'message' => "Inserted new entry");
                echo json_encode($response);
            } else {
                $response = array('status' => 'error', 'message' => $stmtInsert->error);
                echo json_encode($response);
                // Optionally, log the error for debugging purposes
                error_log("Insert Error: " . $stmtInsert->error);
            }
        } else {
            $response = array('status' => 'error', 'message' => $con->error);
            echo json_encode($response);
            // Optionally, log the error for debugging purposes
            error_log("Prepare Error: " . $con->error);
        }
    }

?>
