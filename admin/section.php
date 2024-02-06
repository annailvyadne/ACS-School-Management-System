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
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="margin-left: 20px; margin-bottom: 2px; background-color: red; border: 0; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.10),0 17px 50px 0 rgba(0,0,0,0.10); ">Add Section</button>
    <div class="cards">
    </div>
      <div class="content-2">
        <div class="recent-payments">
          <div class="title">
              <h2>Section Records</h2>
          </div>
          <table id="datatable">
            <thead>
              <tr>
                <th>Section ID</th>
                <th>Section Name</th>
                <th>Grade Level</td>
                <th>Faculty Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $query = "SELECT sections.*, faculty.facultyid ,concat(faculty.facultyFirstname,faculty.facultyLastName) as facultyName FROM sections
              INNER JOIN faculty ON faculty.facultyID = sections.facultyID";
              $query_run = mysqli_query($conn, $query);
              
              if($query_run) {
                foreach ($query_run as $row) {
                  echo "
                      <tr>
                          <td>" . $row['sectionID'] . "</td>
                          <td>" . $row['sectionName'] . "</td>
                          <td>" . $row['gradelevel'] . "</td>
                          <td>" . $row['facultyName'] . "</td>
                          <td>
                              <i style='color:green' class='fi fi-rr-edit editBtn' data-facultyid='" . $row['facultyID'] . "'></i>
                              <i style='color:red;' class='fi fi-rr-trash deleteBtn'></i>
                          </td>
                      </tr>";
              }

              }
              ?>
            </tbody>
            <tfoot>
            <th>Section ID</th>
                <th>Section Name</th>
                <th>Grade Level</td>
                <th>Faculty Name</th>
                <th>Actions</th>
            </tfoot>
          </table>
      </div>
    </div>
  </div>
</div>


    
<!--create modal-->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHeader">Create Section</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="sectionCRUD/create.php" novalidate class="needs-validation">
                    <div class="mb-3">
                        <label for="sectionname" class="col-form-label">Section Name:</label>
                        <input type="text" class="form-control" id="sectionname" name="sectionname" required>
                        <div class="invalid-feedback">Section name is required</div>
                    </div>
    <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Faculty Name</label>
    <select name="facultyID" class="form-select" aria-label="Default Select Example" required>
        <?php 

        $query = "SELECT * FROM faculty";
        $query_run = mysqli_query($conn, $query);
        if($query_run){
            foreach ($query_run as $row) {
            echo "<option value=" . $row['facultyID'] . ">" . $row['facultyFirstName'] . " ".  $row['facultyLastName']  . "</option>";
          }
        }
      
        ?>
    </select>
    <div class="invalid-feedback">Faculty name is required</div>
</div>

    <div class="mb-3">
    <label for="recipient-name" class="col-form-label" required>Grade Level</label>
    <select name="gradelvl" class="form-select" aria-label="Default Select Example">
        <?php 
        // Assuming the grade levels are predefined
        $gradeLevels = array(0, 1, 2, 3, 4, 5, 6);

        foreach ($gradeLevels as $grade) {
            echo "<option value=" . $grade . ">" . $grade . "</option>";
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
        <div class="invalid-feedback">Grade level is required</div>
    </div>
</div>



<!-- Edit modal -->
<div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHeader">Edit Section</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="sectionCRUD/update.php">
                    
                    <input type="hidden" name="sectionIDedit" id="sectionIDedit">
                    <div class="mb-3">
                        <label for="sectionEdit" class="col-form-label">Section Name:</label>
                        <input type="text" class="form-control" id="sectionEdit" name="sectionEdit">
                    </div>
                   <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Faculty Name</label>
    <select name="facultyID_edit" id="facultyID_edit" class="form-select" aria-label="Default Select Example">
        <?php 

        $query = "SELECT * FROM faculty";
        $query_run = mysqli_query($conn, $query);
        if($query_run){
            foreach ($query_run as $row) {
            echo "<option value=" . $row['facultyID'] . " data-facultyid=".$row['facultyID'].">" . $row['facultyFirstName'] . " ".  $row['facultyLastName']  . "</option>";
          }
        }
      
        ?>
    </select>
</div>
    <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Grade Level</label>
    <select name="gradeLvl_edit" id="gradeLvl_edit" class="form-select" aria-label="Default Select Example">
        <?php 
        // Assuming the grade levels are predefined
        $gradeLevels = array(0, 1, 2, 3, 4, 5, 6);

       foreach ($gradeLevels as $grade) {
    echo "<option value=" . $grade . " data-grd=" . $grade . ">" . $grade . "</option>";
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
<form action="sectionCRUD/delete.php" id="deleteForm" method="POST">
  <input type="hidden" name="sectionID_delete" id="sectionID_delete">
</form>


<?php
require('layout/scripts.php');
?>
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
        const sectionID = data[0];
        const sectionName = data[1];

        //yong data ay galing sa editbtn may data attribute siya
        const facultyID = $(this).data("facultyid");
       
        //nasa table lang to check mo console at index 2 yon
        const gradeLvl = data[2];
        console.log(gradeLvl);
        //Diba may input sa edit modal kunin mo id nila at ilagay yong mga values na meron na tayo ngayon
        $('#sectionEdit').val(sectionName);
        $('#sectionIDedit').val(sectionID);
        //Ang laman ng facultyID variable ay yong id nung teacher kung saang row yong clinick. After nun ichecheck yong data attribute ng
        // lahat ng option after nun kapag may match yon yong iseselect
        $('#facultyID_edit option').each(function () {
            if ($(this).data('facultyid') === facultyID) {
              $(this).prop('selected', true);
            }
        });

        $('#gradeLvl_edit option').each(function () {
            if ($(this).data('grd') == gradeLvl) {
              $(this).prop('selected', true);
            } else {
              console.log('mali');
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
            const sectionID = data[0];

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
              $('#sectionID_delete').val(sectionID);
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