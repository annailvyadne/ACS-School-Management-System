<?php
require('TeacherLayout/header.php');
require('TeacherLayout/topbar.php');
?>
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
<h1 style="font-size: 60px;">Class Attendance</h1>

<!-- Page Wrapper -->
<div id="wrapper">


<?php
require('TeacherLayout/sidebar.php');
?>
      

<!--CLASS ATTENDANCE-->

<!-- Begin Page Content -->
<div class="container-fluid" style="margin-top: 50px;">


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo">Open modal for @mdo</button>

            <div class="cards">
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Teacher Records</h2>
                    </div>
                    <table id="datatablegrades">
                      <thead>
                        <tr>
                          <td>Student ID</td>
                          <td>First Name</td>
                          <td>Last Name</td>
                          <td>Actions</td>
                        </tr>
                      </thead>
                      <tbody>
                       <?php 
                       $query = "SELECT classattendance.*, students.studentID, students.studentFirstName, students.studentLastName
                                 FROM classattendance INNER JOIN students ON classattendance.studentID = students.studentID;
                        $query_run = mysqli_query($conn, $query);
                        
                        if($query_run) {
                          foreach($query_run as $row){
                            echo "
                              <tr>
                                <td>" . $row['studentID'] ."</td>
                                <td>" . $row['studentFirstName'] ."</td>
                                <td>" . $row['studentLastName'] ."</td>
                                <td>
                                  <i style='color:green' class='fi fi-rr-edit editBtn'></i>
                                  <i style='color:red;' class='fi fi-rr-trash deleteBtn'></i>
                                  
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
      

    </div>
    <!-- End of Page Wrapper -->
    <?php
    require('TeacherLayout/script.php');
    ?>

