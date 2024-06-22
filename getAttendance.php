<?php
include("include/config.php");
// Your SQL query
$date = $_POST['date'];
$sql = "SELECT * FROM `attendance` as at
 inner join 
 employee as emp on at.employee_id = emp.id where at.attendance_date = '$date'
";

$result = $conn->query($sql);

$attendanceData = array();

if ($result->num_rows > 0) {
    // Fetch data and store it in the $attendanceData array
    while ($row = $result->fetch_assoc()) {
        $attendanceData[] = $row;
    }
    // Output the attendance data as JSON
    echo json_encode($attendanceData);
} else {
    // If no data is found, return a custom response
    echo json_encode(array("message" => "No attendance data found"));
}
// Close connection
$conn->close();

// Output the attendance data as JSON
header('Content-Type: application/json');
echo json_encode($attendanceData);
?>
