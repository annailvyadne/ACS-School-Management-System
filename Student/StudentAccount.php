<?php

require('StudentLayout/header.php');
require('StudentLayout/topbar.php');
require('../db/config.php');
print_r($_SESSION);
$studentID = $_SESSION['studentID'];
$query = "SELECT st.*, s.sectionName FROM students st INNER JOIN sections s ON(s.sectionID = st.sectionID)WHERE st.studentID = ?";
$stmt = mysqli_prepare($conn,$query);
$stmt->bind_param("i", $studentID);
if ($stmt) {
  mysqli_stmt_bind_param($stmt, "i", $studentID);

  if (mysqli_stmt_execute($stmt)) {
      // Get the result set
      $result = mysqli_stmt_get_result($stmt);

      // Fetch a single row as an associative array
      $studentData = mysqli_fetch_assoc($result);

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
    <div style="width: 800px; height: 500px; background-color: #808080; padding: 20px; text-align: center; color: white; display: flex; flex-direction: column; align-items: center;">


<!-- Basic Information Table -->
<div>

    <h4>BASIC INFORMATION</h4>
    <table class="table table-bordered" style="color: white; width: 600px;">
        <tbody>
            <tr>
                <th scope="row" class="text-start">Student ID</th>
                <td class="text-start"><?php echo $studentData['studentID']?></td>
            </tr>
            <tr>
                <th scope="row" class="text-start">First Name</th>
                <td class="text-start"><?php echo $studentData['studentFirstName']?></td>
            </tr>
            <tr>
                <th scope="row" class="text-start">Last Name</th>
                <td class="text-start"><?php echo $studentData['studentLastName']?></td>
            </tr>
            <tr>
                <th scope="row" class="text-start">Section</th>
                <td class="text-start"><?php echo $studentData['sectionName']?></td>
            </tr>
            <tr>
                <th scope="row" class="text-start">Date of Birth</th>
                <?php 
                $originalDate = $studentData['studentDOB'];
                $dateTime = new DateTime($originalDate);
                $formattedDate = $dateTime->format('F j Y');
                ?>
                <td class="text-start"><?php echo $formattedDate;?></td>
            </tr>
            <tr>
                <th scope="row" class="text-start">Mobile Number</th>
                <td class="text-start"><?php echo $studentData['studentMobileNo']?></td>
            </tr>
            <tr>
                <th scope="row" class="text-start">Email</th>
                <td class="text-start"><?php echo $studentData['studentEmailAdd']?></td>
            </tr>
           
        </tbody>
    </table>
</div>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Edit Profile</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: black;">Profile Customization</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="update.php" method="POST">
          <input type="hidden" name="studentID" value="<?php echo $studentData['studentID'];?>">
          <div class="mb-3 row">
            <label for="firstName" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">First Name</label>
            <div class="col-sm-8">
              <input type="text" id="firstName" name="fname" aria-label="First name" class="form-control" value="<?php echo $studentData['studentFirstName']?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="lastName" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">Last Name</label>
            <div class="col-sm-8">
              <input type="text" id="lastName" name="lname" aria-label="Last name" class="form-control" value="<?php echo $studentData['studentLastName']?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="lastName" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">Date of Birth</label>
            <div class="col-sm-8">
              <input type="date" id="dob" name="dob" aria-label="Last name" class="form-control" value="<?php echo $studentData['studentDOB']?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="lastName" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">Mobile Number</label>
            <div class="col-sm-8">
              <input type="text" id="mn" name="mn" aria-label="Last name" class="form-control" value="<?php echo $studentData['studentMobileNo']?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="email" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">Email Address</label>
            <div class="col-sm-8">
              <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="<?php echo $studentData['studentEmailAdd']?>">
                <label for="email">Email address</label>
              </div>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="password" class="col-sm-4 col-form-label text-start" style="color: black; font-weight: bold;">Password</label>
            <div class="col-sm-8">
              <div class="form-floating">
                <input type="password" name="password"class="form-control" id="password" placeholder="Password">
                <label for="password">Password</label>
              </div>
            </div>
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-primary">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>





<?php
require('StudentLayout/script.php');
?>