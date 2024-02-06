<?php 
    require('layout/header.php');
    require('layout/sidebar.php');
?>
 
<div class="container">
  <?php 
    require('layout/navbar.php');
  ?>
  <div class="content">

        
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="margin-left: 20px; margin-bottom: 2px; background-color: red; border: 0; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.10),0 17px 50px 0 rgba(0,0,0,0.10); ">Add Student</button>
           

<div class="cards" style="margin-top: -30px;">
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

    <!-- Create modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden"true">
  <div class="modal-dialog">=
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="studentCRUD/create.php" class="needs-validation" novalidate>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">First Name:</label>
            <input type="text" class="form-control" id="recipient-name" name="fname" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Last Name:</label>
            <input type="text" class="form-control" id="recipient-name" name="lname" required>
          </div>
          <div class="mb-3">
            <label for="parentID" class="form-label">Parent</label>
            <select name="parentID" id="parentID" class="form-select">
              <option value="" selected disabled>Select a Parent</option>
              <?php 
                $query = "SELECT * FROM parents";
                $query_run = mysqli_query($conn,$query);
                
                foreach($query_run as $row){
                  echo "<option value=".$row['parentID'] .">" . $row['parentFirstName'] . " " . $row['parentLastName'] .  "</option>";
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Mobile Number:</label>
            <input type="text" class="form-control" id="recipient-name" name="mn" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email Address:</label>
            <input type="text" class="form-control" id="recipient-name" name="ea" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Password</label>
            <input type="password" class="form-control" id="recipient-name" name="password" required> 
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Birthdate</label>
            <input type="date" class="form-control" id="recipient-name" name="dob" required>
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Grade Level</label>
            <select name="gradelvl" class="form-select" aria-label="Default Select Example" required>
              <option value="" selected disabled>Select a Section</option>
                <?php 
                  $query = "SELECT * FROM sections";
                  $query_run = mysqli_query($conn,$query);
                  if($query_run){
                    foreach($query_run as $row){
                      echo "<option value=".$row['sectionID'] .">" .$row['sectionName']. "-" .$row['gradelevel'] ."</option>";
                    }
                  }
                ?>
            </select>
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


<!-- Edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden"true">
  <div class="modal-dialog">=
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student Modal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="studentCRUD/update.php" class="needs-validation" novalidate>
          <input type="hidden" name="studentID" id="studentID_edit">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">First Name:</label>
            <input type="text" class="form-control" id="fname_edit" name="fname" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Last Name:</label>
            <input type="text" class="form-control" id="lname_edit" name="lname" required>
          </div>
          <div class="mb-3">
            <label for="parentID" class="form-label">Parent</label>
            <select name="parentID" id="parentID_edit" class="form-select" required>
              <option value="" selected disabled>Select a Parent</option>
              <?php 
                $query = "SELECT * FROM parents";
                $query_run = mysqli_query($conn,$query);
                
                foreach($query_run as $row){
                  echo "<option value=".$row['parentID'] ." data-parentid=".$row['parentID'].">" . $row['parentFirstName'] . " " . $row['parentLastName'] .  "</option>";
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Mobile Number:</label>
            <input type="text" class="form-control" id="phoneNo_edit" name="mn" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email Address:</label>
            <input type="text" class="form-control" id="email_edit" name="ea" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Password</label>
            <input type="password" class="form-control" id="password_edit" name="password" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Birthdate</label>
            <input type="date" class="form-control" id="bday_edit" name="dob" required>
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Grade Level</label>
            <select name="gradelvl" class="form-select" aria-label="Default Select Example" id="gradeLvl_edit" required>
                <?php 
                // Assuming the grade levels are predefined
                $gradeLevels = array(0, 1, 2, 3, 4, 5, 6);

                foreach ($gradeLevels as $grade) {
                  echo '<option value="' . $grade . '" data-gradelvl="' . $grade . '">' . $grade . '</option>';

                }
                ?>
            </select>
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
  <form action="studentCRUD/delete.php" id="deleteForm" method="POST">
    <input type="hidden" name="studentID" id="studentID_delete">
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
          
          $('#editModal').modal('show');

          $tr = $(this).closest('tr'); // Fix the typo here: 'closts' to 'closest'
          const data = $tr.children("td").map(function() {
              return $(this).text();
          }).get();
          console.log(data);
            
          // Getting values from table from a specifci row where the edit icon was clicked
          const studentID = data[0];
          const parentID = data[1]
          const fname = data[2];
          const lname = data[3];
          const mn = data[4];
          const ea = data[5];
          const password = data[6];
          const dob = data[7];
          const gradelvl = data[8];

          //Assigning values to inputs in the edit modal
          $('#studentID_edit').val(studentID);
          $('#fname_edit').val(fname);
          $('#lname_edit').val(lname);

          $('#parentID_edit option').each(function () {
            if ($(this).data('parentid') == parentID) {
              $(this).prop('selected', true);
            }
          });
          $('#phoneNo_edit').val(mn);
          $('#email_edit').val(ea);
          $('#password_edit').val(password);
          $('#bday_edit').val(dob);
          console.log('grade lvl:' + gradelvl);
          $('#gradeLvl_edit option').each(function (){
            if($(this).data('gradelvl') == gradelvl){
              $(this).prop('selected', true);
            } else {
              console.log("mali");
              console.log($(this).data('gradelvl'));
              console.log(gradelvl);
            }
          });
        });

        $('#datatable').on('click', '.deleteBtn', function(){
          console.log('hi');
          //Get id from table
           $tr = $(this).closest('tr'); // Fix the typo here: 'closts' to 'closest'
            const data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);  

            const studentID = data[0];
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
              $('#studentID_delete').val(studentID);
              $('#deleteForm').submit();
            }
          });
        }); 
    });
</script>

<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
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

</body>
</html>