<?php
session_start();
require('../phpcodes/connection.php');
print_r($_FILES);

if (isset($_POST['subjName'])) {
    $subjectName = $_POST['subjName'];
    $facultyID = $_POST['facultyID'];

    $file = $_FILES['files'];
    $filename = $_FILES['files']['name'];
    $fileTmpName = $_FILES['files']['tmp_name'];
    $fileSize = $_FILES['files']['size'];
    $fileError = $_FILES['files']['error'];
    $fileType = $_FILES['files']['type'];
    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));

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

    $query = "INSERT INTO subject(subjectName, facultyID,filePath) VALUES(?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param('sis', $subjectName, $facultyID, $fileDestination);

    if ($stmt->execute()) {
        // Check the affected rows to verify if the insertion was successful

        $affected_rows = $stmt->affected_rows;

        if ($affected_rows > 0) {
            $_SESSION['status'] = "Successfully added";
            $_SESSION['status_code'] = "success";
            header('location: ../subject.php');
        } else {
            // Handle the case where no rows were affected (insertion failed)
            $_SESSION['status'] = "Failed to add record";
            $_SESSION['status_code'] = "error";
            header('location: ../subject.php');
        }
    } else {
        // Handle the case where the execute method failed
        $_SESSION['status'] = "Error executing query";
        $_SESSION['status_code'] = "error";
        header('location: ../subject.php');
    }
}
