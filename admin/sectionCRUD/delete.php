<?php 
//yah

   require('../phpcodes/connection.php');
  session_start();
  if(isset($_POST['sectionID_delete'])){
   
    //Dump the post array para makita mo kung ano yong pumapasok at pangalan ng variable
    print_r($_POST);
    //Assign mo lang yong id sa isang variable 
    $sectionID = $_POST['sectionID_delete'];

    //query mo lang to
    $query = "DELETE FROM sections WHERE sectionID = ?";
    $stmt = mysqli_prepare($conn,$query);
    $stmt->bind_param("i", $sectionID);

    //Execute the query
    if($stmt->execute()){
      // Check the affected rows to verify if the insertion was successful
      $affected_rows = $stmt->affected_rows;



      echo "hi";
      if($affected_rows > 0){
          $_SESSION['status'] = "Successfully deleted";
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