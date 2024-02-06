<?php 
  session_start();
  require('../../db/config.php');
  print_r($_POST);
  if(isset($_POST['id'])){
    $id = $_POST['id'];
    $title = trim($_POST['title_edit']);
    $desc = trim($_POST['desc_edit']);
    $classID = trim($_POST['classID_edit']);
    $dueDate = trim($_POST['dueDate_edit']);
    $score = trim($_POST['score_edit']);
    $uploadedFiles = $_FILES['files']['name'];
    $allFilesEmpty = true;
    foreach ($uploadedFiles as $fileName) {
        if ($fileName !== "") {
            $allFilesEmpty = false;
            break;  // Exit the loop as soon as a non-empty file name is found
        }
    }
    if ($allFilesEmpty) {
        $query = "UPDATE workActivity SET class_id = ?, actName = ?, actDesc = ?, dueDate = ?, actScore = ? WHERE id = ? ";
        $stmt = mysqli_prepare($conn, $query);
        $stmt-> bind_param("isssii", $classID,$title,$desc,$dueDate,$score,$id);
        $stmt->execute();
        $_SESSION['status'] = "Successfully updated";
        $_SESSION['status_code'] = "success";
        header('location: ../workactivity.php');
    } else {
      $total_count = count($_FILES['files']['name']);
      for($i = 0; $i < $total_count; $i++){
        $tmpFilePath = $_FILES['files']['tmp_name'][$i];
        $filename = $_FILES['files']['name'][$i];
        $fileExt = explode('.',$filename);
        $fileActualExt = strtolower(end($fileExt));
        if($tmpFilePath != ""){
          $newFilePath = "../../uploads/activity/" . $filename;
          move_uploaded_file($tmpFilePath, $newFilePath);
        }
      }
      
      $query = "SELECT filePath FROM workactivity WHERE id = $id";
      $query_run = mysqli_query($conn,$query);
      if($query_run){
        foreach($query_run as $row){
          unlink($row['filePath']);
        }
      }
      $query = "UPDATE workActivity SET class_id = ?, actName = ?, actDesc = ?, dueDate = ?, actScore = ?,filePath = ? WHERE id = ? ";
        $stmt = mysqli_prepare($conn, $query);
        $stmt-> bind_param("isssisi", $classID,$title,$desc,$dueDate,$score,$newFilePath,$id);
        $stmt->execute();
        $_SESSION['status'] = "Successfully updated";
        $_SESSION['status_code'] = "success";
        header('location: ../workactivity.php');
        echo "meron";
    }
   
  
  
  }
?>