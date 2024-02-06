<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "school_management_db";
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


