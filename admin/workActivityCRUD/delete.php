<?php 
  session_start();
  require('../../db/config.php');
  
  if(isset($_POST['workActivityID_delete'])){
    print_r($_POST);
    $id = trim($_POST['workActivityID_delete']);
   $query = "SELECT filePath FROM workactivity";
   $query_run = mysqli_query($conn,$query);
   if($query_run){
    foreach($query_run as $row){
      unlink($row['filePath']);
    }
   }
    $query = "DELETE FROM workActivity WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    $stmt->bind_param("i", $id);
    if($stmt->execute()){
      // Check the affected rows to verify if the insertion was successful
      $affected_rows = $stmt->affected_rows;

      if($affected_rows > 0){
          $_SESSION['status'] = "Successfully deleted!";
          $_SESSION['status_code'] = "success";
          header('location: ../workActivity.php');
      } else {
            // Handle the case where no rows were affected (insertion failed)
            $_SESSION['status'] = "Failed to delete record";
            $_SESSION['status_code'] = "error";
            header('location: ../workActivity.php');
      }
    } else {
        // Handle the case where the execute method failed
        $_SESSION['status'] = "Error executing query";
        $_SESSION['status_code'] = "error";
        header('location: ../workActivity.php');
    }
  }
?>