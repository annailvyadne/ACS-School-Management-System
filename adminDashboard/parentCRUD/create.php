<?php 
session_start();
require('../phpcodes/connection.php');  

if(isset($_POST['fname'])){
  $fname =  trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $mn = trim($_POST['mn']);
  $ea = trim($_POST['ea']);
  $password = trim($_POST['password']);
  $hashedPassword = hash('sha256', $password);
  
  $query = "INSERT INTO parents(parentFirstName,parentLastName,parentMobileNo,parentEmailAdd,parentPassword) VALUES(?,?,?,?,?)";
  $stmt = mysqli_prepare($conn,$query);
  $stmt->bind_param("sssss", $fname,$lname, $mn, $ea, $hashedPassword);

    if($stmt->execute()){
      // Check the affected rows to verify if the insertion was successful
      $affected_rows = $stmt->affected_rows;

      if($affected_rows > 0){
          $_SESSION['status'] = "Successfully added";
          $_SESSION['status_code'] = "success";
          header('location: ../parentrecords.php');
      } else {
          // Handle the case where no rows were affected (insertion failed)
          $_SESSION['status'] = "Failed to add record";
          $_SESSION['status_code'] = "error";
          header('location: ../parentrecords.php');
      }
  } else {
      // Handle the case where the execute method failed
      $_SESSION['status'] = "Error executing query";
      $_SESSION['status_code'] = "error";
      header('location: ../parentrecords.php');
  }
}
?>