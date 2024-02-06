<?php 
print_r($_POST);
session_start();
require('../db/config.php');
$id = trim($_POST['facultyid_edit']);
$fname = trim($_POST['fname']);
$lname = trim($_POST['lastName']);
$email = trim($_POST['email']);
$mn = trim($_POST['mobile']);
echo $mn;
$password = trim($_POST['password']);

if($password == ""){
  $query = "UPDATE faculty SET facultyFirstName = ?, facultyLastName = ?, facultyMobileNo = ?, facultyEmailAdd = ? WHERE facultyID = ?";
  $stmt = mysqli_prepare($conn,$query);
  $stmt->bind_param("ssssi",$fname,$lname,$mn,$email,$id);
  if($stmt->execute()){
    // Check the affected rows to verify if the insertion was successful
    $affected_rows = $stmt->affected_rows;

    if($affected_rows > 0){
        $_SESSION['status'] = "Successfully updated";
        $_SESSION['status_code'] = "success";
        header('location: teacherAccount.php');
    } else {
        // Handle the case where no rows were affected (insertion failed)
        $_SESSION['status'] = "Failed to add record";
        $_SESSION['status_code'] = "error";
        header('location: teacherAccount.php');
    }
} else {
    // Handle the case where the execute method failed
    $_SESSION['status'] = "Error executing query";
    $_SESSION['status_code'] = "error";
    header('location: teacherAccount.php');
}

} else {
  $query = "UPDATE faculty SET facultyFirstName = ?, facultyLastName = ?, facultyMobileNo = ?, facultyEmailAdd = ?, password = ? WHERE facultyID = ?";
  
}
?>