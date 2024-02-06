<?php 

require('TeacherLayout/header.php');
require('TeacherLayout/topbar.php');
require('../db/config.php');

if (isset($yourArray['sectionID'])) {
$sectionID = trim($_SESSION['sectionID']);
$classID = trim($_SESSION['classID']);
$query = "SELECT subjectID FROM class WHERE classID = $classID";
$query_run = mysqli_query($conn,$query);
if($query_run){
  foreach($query_run as $row){
    $subjectID = $row['subjectID'];
  }
}
  echo $subjectID;
}
?>

<body>
<div id="wrapper">
<?php
require('TeacherLayout/sidebar.php');
?>
<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo">Add grades</button>
  <div class="cards">
  </div>
  <div class="content-2">
      <div class="recent-payments">
          <div class="title">
              <h2>Student Grades</h2>
          </div>
          <table id="datatable">
            <thead>
              <tr>
                <th>Grades ID</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Quarter</th>
                <th>School Year</th>
                <th>Written Work</th>
                <th>Performance Task</th>
                <th>Assessment</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $query = "SELECT s.*,sg.* FROM studentgrades sg INNER JOIN students s ON(s.studentID = sg.studentID) ";
              $query_run = mysqli_query($conn, $query);
              
              if($query_run) {
                foreach($query_run as $row){
                  echo "
                    <tr>
                          <td>" . $row['id'] ."</td>
                          <td>" . $row['studentID'] ."</td>
                          <td>" . $row['studentFirstName'] . $row['studentLastName'] ."</td>
                          <td>" . $row['quarter'] ."</td>
                          <td>" . $row['schoolYear'] ."</td>
                          <td>" . $row['writtenWork'] ."</td>
                          <td>" . $row['performanceTask'] ."</td>
                          <td>" . $row['assestment'] ."</td>
                          
                          <td>
                        <i style='color:green' class='fi fi-rr-edit editBtn' data-studentid=".$row['studentID']."></i>
                        <i style='color:red;' class='fi fi-rr-trash deleteBtn'></i>          
                      </td>   
                    </tr>
                  ";
                }
              }
              ?>
              </tbody>
              <tfoot>
              <tr>
              <th>Grades ID</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Quarter</th>
                <th>School Year</th>
                <th>Written Work</th>
                <th>Performance Task</th>
                <th>Assessment</th>
                <th>Actions</th>
                </tr>
              </tfoot>
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
                <h1 class="modal-title fs-5" id="modalHeader">Add Student Grade</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="teacherGradeCRUD/create.php" class="needs-validation" novalidate method="post">
                <div class="modal-body">
              <input type="hidden" name="subjectID" value="<?php echo $subjectID;?>">
                <!--STUDENT SELECT NAME-->
                   <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Student Name</label>
              <select name="studentID" class="form-select" aria-label="Default Select Example" required>
                <option value=""selected disabled>Select a class</option>
                  <?php 
                    $query = "SELECT st .* FROM students st INNER JOIN sections s ON s.sectionID = st.sectionID WHERE st.sectionID = $sectionID";
                    $query_run = mysqli_query($conn,$query);
                    if($query_run){
                      foreach($query_run as $row){
                        
                        echo "<option value=" . $row['studentID'] . ">" . $row['studentFirstName'] . "-" . $row['studentLastName'] . "</option>";
                      }
                    } 

                  ?>
              </select>
              <div class="invalid-feedback">Student name is required.</div>
          </div>    


          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Quarter</label>
            <select name="quarter" class="form-select" aria-label="Default Select Example" id="quarter_edit" required>
              <option value="" selected disabled>Select a quarter</option>
                <?php 
                // Assuming the grade levels are predefined
                $schoolQuarter = array(1, 2, 3, 4);

                foreach ($schoolQuarter as $quarter) {
                  echo '<option value="' . $quarter . '" data-schoolQuarterl="' . $quarter . '">' . $quarter . '</option>';

                }
                ?>
            </select>
          </div>
                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">School Year</label>
                        <input type="text" id="schoolyear" name="schoolyear" class="form-control" pattern="\d{4}-\d{4}" title="Enter a valid school year in the format YYYY-YYYY" required>
                        <div class="invalid-feedback">School year is required</div>
                    </div>
          
                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Written Work</label>
                        <input type="number" id="writtenwork" name="writtenwork" step="0.01" required class="form-control">
                        <div class="invalid-feedback">Written work is required</div>
                    </div>

                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Performance Task</label>
                        <input type="number" id="performancetask" name="performancetask" step="0.01" required class="form-control">
                        <div class="invalid-feedback">Performance Task is required</div>
                    </div>

                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Assessment</label>
                        <input type="number" id="assessment" name="assessment" step="0.01" required class="form-control">
                        <div class="invalid-feedback">Assessment is required</div>
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
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalHeader">Edit Student Grade</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="teacherGradeCRUD/update.php" class="needs-validation" novalidate method="post">
          <div class="modal-body">
            <input type="hidden" name="id_edit" id="id_edit">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Student Name</label>
              <select name="studentID_edit" class="form-select" aria-label="Default Select Example" required id="studentID_edit">
                <option value=""selected disabled>Select a class</option>
                  <?php 
                    $query = "SELECT st .* FROM students st INNER JOIN sections s ON s.sectionID = st.sectionID WHERE st.sectionID = $sectionID";
                    $query_run = mysqli_query($conn,$query);
                    if($query_run){
                      foreach($query_run as $row){
                        
                        echo "<option value=" . $row['studentID'] . " data-studentid=".$row['studentID'].">" . $row['studentFirstName'] . "-" . $row['studentLastName'] . "</option>";
                      }
                    } 

                  ?>
              </select>
              <div class="invalid-feedback">Student name is required.</div>
            </div>    
            <div class="mb-3">
              <label for="quarter_edit" class="col-form-label">Quarter</label>
              <select name="quarter_edit" class="form-select" aria-label="Default Select Example" id="quarter_edit" required>
                <option value="" selected disabled>Select a quarter</option>
                  <?php 
                  // Assuming the grade levels are predefined
                  $schoolQuarter = array(1, 2, 3, 4);

                  foreach ($schoolQuarter as $quarter) {
                    echo '<option value="' . $quarter . '" data-schoolQuarter="' . $quarter . '">' . $quarter . '</option>';

                  }
                  ?>
              </select>
            </div>
            <div class="mb-3">
                <label for="edit_schoolYear" class="form-label">School Year</label>
                <input type="text" id="edit_schoolYear" name="edit_schoolYear" class="form-control" pattern="\d{4}-\d{4}" title="Enter a valid school year in the format YYYY-YYYY" required>
                <div class="invalid-feedback">School year is required</div>
            </div>
            <div class="mb-3">
                <label for="writtenwork_edit" class="form-label">Written Work</label>
                <input type="number" id="writtenwork_edit" name="writtenwork_edit" step="0.01" required class="form-control">
                <div class="invalid-feedback">Written work is required</div>
            </div>
            <div class="mb-3">
                <label for="performancetask_edit" class="form-label">Performance Task</label>
                <input type="number" id="performancetask_edit" name="performancetask_edit" step="0.01" required class="form-control">
                <div class="invalid-feedback">Performance Task is required</div>
            </div>
            <div class="mb-3">
                <label for="assessment_edit" class="form-label">Assessment</label>
                <input type="number" id="assessment_edit" name="assessment_edit" step="0.01" required class="form-control">
                <div class="invalid-feedback">Assessment is required</div>
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

