<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "school_management_db";
$connection = mysqli_connect($hostname, $username, $password, $dbname);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve data from the "Parent" table
$sql = "SELECT COUNT(*) AS total_records FROM Parents; ";
$result = mysqli_query($connection, $sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = mysqli_fetch_assoc($result);

    // Output the total number of records
    echo "<h1>" . $row['total_records'] . "</h1>";

    // Free the result set
    mysqli_free_result($result);
} else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>
