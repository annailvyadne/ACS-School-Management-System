<?php
require('TeacherLayout/header.php');
require('TeacherLayout/topbar.php');
require('../db/config.php');

if(isset($_GET['classID'])){
  $classID = $_GET['classID'];
  $sectionID = $_GET['sectionID'];
  $_SESSION['classID'] = $classID;
  $_SESSION['sectionID'] = $sectionID;
}else {
  $classID = $_SESSION['classID'];
$sectionID = $_SESSION['sectionID'];
}

$query = "SELECT subject.subjectName FROM class INNER JOIN subject ON subject.subjectID = class.subjectID WHERE class.classID = ?";
$stmt = mysqli_prepare($conn,$query);
$stmt->bind_param("i", $classID);

if($stmt->execute()){
  $stmt->store_result();
  $stmt->bind_result($subjectName);
  $stmt->fetch();

}
?>

  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  
<h1 style="font-size: 60px;"><?php echo $subjectName ?></h1>

<!-- Page Wrapper -->
<div id="wrapper">

<?php
require('TeacherLayout/sidebar.php');
?>

<div class="container-fluid">
    <div class="accordion-container">
        <div class="accordion" id="accordionExample">
          <!-- Accordion Item #1 -->
          <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Activities
                  </button>
              </h2>

              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">

                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Create Activity</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Activity Details:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="activity-name" class="col-form-label">Activity Name:</label>
            <input type="text" class="form-control" id="activity-name">
          </div>
          <div class="mb-3">
            <label for="activity-description" class="col-form-label">Activity Description:</label>
            <textarea class="form-control" id="activity-description"></textarea>
          </div>
          <div class="mb-3">
            <label for="deadline" class="col-form-label">Deadline:</label>
            <input type="date" class="form-control" id="deadline">
          </div>
          <div class="mb-3">
            <label for="upload-file" class="col-form-label">Upload File:</label>
            <input type="file" class="form-control" id="upload-file" accept=".pdf, .doc, .docx"> <!-- Add the file types you want to accept -->
          </div>

          <!-- Save and Close Buttons -->
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <ul class="list-group" style="width: 100%;">
    <?php 
      $query = "SELECT w.* FROM workActivity w INNER JOIN class c ON(c.classID)";
    ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Homework 1
      <!-- Button trigger modal for Homework 1 -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#homework1Modal">
        Launch Modal
      </button>
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      Homework 2
      <!-- Button trigger modal for Homework 2 -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#homework2Modal">
        Launch Modal
      </button>
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      Homework 3
      <!-- Button trigger modal for Homework 3 -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#homework3Modal">
        Launch Modal
      </button>
    </li>

    <!-- Add more list items and buttons as needed -->

  </ul>
</div>

<!-- Modals -->
<!-- Homework 1 Modal -->
<div class="modal fade" id="homework1Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="homework1ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="homework1ModalLabel">Homework 1 Modal Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Homework 1 Modal Content Goes Here -->
        

<table class="table table-bordered" id="activity1" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Mobile Phone No</th>
                <th>Email Address</th>
            </tr>
        </thead>
        <tbody>
            <?php 
             
            ?>
        </tbody>
    </table>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<!-- Homework 2 Modal -->
<div class="modal fade" id="homework2Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="homework2ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="homework2ModalLabel">Homework 2 Modal Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Homework 2 Modal Content Goes Here -->
        

<table class="table table-bordered" id="activity2" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011-07-25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012-03-29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008-11-28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>New York</td>
                <td>61</td>
                <td>2012-12-02</td>
                <td>$372,000</td>
            </tr>
            <tr>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012-08-06</td>
                <td>$137,500</td>
            </tr>
            <tr>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010-10-14</td>
                <td>$327,900</td>
            </tr>
            <tr>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009-09-15</td>
                <td>$205,500</td>
            </tr>
            <tr>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008-12-13</td>
                <td>$103,600</td>
            </tr>
            <tr>
                <td>London</td>
                <td>30</td>
                <td>2008-12-19</td>
                <td>$90,560</td>
            </tr>
        </tbody>
    </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<!-- Homework 3 Modal -->
<div class="modal fade" id="homework3Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="homework3ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="homework3ModalLabel">Homework 3 Modal Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Homework 3 Modal Content Goes Here -->
        