<!-- Form for deleting a row -->
<form action="teacherGradeCRUD/delete.php" id="deleteForm" method="POST">
  <input type="hidden" name="grade_delete" id="grade_delete">
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
        $('#editModal').modal('show');
        
        //Get the values on the tablex
        $tr = $(this).closest('tr'); 
        const data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data);
        
        //Check mo yong console at yong index nung array na lalabas yan yong pagkakasunod nun
        const id = data[0];
        const studentID = data[1];
        const quarter = data[3];
        const schoolYear = data[4];
        const work = data[5];
        const task = data[6];
        const assestment = data[7];

        $('#studentID_edit option').each(function(){
          if ($(this).data('studentid')== studentID) {
              $(this).prop('selected', true);
          }
        });

        $('#quarter_edit option').each(function(){
          if ($(this).data('schoolquarter') == quarter) {
              $(this).prop('selected', true);
          }
        });
        $('#edit_schoolYear').val(schoolYear);
        $('#writtenwork_edit').val(work);
        $('#performancetask_edit').val(task);
        $('#assessment_edit').val(assestment);
        //Diba may input sa edit modal kunin mo id nila at ilagay yong mga values na meron na tayo ngayon
        $('#id_edit').val(id);
       
        
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
              $('#grade_delete').val(workActivityID);
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