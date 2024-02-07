<?php
print_r($_POST);
require('../db/config.php');
if ($_FILES['workA']['name'] == "") {
  echo "wala";
} else {
  echo "meron";
}

$workActivityID = $_POST['workActivityID'];
$studID = $_POST['studID'];

$filename = $_FILES['workA']['name'];
$fileTmpName = $_FILES['workA']['tmp_name'];
$fileDestination = "../uploads/submit/" . $filename;
move_uploaded_file($fileTmpName, $fileDestination);

$query = "UPDATE assigned SET filePath = ? WHERE studentID = ? AND workActivityID = ? ";
$stmt = mysqli_prepare($conn, $query);
$stmt->bind_param("sii", $fileDestination, $studID, $workActivityID);
$stmt->execute();
$_SESSION['status'] = "Successfully added";
$_SESSION['status_code'] = "success";
header('location: studentSubject.php');
