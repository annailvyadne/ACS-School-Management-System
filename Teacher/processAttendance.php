<?php
require('../db/config.php');
session_start();

print_r($_POST);

if(isset($_POST['attendanceDate']) && isset($_POST['status'])){
    $attendanceDate = $_POST['attendanceDate'];
    $statuses = $_POST['status'];
    $classID = trim($_POST['classID']);
    $sectionID = trim($_POST['sectionID']);
    $_SESSION['sectionID'] = $sectionID;
    $_SESSION['classID'] = $classID;
     $query = "INSERT INTO attendances(studentID, classID, status, attendance_date) VALUES(?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, 'iiss', $studentID, $classID, $status, $attendanceDate);

        // Assume classID is a constant value for all records (you might need to adjust this)
    

        // Loop through student IDs and statuses
        foreach ($statuses as $studentID => $status) {
            // Execute the query for each pair
            mysqli_stmt_execute($stmt);
        }

        $_SESSION['status'] = "Successfully recorded!";
        $_SESSION['status_code'] = "success";
        // Close the statement
        mysqli_stmt_close($stmt);
        header('location: subject.php');
    } else {
        // Handle the case where preparing the statement fails
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    // Handle the case where attendanceDate or status is not set in the POST data
    echo "Attendance data incomplete.";
}
?>
