<?php
require('../db/config.php');

session_start();
print_r($_POST);

error_reporting(E_ALL);
ini_set('display_errors', true);

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Query to retrieve the hashed password from the database
    $query = "SELECT studentID, studentPassword FROM students WHERE studentEmailAdd = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($studentid, $storedPassword);
            $stmt->fetch();

            // Use password_verify to check if the entered password matches the stored hashed password
            if (password_verify($password, $storedPassword)) {
                $_SESSION['userID'] = $studentid;
                // Successful login handling
                $stmt->close();
                mysqli_close($conn);
                header('location: student.php');
                exit();  // Make sure to exit after the header
            } else {
                // Incorrect password handling
                $_SESSION['password_status'] = "Wrong password";
                $_SESSION['password_result'] = "error";
                $stmt->close();
                mysqli_close($conn);
                header('location: studentLogIn.php');
                exit();  // Make sure to exit after the header
            }
        } else {
            // User not found handling
            $_SESSION['password_status'] = "User does not exist";
            $_SESSION['password_result'] = "info";
            $stmt->close();
            mysqli_close($conn);
            header('location: studentLogIn.php');
            exit();  // Make sure to exit after the header
        }
    } else {
        echo "Error executing the query: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    // Handle the case where email or password is not set in the POST request
    header('location: studentLogIn.php');
    exit();  // Make sure to exit after the header
}
?>
