<?php 
  require('../db/config.php');
  session_start();

  if(isset($_POST['parentID'])){
    print_r($_POST);
    $parentID = trim($_POST['parentID']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $mn = trim($_POST['mn']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if($password == ""){
      $query = "UPDATE parents SET parentFirstName = ?, parentLastName = ?, parentMobileNo = ?, parentEmailAdd = ? WHERE parentID = ?";
      $stmt = mysqli_prepare($conn,$query);
      $stmt->bind_param("ssssi", $fname,$lname,$mn,$email,$parentID);
      if($stmt->execute()){
        // Check the affected rows to verify if the insertion was successful
        
        $affected_rows = $stmt->affected_rows;
    
        if($affected_rows > 0) {
            $_SESSION['status'] = "Successfully updated";
            $_SESSION['status_code'] = "success";
            header('location: parentAccount.php');
        } else {
            // Handle the case where no rows were affected (insertion failed)
            $_SESSION['status'] = "Failed to update record";
            $_SESSION['status_code'] = "error";
            header('location: parentAccount.php');
        }
      } else {
          // Handle the case where the execute method failed
          $_SESSION['status'] = "Error executing query";
          $_SESSION['status_code'] = "error";
          header('location: parentAccount.php');
      }
    }else { 
      $hashedPassword = hash('sha256', $password);
      $query = "UPDATE parents SET parentFirstName = ?, parentLastName = ?, parentMobileNo = ?, parentEmailAdd = ?, parentPassword = ? WHERE parentID = ?";
      $stmt = mysqli_prepare($conn,$query);
      $stmt->bind_param("sssssi", $fname,$lname,$mn,$email,$hashedPassword,$parentID);
      if($stmt->execute()){
        // Check the affected rows to verify if the insertion was successful
        
        $affected_rows = $stmt->affected_rows;
    
        if($affected_rows > 0) {
            $_SESSION['status'] = "Successfully updated";
            $_SESSION['status_code'] = "success";
            header('location: parentAccount.php');
        } else {
            // Handle the case where no rows were affected (insertion failed)
            $_SESSION['status'] = "Failed to update record";
            $_SESSION['status_code'] = "error";
            header('location: parentAccount.php');
        }
      } else {
          // Handle the case where the execute method failed
          $_SESSION['status'] = "Error executing query";
          $_SESSION['status_code'] = "error";
          header('location: parentAccount.php');
      }
    }
  } else {
    //header('location: parent.php');
  }

?>