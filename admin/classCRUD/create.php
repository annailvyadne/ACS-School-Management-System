<?php
session_start();
require('../phpcodes/connection.php');
    print_r($_POST);

if(isset($_POST['subjectname'])){
    $subjectname = $_POST['subjectname'];
    $sectionname = $_POST['sectionname'];
    
$query = "INSERT INTO class(subjectID, sectionID) VALUES(?,?)";
        $stmt=mysqli_prepare($conn,$query);
        $stmt->bind_param('ss',$subjectname, $sectionname);


if($stmt->execute()){
    // Check the affected rows to verify if the insertion was successful
    
    $affected_rows = $stmt->affected_rows;

    if($affected_rows > 0) {
        $_SESSION['status'] = "Successfully added";
        $_SESSION['status_code'] = "success";
        header('location: ../class.php');
    } else {
        // Handle the case where no rows were affected (insertion failed)
        $_SESSION['status'] = "Failed to add record";
        $_SESSION['status_code'] = "error";
        header('location: ../class.php');
    }
} else {
    // Handle the case where the execute method failed
    $_SESSION['status'] = "Error executing query";
    $_SESSION['status_code'] = "error";
    header('location: ../class.php');
}

}


?>