<?php
$hostname = "localhost";
$username = "root";
$password = "Mysql12!!";
$dbname = "School";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {
    // Collect data from the form
    $parentFirstName = trim(htmlspecialchars($_POST['parentFirstName']));
    $parentLastName = trim(htmlspecialchars($_POST['parentLastName']));
    $parentMobileNo = trim(htmlspecialchars($_POST['parentMobileNo']));
    $parentEmailAdd = trim(htmlspecialchars($_POST['parentEmailAdd']));
    $parentPassword = trim(htmlspecialchars($_POST['parentPassword']));

    // SQL query to insert data into the database
    $sql = "INSERT INTO Parent (parentFirstName, parentLastName, parentMobileNo, parentEmailAdd, parentPassword)
            VALUES ('$parentFirstName', '$parentLastName', '$parentMobileNo', '$parentEmailAdd', '$parentPassword')";

    // Perform the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
