<?php
session_start();
require('../phpcodes/connection.php');

if (isset($_POST['studentID'])) {
    $studentId = $_POST['studentID'];
    print_r($_POST);
$query_delete_attendances = "DELETE FROM attendances WHERE studentID = ?";
$stmt_delete_attendances = mysqli_prepare($conn, $query_delete_attendances);
$stmt_delete_attendances->bind_param("i", $studentId);
$stmt_delete_attendances->execute();

// Now you can delete the student
$query_delete_student = "DELETE FROM students WHERE studentID = ?";
$stmt_delete_student = mysqli_prepare($conn, $query_delete_student);
$stmt_delete_student->bind_param("i", $studentId);

    if ($stmt_delete_student->execute()) {
        echo "Query executed successfully.<br>";
        $affected_rows = $stmt->affected_rows;

        if ($affected_rows > 0) {
            $_SESSION['status'] = "Successfully deleted";
            $_SESSION['status_code'] = "success";
            header('location: ../studentrecords.php');
        } else {
            echo "No rows affected.<br>";
            $_SESSION['status'] = "Failed to delete record: " . $stmt_delete_studentt->error;
            $_SESSION['status_code'] = "error";
            header('location: ../studentrecords.php');
        }

        $$stmt_delete_student->close(); // Close the statement
    } else {
        echo "Error executing query.<br>";
        $_SESSION['status'] = "Error executing query";
        $_SESSION['status_code'] = "error";
        header('location: ../studentrecords.php');
    }
}
?>
