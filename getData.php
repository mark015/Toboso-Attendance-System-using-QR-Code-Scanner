<?php

function insertAttendance($conn , $id, $currentDate){
    // SQL query to insert data into the attendance table
    $sql = "INSERT INTO `attendance`(`employee_id`, `attendance_date`) 
        VALUES (?, ?)";

    // Prepare the statement
    $stmtInsert = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if (!$stmtInsert) {
        echo json_encode(array("success" => false, "message" => "Failed to prepare statement: " . $conn->error));
    } else {
        // Bind parameters
        $stmtInsert->bind_param("is", $id, $currentDate);

        // Execute the statement
        if ($stmtInsert->execute()) {
            // echo json_encode(array("success" => true));
        } else {
            // echo json_encode(array("success" => false, "message" => "Failed to execute statement: " . $stmtInsert->error));
        }
    }

    // Close the statement
    $stmtInsert->close();
}

function updateAttendanceAmIn($conn, $id, $currentTime){

    // Construct the SQL query
    $sql = "UPDATE `attendance` SET `am_time_in`='$currentTime' WHERE employee_id=$id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => 'success to update'));
    } else {
        echo json_encode(array("success" => false));
    }
}

function updateAttendance($conn, $id, $currentTime){

    // Construct the SQL query
    $sql = "UPDATE `attendance` SET `am_time_out`='$currentTime' WHERE employee_id=$id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => 'success to update'));
    } else {
        echo json_encode(array("success" => false));
    }
}
function updateAttendanceIn($conn, $id, $currentTime){

    // Construct the SQL query
    $sql = "UPDATE `attendance` SET `pm_time_in`='$currentTime' WHERE employee_id=$id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => 'success to update'));
    } else {
        echo json_encode(array("success" => false));
    }
}

function updateAttendanceOut($conn, $id, $currentTime){

    // Construct the SQL query
    $sql = "UPDATE `attendance` SET `pm_time_out`='$currentTime' WHERE employee_id=$id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => 'success to update'));
    } else {
        echo json_encode(array("success" => false));
    }
}

include("include/config.php");

// Check if the data is sent via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $id = $_POST['id'];
    $timezone = new DateTimeZone('Asia/Manila');
    $dateTime = new DateTime('now', $timezone);
    
    // $currentTime = $dateTime->format('H:i:s');
    $currentTime = '17:31:00';
    $currentDate = $dateTime->format('Y-m-d');
    // Perform the SELECT query
    $stmt = $conn->prepare("SELECT *, ts.id as ts_id FROM employee as e INNER JOIN time_sched as ts ON e.sched_id = ts.id WHERE e.id = ?");
    $stmt->bind_param("i", $id); // assuming $id is an integer
    $stmt->execute();
    $resultSched = $stmt->get_result();
    $rowSched = $resultSched->fetch_assoc();

    $stmtAttendance = $conn->prepare("SELECT * FROM attendance AS a WHERE a.employee_id = ? AND a.attendance_date = ?");
    $stmtAttendance->bind_param("is", $id, $currentDate); // Assuming $id is an integer, $currentDate is a string in 'Y-m-d' format
    $stmtAttendance->execute();
    $resultAtt = $stmtAttendance->get_result();
    $rowAtt = $resultAtt->fetch_assoc();


    $amTimeIn = new DateTime($rowSched['am_time_in']);
    $amTimeIn->modify('+2 hours');
    $amLastTimeIn = $amTimeIn->format('H:i:s');

    $amTimeout = new DateTime($rowSched['am_time_out']);
    $amTimeout->modify('+30 minutes');
    $amLastTimeOut = $amTimeout->format('H:i:s');

    $pmTimein = new DateTime($rowSched['pm_time_in']);
    $pmTimein->modify('+2 hours');
    $pmLastTimein = $pmTimein->format('H:i:s');
    $empty = new DateTime('00:00:00');
    $emptyTime = $empty->format('H:i:s');
    if ((int)$rowSched['ts_id'] === 1) {

        if(empty($rowAtt['employee_id'])){
            insertAttendance($conn , $id, $currentDate);
            // echo json_encode(array("success" => true, "message" => "Invalid request method"));
        }

        if($rowAtt['am_time_in'] === $emptyTime && $currentTime <= $amLastTimeIn){
            updateAttendanceAmIn($conn, $id, $currentTime);
            // echo json_encode(array("success" => 'success to am time in'));
        }else{
            if($rowAtt['am_time_out'] === $emptyTime &&  ($currentTime>=$rowSched['am_time_out'] && $currentTime <= $amLastTimeOut)){
                updateAttendance($conn, $id, $currentTime);
                // echo json_encode(array("success" => $amLastTimeOut));
            }else{
                if($rowAtt['pm_time_in'] === $emptyTime && $amLastTimeOut < $currentTime &&  $currentTime <= $pmLastTimein){
                    updateAttendanceIn($conn, $id, $currentTime);
                    // echo json_encode(array("success" => 'success to update time out'));
                }else{
                    if($rowAtt['pm_time_out'] === $emptyTime && $rowAtt['pm_time_in']<=$currentTime){
                        updateAttendanceOut($conn, $id, $currentTime);
                        // echo json_encode(array("success" => 'success to update time in'));
                    }else{
                        echo json_encode(array("success" => $rowAtt['pm_time_in']));
                    }
                    
                }
            }
        }
    }
    
} else {
    // If the request is not sent via POST, return an error response
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
?>