<table class="table table-bordered" id="activity3" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011-07-25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012-03-29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008-11-28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>New York</td>
                <td>61</td>
                <td>2012-12-02</td>
                <td>$372,000</td>
            </tr>
            <tr>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012-08-06</td>
                <td>$137,500</td>
            </tr>
            <tr>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010-10-14</td>
                <td>$327,900</td>
            </tr>
            <tr>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009-09-15</td>
                <td>$205,500</td>
            </tr>
            <tr>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008-12-13</td>
                <td>$103,600</td>
            </tr>
            <tr>
                <td>London</td>
                <td>30</td>
                <td>2008-12-19</td>
                <td>$90,560</td>
            </tr>
        </tbody>
    </table>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
                    </div>
                </div>
    


            <!-- Accordion Item #2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Learning Materials
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Upload Material
      </button>

<!-- Modal -->
<!--create modal-->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalHeader">Add Learning Material</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="learningMaterialCRUD/create.php" class="needs-validation" novalidate enctype="multipart/form-data">
            <input type="hidden" name="classID" value="<?php echo $classID?>">
            <div class="mb-3">
                <label for="title" class="col-form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <div class="invalid-feedback">Title is required.</div>
            </div>
            <div class="mb-3">
              <label for="score" class="col-form-label">Files</label>
              <input type="file" name="files[]" id="files" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
  </div>
</div>

  <ul class="list-group" style="width: 100%;">
    <?php 
      $query = "SELECT l.* FROM learningmaterials l where l.class_id = $classID";
      $query_run = mysqli_query($conn,$query);
      if($query_run){
        foreach($query_run as $row){
          echo " <li class='list-group-item d-flex justify-content-between align-items-center'>
          ".$row['title'] ."
          
          <a href=".substr($row['filePath'],3) ." download>
          <button type='button' class='btn btn-primary'>
            Download
          </button>
          </a>
        </li>";
        }
      }
    ?>
   

  
  </ul>
</div>

<!-- Modals -->
<!-- Homework 1 Modal -->
<div class="modal fade" id="lesson1Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="lesson1ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lesson1ModalLabel">Homework 1 Modal Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Homework 1 Modal Content Goes Here -->
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<!-- Homework 2 Modal -->
<div class="modal fade" id="lesson2Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="lesson2ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lesson2ModalLabel">Homework 2 Modal Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Homework 2 Modal Content Goes Here -->
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<!-- Homework 3 Modal -->
<div class="modal fade" id="lesson3Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="lesson3ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lesson3ModalLabel">Homework 3 Modal Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Homework 3 Modal Content Goes Here -->
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
                    </div>
                </div>
            


          <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Class Attendance
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">

      
        <!--ATTENDANCE-->

        
<!--CLASS ATTENDANCE-->

<h1 style="font-weight: bold;">Class Subject Attendance</h1>
<!-- Begin Page Content -->
<div class="container-fluid" style="margin-top: 30px;">

  <form action="processAttendance.php" method="POST">
    <div class="mb-3">
    <label for="attendanceDate" class="form-label">Attendance Date</label>
    <input type="date" name="attendanceDate" id="attendanceDate" class="form-control" required>
    <input type="hidden" name="classID" value="<?php echo $classID;?>">
    <input type="hidden" name="sectionID" value="<?php echo $sectionID;?>">
    </div>
    
  <table id="datatablegrade" class="display" style="width:100%;">
    <thead>
      <tr>
          <th>Student ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Age</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $query = "SELECT s.* FROM students s INNER JOIN sections st ON s.sectionID = st.sectionID WHERE s.sectionID = ?";
        $stmt = mysqli_prepare($conn,$query);
        $stmt->bind_param("i", $sectionID);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
              echo "<tr>";
              echo "<td>" . $row['studentID'] . "</td>";
              echo "<td>" . $row['studentFirstName'] . "</td>";
              echo "<td>" . $row['studentLastName'] . "</td>";
              echo "<td>" . $row['studentDOB'] . "</td>";
              echo "<td>" . $row['studentMobileNo'] . "</td>";
              echo "<td>" . $row['studentEmailAdd'] . "</td>";
              echo "
              <td> 
              <select class='form-select' name='status[" . $row['studentID'] . "]' required>
                <option value='' selected disabled>Select</option>
                <option value='Present'>Present</option>
                <option value='Absent'>Absent</option>
                <option value='Late'>Late</option>
            </select>
              </td>";
              echo "</tr>";
            }
        }
      ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
       
    </tfoot>
   
</table>
<button type="submit" class="btn btn-outline-primary w-100 mx-3">Submit</button>
</form>
</div>
        </div>
    </div>
  </div>
</div>
  </div>
</div>
</div>
    </div>
</div>





    </div>
    <!-- End of Page Wrapper -->

    <?php
    require('TeacherLayout/script.php');
    ?>
