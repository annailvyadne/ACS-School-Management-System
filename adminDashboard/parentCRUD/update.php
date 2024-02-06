<?php
session_start();
require('../phpcodes/connection.php');

if (isset($_POST['fname'])) {
    print_r($_POST);
    $parentID = $_POST['parentID_edit'];
    echo $parentID;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mn = $_POST['mn'];
    $ea = $_POST['ea'];
    $password = trim($_POST['password']);
    if ($password != "") {
        $hashedPassword = hash('sha256', $password);
        $query = "UPDATE parents SET parentFirstName = ?, parentLastName = ?, parentMobileNo = ?, parentEmailAdd = ?, parentPassword = ? WHERE parentID = ?";
        $stmt = mysqli_prepare($conn, $query);
        $stmt->bind_param("sssssi", $fname, $lname, $mn, $ea, $hashedPassword, $parentID);
    } else {
        $query = "UPDATE parents SET parentFirstName = ?, parentLastName = ?, parentMobileNo = ?, parentEmailAdd = ? WHERE parentID = ?";
        $stmt = mysqli_prepare($conn, $query);
        $stmt->bind_param("ssssi", $fname, $lname, $mn, $ea, $parentID);
    }

    if ($stmt->execute()) {
        $affected_rows = $stmt->affected_rows;

        if ($affected_rows > 0) {
            $_SESSION['status'] = "Successfully updated";
            $_SESSION['status_code'] = "success";
            header('location: ../parentrecords.php');
        } else {
            $_SESSION['status'] = "No records updated";
            $_SESSION['status_code'] = "error";
            echo "mali";
            header('location: ../parentrecords.php');
        }
    } else {
        $_SESSION['status'] = "Error executing query: " . $stmt->error;
        $_SESSION['status_code'] = "error";
        header('location: ../parentrecords.php');
    }

    $stmt->close();
    $conn->close();
}
?>
