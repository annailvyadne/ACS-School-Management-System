<?php 
session_start();
 require('../phpcodes/connection.php');
if(isset($_POST['sectionEdit'])){
  print_r($_POST);
  $sectionID = $_POST['sectionIDedit'];
  $facultyID = $_POST['facultyID_edit'];
  $sectionName = $_POST['sectionEdit'];
  $gradeLvl = $_POST['gradeLvl_edit'];

  $query = "UPDATE sections SET sectionName = ?, facultyID = ?, gradeLevel = ? WHERE sectionID = ?";
  $stmt = mysqli_prepare($conn,$query);
  $stmt->bind_param("siii", $sectionName, $facultyID, $gradeLvl, $sectionID);

  if($stmt->execute()){
      // Check the affected rows to verify if the insertion was successful
      $affected_rows = $stmt->affected_rows;

      if($affected_rows > 0){
          $_SESSION['status'] = "Successfully updated";
          $_SESSION['status_code'] = "success";
          header('location: ../section.php');
      } else {
          // Handle the case where no rows were affected (insertion failed)
          $_SESSION['status'] = "Failed to delete record";
          $_SESSION['status_code'] = "error";
          header('location: ../section.php');
      }
    } else {
        // Handle the case where the execute method failed
        $_SESSION['status'] = "Error executing query";
        $_SESSION['status_code'] = "error";
        header('location: ../section.php');
    } 
}
?>