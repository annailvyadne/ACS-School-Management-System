  <?php
require('newLayout/header.php');
require('newLayout/navbar.php');
require('newLayout/sidebar.php');
require('phpcodes/connection.php');
?> 

<div class="container-fluid px-5">
<div class="content">
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="margin-left: 20px; margin-bottom: 2px; background-color: red; border: 0; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.10),0 17px 50px 0 rgba(0,0,0,0.10); ">Assign classes</button>
           
            <div class="content-2" style="margin-top: 50px;">
                    <div class="title">
                        <h2>Class Records</h2>
                    </div>
                    <table id="datatable" class="table">
                        
                      <thead>
                        <tr>
                          <th>Class ID</th>
                          <th>Section Name</th>
                          <th>Subject Name</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                       <?php 
                        $query = "SELECT c.*, sj.subjectName,s.sectionName FROM class c INNER JOIN sections s ON c.sectionID = s.sectionID INNER JOIN subject sj ON sj.subjectID = c.subjectID";

                        $query_run = mysqli_query($conn, $query);
                        
                        if($query_run) {
                          foreach($query_run as $row){
                            echo "
                              <tr>
                                <td>" . $row['classID'] ."</td>
                                <td>" . $row['sectionName'] . "</td>
                                <td>" . $row['subjectName'] ."</td>
                                
                                <td>
                                  <i style='color:green' class='fi fi-rr-edit updateBtn' ></i>
                                  <i style='color:red;' class='fi fi-rr-trash deleteBtn' data-id=" . $row['classID'] . "'></i>
                                  
                                </td>
                                
                              </tr>
                            ";
                          }
                        }
                       ?>
                      </tbody>     
                      <tfoot>
                      <th>Class ID</th>
                          <th>Section Name</th>
                          <th>Subject Name</th>
                          <th>Actions</th>
                      </tfoot>
                    </table>
                </div>
              
        </div>
    </div>
                      </div>