<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parent Record</title>
</head>
<body>

<?php
// Check if there is a parent id
if (isset($_GET['parentID']) && !empty($_GET['parentID'])) {
    // Include database connection code
    include("phpcodes/connection.php");

    // Get the parentID from the URL
    $parentID = $_GET['parentID'];

    // Retrieve existing data from the database
    $sql = "SELECT * FROM Parent WHERE parentID = $parentID";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $parentFirstName = $row['parentFirstName'];
        $parentLastName = $row['parentLastName'];
        $parentMobileNo = $row['parentMobileNo'];
        $parentEmailAdd = $row['parentEmailAdd'];
        $parentPassword = $row['parentPassword'];
    } else {
        echo "Error retrieving data: " . mysqli_error($connection);
    }
} else {
    // Redirect if the form is not submitted
    header("Location: parenttable.php");
    exit();
}
?>

<h2>Edit Parent Record</h2>
<form action="phpcodes/editparent.php?parentID=<?php echo $parentID; ?>" method="post">
    <label for="parentFirstName">First Name:</label>
    <input type="text" name="parentFirstName" value="<?php echo $parentFirstName; ?>" required><br>

    <label for="parentLastName">Last Name:</label>
    <input type="text" name="parentLastName" value="<?php echo $parentLastName; ?>" required><br>

    <label for="parentMobileNo">Mobile Number:</label>
    <input type="text" name="parentMobileNo" value="<?php echo $parentMobileNo; ?>"><br>

    <label for="parentEmailAdd">Email Address:</label>
    <input type="email" name="parentEmailAdd" value="<?php echo $parentEmailAdd; ?>" required><br>

    <label for="parentPassword">Password:</label>
    <input type="password" name="parentPassword" value="<?php echo $parentPassword; ?>" required><br>

    <input type="submit" value="Save Changes">
</form>

</body>
</html>
