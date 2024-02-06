<?php 
  session_start();
  require('../../db/config.php');

  if(isset($_POST['title'])){
    //print_r($_POST);
    $title = trim($_POST['title']);
    $desc = trim($_POST['desc']);
    $classID = trim($_POST['classID']);
    $dueDate = trim($_POST['dueDate']);
    $score = trim($_POST['score']);
    
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
   
    if($filename == null){
      $newFilePath = null;
    } else {
      echo "meron";
      echo $newFilePath;
    }
    $query = "INSERT INTO workActivity(class_id,actName,actDesc,dueDate,actScore,filePath) VALUES(?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    $stmt ->bind_param("isssis",$classID, $title,$desc,$dueDate,$score,$newFilePath);
    $stmt->execute();
    
    $query = "SELECT MAX(id) as id FROM workActivity";
    $query_run = mysqli_query($conn,$query);
    if($query_run){
      foreach($query_run as $row){
        $workactivityID = $row['id'];
      }
    }

    $query = "SELECT st.studentID FROM students st 
    INNER JOIN sections s ON s.sectionID = st.sectionID 
    INNER JOIN class c ON c.sectionID = s.sectionID 
    WHERE c.classID = $classID";
    $query_run = mysqli_query($conn,$query);
    if($query_run){
      $query = "INSERT INTO assigned(workActivityID, studentID, score, filePath) VALUES(?,?,?,?)";
      $stmt2 = mysqli_prepare($conn, $query);

      foreach ($query_run as $row) {
        $studentID = $row['studentID'];
        $score = null; // You need to set a proper value for $score
        $filePath = null; // You need to set a proper value for $filePath
        mysqli_stmt_bind_param($stmt2, "iiis", $workactivityID, $studentID, $score, $filePath);
        mysqli_stmt_execute($stmt2);
      }
        $_SESSION['status'] = "Successfully added";
        $_SESSION['status_code'] = "success";
        header('location: ../workactivity.php');
    }
  }
?>