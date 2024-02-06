<?php 
  session_start();
  require('../db/config.php');
  print_r($_POST);
  if(isset($_POST['studentID'])){
    $studentID = trim($_POST['studentID']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $dob = trim($_POST['dob']);
    $mn = trim($_POST['mn']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
   
    if($password == ""){
      $query = "UPDATE students SET studentFirstName = ?, studentLastName = ?, studentMobileNo = ?,studentEmailAdd = ?, studentDOB = ? WHERE studentID = ?";
      $stmt = mysqli_prepare($conn,$query);
      $stmt->bind_param("sssssi", $fname,$lname,$mn,$email,$dob,$studentID);
      if($stmt->execute()){
        // Check the affected rows to verify if the insertion was successful
        
        $affected_rows = $stmt->affected_rows;
    
        if($affected_rows > 0) {
            $_SESSION['status'] = "Successfully updated";
            $_SESSION['status_code'] = "success";
            header('location: studentAccount.php');
        } else {
            // Handle the case where no rows were affected (insertion failed)
            $_SESSION['status'] = "Failed to update record";
            $_SESSION['status_code'] = "error";
            header('location: studentAccount.php');
        }
      } else {
          // Handle the case where the execute method failed
          $_SESSION['status'] = "Error executing query";
          $_SESSION['status_code'] = "error";
          header('location: studentAccount.php');
      }
    } else {
      $hashedPassword = hash('sha256', $password);
      $query = "UPDATE students SET studentFirstName = ?, studentLastName = ?, studentMobileNo = ?,studentEmailAdd = ?, studentDOB = ?, studentPassword = ? WHERE studentID = ?";
      $stmt = mysqli_prepare($conn,$query);
      $stmt->bind_param("ssssssi", $fname,$lname,$mn,$email,$dob,$hashedPassword,$studentID);
      if($stmt->execute()){
        // Check the affected rows to verify if the insertion was successful
        
        $affected_rows = $stmt->affected_rows;
    
        if($affected_rows > 0) {
            $_SESSION['status'] = "Successfully updated";
            $_SESSION['status_code'] = "success";
            header('location: studentAccount.php');
        } else {
            // Handle the case where no rows were affected (insertion failed)
            $_SESSION['status'] = "Failed to update record";
            $_SESSION['status_code'] = "error";
            header('location: studentAccount.php');
        }
      } else {
          // Handle the case where the execute method failed
          $_SESSION['status'] = "Error executing query";
          $_SESSION['status_code'] = "error";
          header('location: studentAccount.php');
      }
    }
  }
?>