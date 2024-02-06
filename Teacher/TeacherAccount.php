<?php

require('TeacherLayout/header.php');
require('TeacherLayout/topbar.php');
require('../db/config.php');

$facultyID = $_SESSION['facultyID'];
$query = "SELECT * FROM faculty WHERE facultyID = ?";
$stmt = mysqli_prepare($conn,$query);
$stmt->bind_param("i", $facultyID);
if ($stmt) {
  mysqli_stmt_bind_param($stmt, "i", $facultyID);

  if (mysqli_stmt_execute($stmt)) {
      // Get the result set
      $result = mysqli_stmt_get_result($stmt);

      // Fetch a single row as an associative array
      $facultyData = mysqli_fetch_assoc($result);

      // Print or use the data as needed
      
  } else {
      echo "Error executing the statement: " . mysqli_stmt_error($stmt);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
} else {
  echo "Error preparing the statement: " . mysqli_error($conn);
}
?>

<!-- Centered Rectangle Container -->
<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="width: 800px; height: 400px; background-color: #808080; padding: 20px; text-align: center; color: white; display: flex; flex-direction: column; align-items: center;">


<!-- Basic Information Table -->
<div>

    <h4>BASIC INFORMATION</h4>
    <table class="table table-bordered" style="color: white; width: 600px;">
        <tbody>
            <tr>
                <th scope="row" class="text-start">First Name</th>
                <td class="text-start"><?php echo $facultyData['facultyFirstName']?></td>
            </tr>
            <tr>
                <th scope="row" class="text-start">Last Name</th>
                <td class="text-start"><?php echo $facultyData['facultyLastName']?></td>
            </tr>
            <tr>
                <th scope="row" class="text-start">Phone Number</th>
                <td class="text-start"><?php echo $facultyData['facultyMobileNo']?></td>
            </tr>
            <tr>
                <th scope="row" class="text-start">Email</th>
                <td class="text-start"><?php echo $facultyData['facultyEmailAdd']; ?></td>

            </tr>
            <tr>
                <th scope="row" class="text-start">Faculty ID</th>
                <td class="text-start"><?php echo $facultyData['facultyID']?></td>
            </tr>

        </tbody>
    </table>
</div>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Edit Profile</button>
<form action="update.php" method="post" class="needs-validation">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: black;">Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="update.php">  
          <input type="hidden" name="facultyid_edit" id="facultyid_edit" value="<?php echo $facultyData['facultyID']?>">
          <div class="mb-3 row">
            <label for="firstName" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">First Name</label>
            <div class="col-sm-8">
              <input type="text" id="firstName" aria-label="First name" name="fname" value="<?php echo $facultyData['facultyFirstName']?>" class="form-control">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="lastName" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">Last Name</label>
            <div class="col-sm-8">
              <input type="text" id="lastName" aria-label="Last name" name="lastName" value="<?php echo $facultyData['facultyLastName']?>" class="form-control">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="lastName" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">Phone Number</label>
            <div class="col-sm-8">
              <input type="text" id="mobile" aria-label="Last name" name="mobile" value="<?php echo $facultyData['facultyMobileNo']?>" class="form-control">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="email" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">Email Address</label>
            <div class="col-sm-8">
              <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $facultyData['facultyEmailAdd']?>" placeholder="name@example.com">
                <label for="email">Email address</label>
              </div>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="password" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">Password</label>
            <div class="col-sm-8">
              <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php ?>">
                <label for="password">Password</label>
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>
</form>





<?php
require('TeacherLayout/script.php');
?>



