<?php 
session_start();
  print_r($_POST);
require('../phpcodes/connection.php');

  if(isset($_POST['parentID'])){
    $parentId=$_POST['parentID'];

    $query = "DELETE FROM parents WHERE parentID = ?";
    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param("i", $parentId);

    if($stmt->execute()){
    // Check the affected rows to verify if the insertion was successful
    $affected_rows = $stmt->affected_rows;

    if($affected_rows > 0){
        $_SESSION['status'] = "Successfully deleted";
        $_SESSION['status_code'] = "success";
        header('location: ../parentrecords.php');
    } else {
        // Handle the case where no rows were affected (insertion failed)
        $_SESSION['status'] = "Failed to delete record";
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