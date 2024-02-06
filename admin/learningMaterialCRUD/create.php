<?php 
  session_start();
  require('../../db/config.php');
  if(isset($_POST['title'])){
    $title = trim($_POST['title']);
    $classID = trim($_POST['classID']);
    
    $files = array_filter($_FILES['files']['name']);
      $total_count = count($_FILES['files']['name']);
      for($i = 0; $i < $total_count; $i++){
        $tmpFilePath = $_FILES['files']['tmp_name'][$i];
        $filename = $_FILES['files']['name'][$i];
        $fileExt = explode('.',$filename);
        $fileActualExt = strtolower(end($fileExt));
        if($tmpFilePath != ""){
          $newFilePath = "../../uploads/learning/" . $filename;
          move_uploaded_file($tmpFilePath, $newFilePath);
         
        }
      }

    $query = "INSERT INTO learningmaterials(title,filePath,class_id) VALUES(?,?,?)";
    $stmt = mysqli_prepare($conn,$query);
    $stmt->bind_param("ssi", $title,$newFilePath,$classID);

    if($stmt->execute()){
      // Check the affected rows to verify if the insertion was successful
      
      $affected_rows = $stmt->affected_rows;
  
      if($affected_rows > 0) {
          $_SESSION['status'] = "Successfully added";
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