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

// Query to retrieve data from the "students" table
$sql = "SELECT studentID, studentFirstName, studentLastName, studentEmailAdd FROM Students LIMIT 8";
$result = mysqli_query($connection, $sql);

// Check if the query was successful
if ($result) {
    // Fetch each row from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Display the record in the specified format
        echo "<tr>";
        echo "<td>" . $row['studentID'] . "</td>";
        echo "<td>" . $row['studentFirstName'] . " " . $row['studentLastName'] . "</td>";
        echo "<td>" . $row['studentEmailAdd'] . "</td>";
        echo "<td><a href='#' class='btn'>View</a></td>";
        echo "</tr>";
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>
