<?php
// Include database connection code
include "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get parentID from the URL
    $parentID = $_GET['parentID'];

    // Sanitize and retrieve form data
    $parentFirstName = trim(htmlspecialchars($_POST['parentFirstName']));
    $parentLastName = trim(htmlspecialchars($_POST['parentLastName']));
    $parentMobileNo = trim(htmlspecialchars($_POST['parentMobileNo']));
    $parentEmailAdd = trim(htmlspecialchars($_POST['parentEmailAdd']));
    $parentPassword = trim(htmlspecialchars($_POST['parentPassword']));

    // Update the record in the database
    $sql = "UPDATE Parent SET 
            parentFirstName = '$parentFirstName',
            parentLastName = '$parentLastName',
            parentMobileNo = '$parentMobileNo',
            parentEmailAdd = '$parentEmailAdd',
            parentPassword = '$parentPassword'
            WHERE parentID = $parentID";

    if (mysqli_query($connection, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // Redirect if the form is not submitted
    header("Location: parenttable.php");
    exit();
}
?>
