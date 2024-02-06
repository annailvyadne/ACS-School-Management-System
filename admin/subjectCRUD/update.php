<?php
session_start();
require('../phpcodes/connection.php');

print_r($_FILES);
if (isset($_POST['subjID'])) {

  print_r($_FILES);
  $subjectID = $_POST['subjID'];
  $subjectName = $_POST['edit_subject'];
  $facultyID = $_POST['edit_facultyID'];
  $file = $_FILES['files'];
  $filename = $_FILES['files']['name'];
  $fileTmpName = $_FILES['files']['tmp_name'];
  $fileSize = $_FILES['files']['size'];
  $fileError = $_FILES['files']['error'];
  $fileType = $_FILES['files']['type'];
  $fileExt = explode('.', $filename);
  $fileActualExt = strtolower(end($fileExt));
  $fileDestination = null;

  $allowed = array('jpg', 'jpeg', 'png');
  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      $fileNameNew = uniqid('', true) . "." . $fileActualExt;
      $fileDestination = "../../uploads/subject/" . $fileNameNew;
      move_uploaded_file($fileTmpName, $fileDestination);
    } else {
      $_SESSION['status'] = "There was an error uploading your image!";
      $_SESSION['status_code'] = "error";
      header("location: ../subject.php");
    }
  } else {
    $_SESSION['status'] = "File type not allowed";
    $_SESSION['status_code'] = "error";
    header("location: ../subject.php");
  }


  $query = "SELECT filePath FROM subject WHERE subjectID = ?";
  $stmt3 = mysqli_prepare($conn, $query);
  $stmt3->bind_param("i", $subjectID);
  $stmt3->execute();
  $stmt3->fetch();
  $stmt3->bind_result($filePath);
  $stmt3->close();
  unlink($filePath);
  $query = "UPDATE subject SET subjectName = ?, facultyID = ?, filePath = ? WHERE subjectID = ?";
  $stmt = mysqli_prepare($conn, $query);
  $stmt->bind_param("sisi", $subjectName, $facultyID, $fileDestination, $subjectID);
  $stmt->execute();
  $_SESSION['status'] = "Successfully updated";
  $_SESSION['status_code'] = "success";
  header("location: ../subject.php");
}
