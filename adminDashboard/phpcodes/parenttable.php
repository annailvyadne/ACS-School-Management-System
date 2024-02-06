<?php
$hostname = "localhost";
$username = "root";
$password = "Mysql12!!";
$dbname = "School";
$connection = mysqli_connect($hostname, $username, $password, $dbname);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve data from the "students" table
$sql = "SELECT parentID, parentFirstName, parentLastName, parentEmailAdd FROM Parent";
$result = mysqli_query($connection, $sql);

// Check if the query was successful
if ($result) {
    // Fetch each row from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Display the record in the specified format
        echo "<tr>";
        echo "<td>" . $row['parentID'] . "</td>";
        echo "<td>" . $row['parentFirstName'] . " " . $row['parentLastName'] . "</td>";
        echo "<td>" . $row['parentEmailAdd'] . "</td>";
        echo "<td><a href='viewparent.php?parentID=" . $row['parentID'] . "' class='btn'>Edit</a></td>";
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
