<?php
session_start();
require('../phpcodes/connection.php');

print_r($_POST);
if(isset($_POST['sectionname'])){
    $sectionname=$_POST['sectionname'];
    $facultyID=$_POST['facultyID'];
    $gradelvl=$_POST['gradelvl'];

  $query = "INSERT INTO sections(facultyID, sectionName, gradelevel) VALUES(?,?,?)";

  $stmt = mysqli_prepare($conn, $query);
  $stmt->bind_param("isi", $facultyID, $sectionname, $gradelvl);

  if($stmt->execute()){
      // Check the affected rows to verify if the insertion was successful
      $affected_rows = $stmt->affected_rows;

      if($affected_rows > 0){
          $_SESSION['status'] = "Successfully added";
          $_SESSION['status_code'] = "success";
          header('location: ../section.php');
      } else {
          // Handle the case where no rows were affected (insertion failed)
          $_SESSION['status'] = "Failed to add record";
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
