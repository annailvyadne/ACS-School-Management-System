<?php
session_start();
require('../phpcodes/connection.php');


if(isset($_POST['subjID'])){
  echo "wala";
  print_r($_POST);
$subjectID=$_POST['subjID'];
$subjectName = $_POST['edit_subject'];
$facultyID=$_POST['edit_facultyID'];

// Update query
$query = "UPDATE subject SET subjectName = ?, facultyID = ? WHERE subjectID = ?"; 
$stmt = mysqli_prepare($conn, $query);
$stmt->bind_param("sii", $subjectName, $facultyID, $subjectID);


if($stmt->execute()){
  $affected_rows = $stmt->affected_rows;
  if($affected_rows > 0){
  $_SESSION['status'] = "Successfully updated";
  $_SESSION['status_code'] = "success";
  header('location: ../subject.php');
  } else {
  $_SESSION['status'] = "No records updated";
  $_SESSION['status_code'] = "error";
  header('location: ../subject.php');
  }
} else {
$_SESSION['status'] = "Error executing query";
$_SESSION['status_code'] = "error";
header('location: ../subject.php');
}

$stmt->close();
} else {
$_SESSION['status'] = "Invalid data";
$_SESSION['status_code'] = "error";
header('location: ../subject.php');
}

?>
