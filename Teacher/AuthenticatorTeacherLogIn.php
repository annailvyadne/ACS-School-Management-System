<?php
require('../db/config.php');
session_start(); // Start session at the beginning

if(isset($_POST['email'])){
    print_r($_POST);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashedPassword = hash('sha256', $password);
    echo $hashedPassword;

    $query = "SELECT facultyID,facultyTypeID, password FROM faculty WHERE facultyEmailAdd = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param("s", $email);
    
    if($stmt->execute()){
      $stmt->store_result();
      
      if ($stmt->num_rows > 0) {
        $stmt->bind_result($facultyID, $facultyTypeID, $fromDbPassword);
        $stmt->fetch();
        
        if($hashedPassword == $fromDbPassword){
          $_SESSION['statusCustomer'] = "Successfully login!";
          $_SESSION['statusCustomer_code'] = "success";
          echo "same";

          if($facultyTypeID == 1){
            echo "faculty lang";
            header('location: Teacher.php');
          } else {
            echo "faculty leader";
            header('location: ../admin/admin.php');
          }
          $_SESSION['facultyID'] = $facultyID;
          $_SESSION['facultyTypeID'] = $facultyTypeID;
        //   header('location: ../login.php');
        } else {
            
        }
      } else {
        $_SESSION['statusCustomer'] = "User does not exist";
        $_SESSION['statusCustomer_code'] = "info";
        header('location: ../login.php');
      }
    } else {
      echo "Error executing the query: " . $stmt->error;
    }
    
    $stmt->close();
    mysqli_close($conn);
}

?>
