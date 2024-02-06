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
    $dob= $_POST['dob'];
    $gradelvl = $_POST['gradelvl'];
    $parentID = $_POST['parentID'];
    $dob = date("Y-m-d", strtotime($_POST['dob']));
    $hashedPassword = hash('sha256', $password);
    $query = "INSERT INTO students(studentFirstName, studentLastName, studentMobileNo, studentEmailAdd, studentPassword, studentDOB, sectionID,parentID) VALUES(?,?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param("ssssssii", $fname, $lname, $mn, $ea, $hashedPassword, $dob, $gradelvl,$parentID);

    
    if($stmt->execute()){
        // Check the affected rows to verify if the insertion was successful
        $affected_rows = $stmt->affected_rows;

        if($affected_rows > 0){
            $_SESSION['status'] = "Successfully added";
            $_SESSION['status_code'] = "success";
            header('location: ../studentrecords.php');
        } else {
            // Handle the case where no rows were affected (insertion failed)
            $_SESSION['status'] = "Failed to add record";
            $_SESSION['status_code'] = "error";
            header('location: ../studentrecords.php');
        }
    } else {
        // Handle the case where the execute method failed
        $_SESSION['status'] = "Error executing query";
        $_SESSION['status_code'] = "error";
        header('location: ../studentrecords.php');
    }
}




?>