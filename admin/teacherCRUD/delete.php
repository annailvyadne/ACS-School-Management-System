<?php 
session_start();
  print_r($_POST);
require('../phpcodes/connection.php');

  if(isset($_POST['teacherID'])){
    $TeacherId=$_POST['teacherID'];

    $query = "DELETE FROM faculty WHERE facultyID = ?";
    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param("i", $TeacherId);

    if($stmt->execute()){
    // Check the affected rows to verify if the insertion was successful
    $affected_rows = $stmt->affected_rows;

    if($affected_rows > 0){
        $_SESSION['status'] = "Successfully deleted";
        $_SESSION['status_code'] = "success";
        header('location: ../teacherrecords.php');
    } else {
        // Handle the case where no rows were affected (insertion failed)
        $_SESSION['status'] = "Failed to delete record";
        $_SESSION['status_code'] = "error";
        header('location: ../teacherrecords.php');
    }
} else {
    // Handle the case where the execute method failed
    $_SESSION['status'] = "Error executing query";
    $_SESSION['status_code'] = "error";
    header('location: ../teacherrecords.php');
} 
}

?>