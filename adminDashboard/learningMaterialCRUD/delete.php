<?php 
  require('../../db/config.php');
  session_start();
  print_r($_POST);
  if(isset($_POST['workActivityID_delete'])){
    $id = trim($_POST['workActivityID_delete']);
    echo $id;
    $query = "DELETE FROM learningMaterials WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    $stmt->bind_param("i", $id);
    if($stmt->execute()){
      // Check the affected rows to verify if the insertion was successful
      
      $affected_rows = $stmt->affected_rows;

      if($affected_rows > 0) {
          $_SESSION['status'] = "Successfully deleted";
          $_SESSION['status_code'] = "success";
          header('location: ../learningmaterials.php');
      } else {
          // Handle the case where no rows were affected (insertion failed)
          $_SESSION['status'] = "Failed to add record";
          $_SESSION['status_code'] = "error";
          header('location: ../learningmaterials.php');
      }
    } else {
      // Handle the case where the execute method failed
      $_SESSION['status'] = "Error executing query";
      $_SESSION['status_code'] = "error";
      header('location: ../learningmaterials.php');
    }
}
?>