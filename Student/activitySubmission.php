<?php

require('../db/config.php');

require('StudentLayout/header.php');
require('StudentLayout/topbar.php');

print_r($_SESSION);
$studentID = $_SESSION['studentID'];
$quarter = 1;
if(isset($_GET['quarter'])){
  $quarter = $_GET['quarter'];
} else {
  $quarter = 1;
}
$query = "SELECT studentID from students WHERE studentID = $studentID";
$query_run = mysqli_query($conn,$query);
if($query_run){
  foreach($query_run as $row){
    $studentID = $row['studentID'];
  } 
  echo $studentID;
}

?>


<!-- Page Wrapper -->
<div id="wrapper">

<?php
require('StudentLayout/sidebar.php');
?>

<div class="container overflow-hidden" style="margin-top: 50px;"> 
  <div class="row gx-5">
    <div class="col">
      <div class="p-3 border bg-light">

        <table class="table" style="margin-top: 20px;">
          <thead>
            <tr>
              <th scope="col">Activity Name</th>
              <th scope="col">Activity Description</th>
              <th scope="col">Deadline</th>
              <th scope="col">File</th>
              <th scope="col">Actions</th>
              
            </tr>  
          </thead>
          <tbody>
            
            <?php 
              $query = "SELECT actName, actDesc, dueDate, filePath FROM workactivity INNER JOIN class c ON c.classID = workactivity.class_id INNER JOIN sections s ON s.sectionID = c.sectionID INNER JOIN students st ON st.sectionID = s.sectionID WHERE st.studentID = $studentID";
              $query_run = mysqli_query($conn,$query);
              if($query_run){
                foreach($query_run as $row){
                  echo "
                      <tr>
                          <td>" . $row['actName'] . "</td>
                          
                          <td>" . $row['actDesc'] . "</td>

                          <td>" . $row['dueDate'] . "</td> 

                          <td> <a href='". substr($row['filePath'], 3)."' download><button class='btn btn-primary'>Download</button></a></td>
       
                                   <td>
                                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addModal' data-bs-whatever='@mdo'>Submit Activity</button>
                            </td>
                      </tr>
                  ";
                } 
              }
            ?>

          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>



<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHeader">Submit Activity</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="assignmentCRUD/create.php" class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                <div class="modal-body">

                  <div class="mb-3">
                        <label for="recipient-name" class="col-form-label"><?php $actName ?></label>
                        <?php 
                            $query = "SELECT * FROM workactivity";
                            $query_run = mysqli_query($conn, $query);
                            if($query_run){
                                foreach ($query_run as $row) {
                                  $actName = $row['id'];
                                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                                }
                            }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label"><?php $studentFirstName ?></label>
                        <?php 
                            $query = "SELECT * FROM students";
                            $query_run = mysqli_query($conn, $query);
                            if($query_run){
                                foreach ($query_run as $row) {
                                  $studentID = $row['studentID'];
                                  $fullName = $row['studentFirstName'] . ' ' . $row['studentLastName'];
                                    echo '<label for="recipient-name" class="col-form-label">' . $fullName . '</label>';
                                    echo '<input type="hidden" name="studentID" value="' . $row['studentID'] . '">';
                                }
                            }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Your answer</label>
                        <textarea class="form-control" id="studentanswer" name="studentanswer" required></textarea>
                       <div class="invalid-feedback">Activity Description is required</div>
                      </div>
                 
                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="uploadfile" name="uploadfile[]" multiple>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


    </div>
    <!-- End of Page Wrapper -->


<?php

require('StudentLayout/script.php');

?>