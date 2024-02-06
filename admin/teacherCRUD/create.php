<?php
session_start();
require('../phpcodes/connection.php');

if(isset($_POST['fname'])){
    print_r($_POST);
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $mn=$_POST['mn'];
    $ea=$_POST['ea'];
    $password= $_POST['password'];
    $hashedPassword = hash('sha256', $password);
    $fType = $_POST['fType'];
}

$query = "INSERT INTO faculty(facultyFirstName, facultyLastName, facultyMobileNo, facultyEmailAdd, password,facultyTypeID) VALUES(?,?,?,?,?,?)";
$stmt = mysqli_prepare($conn, $query);
$stmt->bind_param("sssssi", $fname, $lname, $mn, $ea, $hashedPassword, $fType);

if($stmt->execute()){
    // Check the affected rows to verify if the insertion was successful
    $affected_rows = $stmt->affected_rows;

    if($affected_rows > 0){
        $_SESSION['status'] = "Successfully added";
        $_SESSION['status_code'] = "success";
        header('location: ../teacherrecords.php');
    } else {
        // Handle the case where no rows were affected (insertion failed)
        $_SESSION['status'] = "Failed to add record";
        $_SESSION['status_code'] = "error";
        header('location: ../teacherrecords.php');
    }
} else {
    // Handle the case where the execute method failed
    $_SESSION['status'] = "Error executing query";
    $_SESSION['status_code'] = "error";
    header('location: ../teacherrecords.php');
}

?>
