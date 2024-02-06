<?php
require('newLayout/header.php');
require('newLayout/navbar.php');
require('newLayout/sidebar.php');
require('phpcodes/connection.php');
?>

<div class="container-fluid px-5">

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="margin-left: 20px; margin-bottom: 2px; background-color: red; border: 0; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.10),0 17px 50px 0 rgba(0,0,0,0.10); ">Add Student</button>
           

            </div>
            <div class="content-2">
                <div class="recent-payments" style="margin-top: 10px;">
                    <div class="title">
                        <h2>Student Records</h2>
                    </div>
                    <table id="datatable">
                      <thead>
                        <tr>
                          <th>Student ID</th>
                          <th>Parent ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Mobile Number</th>
                          <th>Email Address</th>
                          <th>Birthdate</th>
                          <th>Section</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                       <?php 
                          $query = "SELECT Students.studentID, Students.parentID, Students.studentFirstName, Students.studentLastName, Students.studentMobileNo, Students.studentEmailAdd, Students.studentPassword, Students.studentDOB, sections.sectionName
                                    FROM Students 
                                    INNER JOIN sections ON sections.sectionID = students.sectionID
                                    LEFT JOIN Parents ON Students.parentID = Parents.parentID;";


                        $query_run = mysqli_query($conn, $query);
                        
                        if($query_run) {
                          foreach($query_run as $row){
        
                            echo "
                              <tr>
                                <td>" . $row['studentID'] ."</td>
                                <td>" . $row['parentID'] ."</td>
                                <td>" . $row['studentFirstName'] ."</td>
                                <td>" . $row['studentLastName'] ."</td>
                                <td>" . $row['studentMobileNo'] ."</td>
                                <td>" . $row['studentEmailAdd'] ."</td>
                                <td>" . $row['studentDOB'] ."</td>
                                <td>" . $row['sectionName'] ."</td>
                                
                               
                        
                                <td>
                                  <i style='color:green' class='fi fi-rr-edit updateBtn'></i>
                                  <i style='color:red;' class='fi fi-rr-trash deleteBtn' data-studentid=". $row['studentID'] ."></i>
                                  
                                </td>
                                
                              </tr>
                            ";
                          }
                        }
                       ?>
                      </tbody> 
                      <tfoot>
                        <th>Student ID</th>
                        <th>Parent ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mobile Number</th>
                        <th>Email Address</th>
                        <th>Birthdate</th>
                        <th>Section</th>
                        <th>Actions</th>
                      </tfoot>    
                    </table>
                </div>
            </div>
        </div>
    </div>


