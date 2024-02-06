<?php 
require('../db/config.php');
  session_start();
  if(isset($_POST['password'])){
    print_r($_POST);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashedPassword = hash('sha256', $password);
    $query = "SELECT studentID, studentPassword FROM students WHERE studentEmailAdd = ?";
    $stmt = mysqli_prepare($conn,$query);
    $stmt->bind_param("s", $email);
    
    if($stmt->execute()){
      $stmt->store_result();
      
      if ($stmt->num_rows > 0) {
        $stmt->bind_result($studentID, $fromDbPassword);
        $stmt->fetch();
        
        if($hashedPassword == $fromDbPassword){
          $_SESSION['statusCustomer'] = "Successfully login!";
          $_SESSION['statusCustomer_code'] = "success";
          echo "same";
          header('location: student.php');
          $_SESSION['studentID'] = $studentID;
        } else {
            header('studentlogin.php');
        }
      } else {
        $_SESSION['statusCustomer'] = "User does not exist";
        $_SESSION['statusCustomer_code'] = "info";
        header('location: ../login.php');
      }
    } else {
      echo "Error executing the query: " . $stmt->error;
    }
    
  }
?>