<?php 
    require('layout/header.php');
    require('layout/sidebar.php');
?>
 
<div class="container">
    <?php 
        require('layout/navbar.php');
    ?>
    <div class="content">
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="margin-left: 20px; margin-bottom: 2px; background-color: red; border: 0; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.10),0 17px 50px 0 rgba(0,0,0,0.10); ">Add Teacher</button>
        <div class="content-2">
          
            <div class="recent-payments">

                <div class="title">
                    <h2>Teacher Records</h2>
                </div>
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th>Faculty ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile Number</th>
                            <th>Email Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT faculty.*, facultyTypes.typeName FROM faculty INNER JOIN facultyTypes ON FacultyTypes.facultyTypeID = faculty.facultyTypeID";
                            $query_run = mysqli_query($conn, $query);

                            if ($query_run) {
                                foreach ($query_run as $row) {
                                    echo "
                                        <tr>
                                            <td>" . $row['facultyID'] . "</td>
                                            <td>" . $row['facultyFirstName'] . "</td>
                                            <td>" . $row['facultyLastName'] . "</td>
                                            <td>" . $row['facultyMobileNo'] . "</td>
                                            <td>" . $row['facultyEmailAdd'] . "</td>
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
                    <tfoot>
                      <th>Faculty ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Mobile Number</th>
                      <th>Email Address</th>
                      <th>Actions</th>
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
          <h1 class="modal-title fs-5" id="modalHeader">Add Teacher</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="teacherCRUD/create.php" class="needs-validation" novalidate method="post">
          <div class="modal-body">

                         <div class="mb-3">
             <label for="regionNameID" class="form-label">First Name</label>
             <input type="text" class="form-control" id="regionNameID" name="regionName">
             </div>

                         <div class="mb-3">
             <label for="regionNameID" class="form-label">Last Name</label>
             <input type="text" class="form-control" id="regionNameID" name="regionName">
             </div>

                         <div class="mb-3">
             <label for="regionNameID" class="form-label">Mobile Number</label>
             <input type="text" class="form-control" id="regionNameID" name="regionName">
             </div>

                         <div class="mb-3">
             <label for="regionNameID" class="form-label">Email Address</label>
             <input type="text" class="form-control" id="regionNameID" name="regionName">
             </div>

                         <div class="mb-3">
             <label for="regionNameID" class="form-label">Password</label>
             <input type="password" class="form-control" id="regionNameID" name="regionName">
             </div>
             
                   <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Faculty Type ID</label>
    <select name="facultyID_edit" id="facultyID_edit" class="form-select" aria-label="Default Select Example">
        <?php 

        $query = "SELECT * FROM facultytypes";
        $query_run = mysqli_query($conn, $query);
        if($query_run){
            foreach ($query_run as $row) {
            echo "<option value=" . $row['facultyTypeID'] . "</option>";
          }
        }
      
        ?>
             </div>
          </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-dark" name="addRegion_submit" id="addSubmit">Add Region</button>
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
                <h1 class="modal-title fs-5" id="modalHeader">Edit Teacher</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="teacherCRUD/update.php">
                    <input type="hidden" name="facultyID_edit" id="facuiltyID_edit">
                    <div class="mb-3">
                        <label for="fname_edit" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control" id="fname_edit" name="fname">
                    </div>
                    <div class="mb-3">
                        <label for="lname_edit" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lname_edit" name="lname">
                    </div>
                    <div class="mb-3">
                        <label for="mn_edit" class="col-form-label">Mobile Number:</label>
                        <input type="text" class="form-control" id="mn_edit" name="mn">
                    </div>
                    <div class="mb-3">
                        <label for="ea_edit" class="col-form-label">Email Address:</label>
                        <input type="text" class="form-control" id="ea_edit" name="ea">
                    </div>
                    <div class="mb-3">
                        <label for="password_edit" class="col-form-label">Password</label>
                        <input type="password" class="form-control" id="password_edit" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="type_edit" class="col-form-label">Type:</label>
                        <select name="fType" id="type_edit" class="form-select" aria-label="Default Select Example"
                            name="t">
                            <?php 
                                $query = "SELECT * FROM FacultyTypes";
                                $query_run = mysqli_query($conn,$query);
                                
                                if ($query_run) {
                                    foreach ($query_run as $row) {
                                        echo "<option value=" . $row['facultyTypeID'] .">" . $row['typeName'] ."</option>";
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


<!-- Form for deleting a row -->
<form action="teacherCRUD/delete.php" id="deleteForm" method="POST">
  <input type="hidden" name="teacherID" id="teacherID_delete">
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
          
            $('#editTeacherModal').modal('show');
            $tr = $(this).closest('tr'); // Fix the typo here: 'closts' to 'closest'
            const data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            
            // Getting values from table from a specifci row where the edit icon was clicked
            const facultyID = data[0];
            const fname = data[1];
            const lname = data[2];
            const mn = data[3];
            const ea = data[4];
            const password = data[5];

          //Assigning values to inputs in the edit modal
          $('#facuiltyID_edit').val(facultyID);
          $('#fname_edit').val(fname);
          $('#lname_edit').val(lname);
          $('#mn_edit').val(mn);
          $('#ea_edit').val(ea);
          $('#password_edit').val(password);
          
               

        });

        $('#datatable').on('click', '.deleteBtn', function(){
          console.log('hi');
          //Get id from table
           $tr = $(this).closest('tr'); // Fix the typo here: 'closts' to 'closest'
            const data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);  

            const teacherID = data[0];
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
              $('#teacherID_delete').val(teacherID);
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
  </body>
</html>