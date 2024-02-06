<?php 
  require('../../db/config.php');
  session_start();
  
  print_r($_FILES);
  if(isset($_POST['id'])){
    $id = trim($_POST['id']);
    $title = trim($_POST['title']);
    $classID = trim($_POST['classID']);
    print_r($_POST);
    $uploadedFiles = $_FILES['files']['name'];

    $allFilesEmpty = true;
    
    foreach ($uploadedFiles as $fileName) {
        if ($fileName !== "") {
            $allFilesEmpty = false;
            break;  // Exit the loop as soon as a non-empty file name is found
        }
    }
    
    if ($allFilesEmpty) {      
        $query = "UPDATE learningmaterials SET title = ?, class_id = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn,$query);
        $stmt->bind_param("sii", $title,$classID,$id);
        $stmt->execute();
        header('location: ../learningmaterials.php');
        $_SESSION['status'] = "Successfully updated";
        $_SESSION['status_code'] = "success";
    } else {
      $query = "SELECT filePath FROM learningMaterials WHERE id = ?";
      $stmt2 = mysqli_prepare($conn, $query);
      
      // Assuming $id is the variable you want to bind to the parameter
      $stmt2->bind_param("i", $id);
      
      // Execute the prepared statement
      $stmt2->execute();
      
      // Bind the result variable
      $stmt2->bind_result($filePath);
      
      // Fetch the result
      $stmt2->fetch();
      
      // Now $filePath contains the value retrieved from the database
      echo $filePath;
      unlink($filePath);
      // Close the statement
      $stmt2->close();

      $files = array_filter($_FILES['files']['name']);
      $total_count = count($_FILES['files']['name']);
      for($i = 0; $i < $total_count; $i++){
        $tmpFilePath = $_FILES['files']['tmp_name'][$i];
        $filename = $_FILES['files']['name'][$i];
        $fileExt = explode('.',$filename);
        $fileActualExt = strtolower(end($fileExt));
        if($tmpFilePath != ""){
          $newFilePath = "../../uploads/learning/" . $filename;
          echo $newFilePath;
          move_uploaded_file($tmpFilePath, $newFilePath);
         
        }

        $query = "UPDATE learningmaterials SET title = ?, class_id = ?,filePath = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn,$query);
        $stmt->bind_param("sisi", $title,$classID,$newFilePath,$id);
        $stmt->execute();
        header('location: ../learningmaterials.php');
        $_SESSION['status'] = "Successfully updated";
        $_SESSION['status_code'] = "success";
      }
    }
  }
?>