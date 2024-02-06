<?php
session_start();
require('../db/config.php');

print_r($_POST);
if(isset($_POST['studentID'])){
    $studentID=$_POST['studentID'];
    $id=$_POST['id'];
    $studentanswer=$_POST['studentanswer'];
    $uploadfile=$_POST['uploadfile'];

  $query = "INSERT INTO students_has_workActivity(studentID, id, studentAnswer, filePath) VALUES(?,?,?,?)";

  $stmt = mysqli_prepare($conn, $query);
  $stmt->bind_param("isi", $studentID, $id, $studentanswer, $uploadfile);

  if($stmt->execute()){
      // Check the affected rows to verify if the insertion was successful
      $affected_rows = $stmt->affected_rows;

      if($affected_rows > 0){
          $_SESSION['status'] = "Successfully submitted";
          $_SESSION['status_code'] = "success";
          header('location: ../activitysubmissionphp');
      } else {
          // Handle the case where no rows were affected (insertion failed)
          $_SESSION['status'] = "Failed to submit";
          $_SESSION['status_code'] = "error";
          header('location: ../activitysubmission.php');
      }
  } else {
      // Handle the case where the execute method failed
      $_SESSION['status'] = "Error executing query";
      $_SESSION['status_code'] = "error";
      header('location: ../activitysubmission.php');
  }

}

?>
