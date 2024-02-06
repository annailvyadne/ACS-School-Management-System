<!--ASSIGNMENT DELETE-->
<?php 
session_start();
  print_r($_POST);
require('../../admin/phpcodes/connection.php');


  if(isset($_POST['activityname_delete'])){
    print_r($_POST);
    $id = $_POST['activityname_delete']; 


    $query = "SELECT actUploadFile  FROM workactivity WHERE workactivityID =".$id ."";
    $query_run = mysqli_query($conn,$query);
    if($query_run){
      foreach($query_run as $row){
        unlink($row['topicFile']);
      }
    }

    $query = "DELETE FROM workactivity WHERE workactivityID = ?";
    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
    // Check the affected rows to verify if the insertion was successful
    $affected_rows = $stmt->affected_rows;

    if($affected_rows > 0){
        $_SESSION['status'] = "Successfully deleted";
        $_SESSION['status_code'] = "success";
        header('location: ../assignment.php');
    } else {
        // Handle the case where no rows were affected (insertion failed)
        $_SESSION['status'] = "Failed to delete record";
        $_SESSION['status_code'] = "error";
       // header('location: ../subject.php');
    }
  } else {
      // Handle the case where the execute method failed
      $_SESSION['status'] = "Error executing query";
      $_SESSION['status_code'] = "error";
      header('location: ../assignment.php');
  } 
}

?>