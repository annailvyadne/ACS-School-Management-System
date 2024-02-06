<?php

require('../db/config.php');
require('ParentLayout/header.php');
require('ParentLayout/topbar.php');
$parentID = $_SESSION['parentID'];
$quarter = 1;
if(isset($_GET['quarter'])){
  $quarter = $_GET['quarter'];
} else {
  $quarter = 1;
}
$query = "SELECT studentID from students WHERE parentID = $parentID";
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
require('ParentLayout/sidebar.php');
?>


<div class="container overflow-hidden" style="margin-top: 50px;"> 
  <div class="row gx-5">
    <div class="col">
      <div class="p-3 border bg-light">

        <table class="table" style="margin-top: 20px;">
          <thead>
            <tr>
              <th>Subject</th>
              <th scope="col">Written Work</th>
              <th scope="col">Performance Task</th>
              <th scope="col">Assessment</th>
            </tr>  
          </thead>
          <tbody>
            <?php 
              $query = "SELECT studentGrades.*,subject.subjectName FROM studentGrades INNER JOIN subject ON subject.subjectID = studentGrades.subjectID WHERE studentID = $studentID AND quarter = $quarter";
              $query_run = mysqli_query($conn,$query);
              if($query_run){
                foreach($query_run as $row){
                  echo "
                      <tr>
                      <td>" . $row['subjectName'] . "</td>
                          <td>" . $row['writtenWork'] . "</td>
                          <td>" . $row['performanceTask'] . "</td>
                          <td>" . $row['assestment'] . "</td>
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



    </div>
    <!-- End of Page Wrapper -->


<?php

require('ParentLayout/script.php');

?>