<?php 
   require('phpcodes/connection.php');
   require('layout/header.php');
   require('layout/sidebar.php');
?>

<div class="container">
  <?php 
    require('layout/navbar.php');
  ?>
  <div class="content">

        
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="margin-left: 20px; margin-bottom: 2px; background-color: red; border: 0; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.10),0 17px 50px 0 rgba(0,0,0,0.10); ">Open modal for @mdo</button>
           

<div class="cards">
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Subject Records</h2>
                    </div>
                    <table id="datatable">
                        
                            <!--include("phpcodes/studenttable.php");-->
                            <!--PHP-->


                      <thead>
                        <tr>
                          <th>Subject ID</th>
                          <th>Faculty</th>
                          <th>Subject Name</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                       <?php 
                        $query = "SELECT s.*, faculty.* FROM subject s INNER JOIN faculty ON faculty.facultyID = s.facultyID";

                        $query_run = mysqli_query($conn, $query);
                        
                        if($query_run) {
                          foreach($query_run as $row){
                            echo "
                              <tr>
                                <td>" . $row['subjectID'] ."</td>
                                <td>" . $row['facultyFirstName'] . " ". $row['facultyLastName']. "</td>
                                <td>" . $row['subjectName'] ."</td>
                            
                                    
                                <td>
                                  <i style='color:green' class='fi fi-rr-edit updateBtn' data-facultyid=". $row['facultyID'] . " data-subjectid=" . $row['subjectID'] .  "></i>
                                  <i style='color:red;' class='fi fi-rr-trash deleteBtn' data-id=". $row['subjectID'] . "></i>
                                  
                                </td>
                                
                              </tr>
                            ";
                          }
                        }
                       ?>
                      </tbody>  
                      <tfoot>
                      <th>Subject ID</th>
                          <th>Faculty</th>
                          <th>Subject Name</th>
                          <th>Actions</th>
                      </tfoot>   
                    </table>
                </div>
                
            </div>
        </div>
    </div>

    
  <!--CREATE-->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Subject</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="subjectCRUD/create.php" class="needs-validation" novalidate>
          <div class="mb-3">
            <label for="subjName" class="form-label">Subject</label>
            <input type="text" name="subjName" id="subjName" class="form-control" required>
            <div class="invalid-feedback">Subject is required.</div>
          </div>
          <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Assigned Teacher</label>
              <select name="facultyID" class="form-select" aria-label="Default Select Example" required>
                <option value=""selected disabled>Select a teacher</option>
                  <?php 
          $query = "SELECT * FROM Faculty";
                                          $query_run = mysqli_query($conn,$query);
                                          
                                          if ($query_run) {
                                              foreach ($query_run as $row) {
                                                  echo "<option value=" . $row['facultyID'] .">" .  $row['facultyFirstName'] . " " . $row['facultyLastName'] ."</option>";
                                              }
                                            }
                  ?>
              </select>
              <div class="invalid-feedback">Teacher is required.</div>
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

<!-- Edit -->
  <div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Subject</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="subjectCRUD/update.php" class="needs-validation" novalidate>
          <div class="mb-3">
            <input type="hidden" name="subjID" id="subjID_edit">
            <label for="subjName" class="form-label">Subject</label>
            <input type="text" name="edit_subject" id="edit_subject" class="form-control" required>
            <div class="invalid-feedback">Subject is required.</div>
          </div>
          <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Assigned Teacher</label>
              <select name="edit_facultyID" class="form-select" aria-label="Default Select Example" required id="ha">
                <option value=""selected disabled>Select a teacher</option>
                  <?php 
          $query = "SELECT * FROM Faculty";
                                          $query_run = mysqli_query($conn,$query);
                                          
                                          if ($query_run) {
                                              foreach ($query_run as $row) {
                                                  echo "<option value=" . $row['facultyID'] ." data-facultyid=".$row['facultyID'] .">" .  $row['facultyFirstName'] . " " . $row['facultyLastName'] ."</option>";
                                              }
                                            }
                  ?>
              </select>
              <div class="invalid-feedback">Teacher is required.</div>
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



<!-- Form for deleting a row -->
<form action="subjectCRUD/delete.php" id="deleteForm" method="POST">
  <input type="hidden" name="id_delete" id="id_delete">
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
        $('#datatable').on('click', '.updateBtn', function(){
          
          $('#editSubjectModal').modal('show');
           
            $tr = $(this).closest('tr'); // Fix the typo here: 'closts' to 'closest'
            const data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
       
            console.log(data);
            const subjectName = data[2];
            const facultyID = $(this).data('facultyid');
            const subjectID = $(this).data('subjectid')
            console.log(facultyID);
            console.log(subjectID);
            $('#subjID_edit').val(subjectID);
            $('#edit_subject').val(subjectName);
            $('#ha option').each(function () {
              if ($(this).data('facultyid') == facultyID) {
                $(this).prop('selected', true);
              }
            });
        


        });

        $('#datatable').on('click', '.deleteBtn', function(){
               const id = $(this).data("id");
            console.log(id);  //show a prompt message to confirm if they want to delete it 
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
             $('#id_delete').val(id);
              $('#deleteForm').submit();
            }
          });
        }); 
    });
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
?>
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
</body>

</html>