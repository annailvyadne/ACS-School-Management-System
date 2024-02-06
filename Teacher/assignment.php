<?php 
session_start();

require('TeacherLayout/header.php');
require('TeacherLayout/topbar.php');
require('../db/config.php');

?>

<body>
  
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo">Add activity</button>
<div id="wrapper">
<?php
require('TeacherLayout/sidebar.php');
?>



            <div class="cards">
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Activity Records</h2>
                    </div>
                    <table id="datatable">
                      <thead>
                        <tr>
                          <td>Work Activity ID</td>
                          <td>Class ID</td>
                          <td>Name</td>
                          <td>Description</td>
                          <td>Duedate</td>
                          <td>File</td>
                          <td>Actions</td>
                        </tr>
                      </thead>
                      <tbody>
                       <?php 
                        $query = "SELECT w.*,c.classID,wf.filePath FROM workActivity w INNER JOIN class c ON(c.classID = w.class_id) INNER JOIN workActivity_files wf ON(wf.workActivityID = w.id)";
                        $query_run = mysqli_query($conn, $query);
                        
                        if($query_run) {
                          foreach($query_run as $row){
                            echo "
                              <tr>
                                <td>" . $row['id'] ."</td>
                                <td>" . $row['classID'] ."</td>
                                <td>" . $row['actName'] ."</td>
                                <td>" . $row['actDesc'] ."</td>
                                <td>" . $row['duedate'] ."</td>
                                <td><a href=". substr($row['filePath'],3) ." target='_blank' download><button class='btn btn-outline-primary'>Download</button></a></td>
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


<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHeader">Add Activity</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="assignmentCRUD/create.php" class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Activity Name</label>
                        <input type="text" class="form-control" id="activityname" name="activityname" required>
                        <div class="invalid-feedback">Activity name is required</div>
                    </div>

                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Activity Description</label>
                        <textarea class="form-control" id="activitydescription" name="activitydescription" required></textarea>
                       <div class="invalid-feedback">Activity Description is required</div>
                      </div>
                 
                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="uploadfile" name="uploadfile[]" multiple required>
                           <div class="invalid-feedback">Activity File is required</div>
                    </div>

                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Duedate</label>
                        <input type="date" class="form-control" id="duedate" name="duedate" required></input>
                       <div class="invalid-feedback">Duedate is required</div>
                      </div>


                                              <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Assigned Class</label>
              <select name="class" class="form-select" aria-label="Default Select Example" required>
                <option value=""selected disabled>Select a class</option>
                  <?php 
          $query = "SELECT class.*, subject.*, sections.* FROM class INNER JOIN sections ON class.sectionID = sections.sectionID INNER JOIN subject ON class.subjectID = subject.subjectID;";
                                          $query_run = mysqli_query($conn,$query);
                                          
                                          if ($query_run) {
                                              foreach ($query_run as $row) {
                                                  echo "<option value=" . $row['classID'] .">" .  $row['subjecName'] . "-" . $row['sectionName'] ."</option>";
                                              }
                                            }
                  ?>
              </select>
              <div class="invalid-feedback">Class is required.</div>
          </div>

                </div>
                



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

  
<!-- Edit modal -->
<div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHeader">Edit Learning Materials</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           <form action="assignmentCRUD/update.php" class="needs-validation" novalidate method="post" enctype="multipart/form-data">
            <input type="hidden" name="learningmaterialid" id="learningmaterialid_edit">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Topic Name</label>
                        <input type="text" class="form-control" id="activityname" name="activityname" required>
                        <div class="invalid-feedback">Topic Name is required</div>
                    </div>

                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Topic Description</label>
                        <textarea class="form-control" id="activitydescription" name="activitydescription" required></textarea>
                        <div class="invalid-feedback">Topic Description is required</div>
                    </div>

                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="uploadFile_edit" name="uploadfile[]">
                    </div>
                </div>

            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Assigned Class</label>
              <select name="class" class="form-select" aria-label="Default Select Example" id="classid_edit" required>
                <option value=""selected disabled>Select a class</option>
                  <?php 
          $query = "SELECT class.*, subject.*, sections.* FROM class INNER JOIN sections ON class.sectionID = sections.sectionID INNER JOIN subject ON class.subjectID = subject.subjectID;";
                                          $query_run = mysqli_query($conn,$query);
                                          
                                          if ($query_run) {
                                              foreach ($query_run as $row) {
                                                  echo "<option value=" . $row['classID'] ." data-classid=".$row['classID'].">" .  $row['subjectName'] . "-" . $row['sectionName'] ."</option>";
                                              }
                                            }
                  ?>
              </select>
              <div class="invalid-feedback">Class is required.</div>
          </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form for deleting a row -->
<form action="assignmentCRUD/delete.php" id="deleteForm" method="POST">
  <input type="hidden" name="activityname_delete" id="activityname_delete">
</form>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
      let table = new DataTable('#datatable');
    </script> 

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
    $(document).ready(function(){
      $('#datatable').on('click', '.editBtn', function(){
        //Show modal
        $('#editTeacherModal').modal('show');
        
        //Get the values on the tablex
        $tr = $(this).closest('tr'); 
        const data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data);
        
        //Check mo yong console at yong index nung array na lalabas yan yong pagkakasunod nun
        const learningmaterialid = data[0];
        const title = data[1];
        const desc = data[2];
        const classid = data[4];

        //Diba may input sa edit modal kunin mo id nila at ilagay yong mga values na meron na tayo ngayon
        $('#activityname').val(title);
        $('#activitydescription').val(desc);
        $('#learningmaterialid_edit').val(learningmaterialid);
        
        //Ang laman ng facultyID variable ay yong id nung teacher kung saang row yong clinick. After nun ichecheck yong data attribute ng
        // lahat ng option after nun kapag may match yon yong iseselect
        $('#classid_edit option').each(function () {
            if ($(this).data('classid') == classid) {
              $(this).prop('selected', true);
            }
        });

      });

        $('#datatable').on('click', '.deleteBtn', function(){
        
          //Get id from table
           $tr = $(this).closest('tr'); 
            const data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);  

            //Get the sectionid on the table
            const workActivityID = data[0];

            //show a prompt message to confirm if they want to delete it 
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
          }).then((result) => {
            if (result.isConfirmed) {
              $('#activityname_delete').val(workActivityID);
              $('#deleteForm').submit();
            }
          });
        }); 
    });
</script>

<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

<?php 
  if(isset($_SESSION['status']) && $_SESSION['status'] != ""){
    ?>

    <script>
      Swal.fire({
        icon: '<?php echo $_SESSION['status_code'] ?>',
        title: '<?php echo $_SESSION['status'] ?>',
      })
    </script>
    <?php 
  }
    unset($_SESSION['status']);
     unset($_SESSION['status_code']);
  ?>
</div>
  </body>
</html>