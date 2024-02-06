<?php
session_start();
print_r($_POST);
require('../../db/config.php');
$id = trim($_POST['facultyID_edit']);
$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$mn = trim($_POST['mn']);
$ea = trim($_POST['ea']);
$password = trim($_POST['password']);
$ftype = trim($_POST['fType']);

if ($password == "") {
  $query = "UPDATE faculty SET facultyFirstName = ?, facultyLastName = ?, facultyMobileNo = ?, facultyEmailAdd = ?,facultyTypeID =? WHERE facultyID = ?";
  $stmt = mysqli_prepare($conn, $query);
  $stmt->bind_param("ssssii", $fname, $lname, $mn, $ea, $ftype, $id);
  $stmt->execute();
  $_SESSION['status'] = "Successfully updated";
  $_SESSION['status_code'] = "success";
  header('location: ../teacher.php');
} else {
  $query = "UPDATE faculty SET facultyFirstName = ?, facultyLastName = ?, facultyMobileNo = ?, facultyEmailAdd = ?,password = ?,facultyTypeID =? WHERE facultyID = ?";
  $stmt = mysqli_prepare($conn, $query);
  $stmt->bind_param("sssssii", $fname, $lname, $mn, $ea, $password, $ftype, $id);
  $stmt->execute();
  $_SESSION['status'] = "Successfully updated";
  $_SESSION['status_code'] = "success";
  header('location: ../teacher.php');
}
