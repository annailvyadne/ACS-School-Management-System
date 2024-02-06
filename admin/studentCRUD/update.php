<?php
session_start();
require('../phpcodes/connection.php');

if(isset($_POST['fname'])){
    print_r($_POST);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mn = $_POST['mn'];
    $ea = $_POST['ea'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $gradelvl = $_POST['gradelvl'];
    $parentID = $_POST['parentID'];
    $studentID = $_POST['studentID'];

    // Update query
    $query = "UPDATE students SET 
                studentFirstName = ?,
                studentLastName = ?,
                studentMobileNo = ?,
                studentEmailAdd = ?,
                studentPassword = ?,
                studentDOB = ?,
                studentGradeLevel = ?,
                parentID = ?
              WHERE studentID = ?";

    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param("ssssssiii", $fname, $lname, $mn, $ea, $password, $dob, $gradelvl,$parentID ,$studentID);

   if($stmt->execute()){
         $affected_rows = $stmt->affected_rows;

         if($affected_rows > 0){
             $_SESSION['status'] = "Successfully updated";
             $_SESSION['status_code'] = "success";
             header('location: ../studentrecords.php');
         } else {
             $_SESSION['status'] = "No records updated";
             $_SESSION['status_code'] = "error";
             header('location: ../studentrecords.php');
         }
     } else {
         $_SESSION['status'] = "Error executing query";
         $_SESSION['status_code'] = "error";
         header('location: ../studentrecords.php');
     }

     $stmt->close();
 } else {
     $_SESSION['status'] = "Invalid data";
     $_SESSION['status_code'] = "error";
     header('location: ../studentrecords.php');
}

 $conn->close();
?>
