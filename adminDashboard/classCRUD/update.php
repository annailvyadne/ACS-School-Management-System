<?php
session_start();
require('../phpcodes/connection.php');

print_r($_POST);

if (isset($_POST['edit_subjectid'], $_POST['edit_sectionid'], $_POST['classID'])) {
    // Extract form data
    $subjectid = $_POST['edit_subjectid'];
    $sectionid = $_POST['edit_sectionid'];
    $classid = $_POST['classID']; 

    // Update query
    $query = "UPDATE class SET subjectID = ?, sectionID = ? WHERE classID = ?"; 
    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param("iii", $subjectid, $sectionid, $classid);

    if ($stmt->execute()) {
        $affected_rows = $stmt->affected_rows;
        if ($affected_rows > 0) {
            $_SESSION['status'] = "Successfully updated";
            $_SESSION['status_code'] = "success";
            header('location: ../class.php');
        } else {
            $_SESSION['status'] = "No records updated";
            $_SESSION['status_code'] = "error";
            header('location: ../class.php');
        }
    } else {
        $_SESSION['status'] = "Error executing query";
        $_SESSION['status_code'] = "error";
        header('location: ../class.php');
    }

} else {
    $_SESSION['status'] = "Invalid data";
    $_SESSION['status_code'] = "error";
    header('location: ../class.php');
}
?>
