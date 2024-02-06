<?php 
  require('phpcodes/connection.php');+
  require('layout/header.php');
  require('layout/sidebar.php');
?>
<div class="container">
  <?php 
    require('layout/navbar.php');
  ?>
<div class="content">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="margin-left: 20px; margin-bottom: 2px; background-color: red; border: 0; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.10),0 17px 50px 0 rgba(0,0,0,0.10); ">Add work activity</button>
    <div class="cards">
    </div>
      <div class="content-2">
        <div class="recent-payments">
          <div class="title">
              <h2>Work Activity Records</h2>
          </div>
          <table id="datatable">
            <thead>
              <tr>
                <th>Work Activity ID</th>
                <th>Class ID</th>
                <th>Activity Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Score</th>
                <th>Download</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $query = "SELECT w.*,c.classID FROM workActivity w INNER JOIN class c ON(c.classID = w.class_id)";
              $query_run = mysqli_query($conn, $query);
              
              if($query_run) {
                foreach ($query_run as $row) {
                  echo "
                      <tr>
                          <td>" . $row['id'] . "</td>
                          <td>" . $row['classID'] . "</td>
                          <td>" . $row['actName'] . "</td>
                          <td>" . $row['actDesc'] . "</td>
                          <td>" . $row['dueDate'] . "</td>
                          <td>" . $row['actScore'] . "</td>
                          <td><a href=". substr($row['filePath'],3) ." target='_blank' download><button class='btn btn-outline-primary'>Download</button></a></td>
                          
                          <td>
                              <i style='color:green' class='fi fi-rr-edit editBtn' data-facultyid=''></i>
                              <i style='color:red;' class='fi fi-rr-trash deleteBtn' data-id=".$row['id'] ."></i>
                          </td>
                      </tr>";
              }

              }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Work Activity ID</th>
                <th>Class ID</th>
                <th>Activity Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Score</th>
                <th>Download</th>
                <th>Actions</th>
              </tr>
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
          <h1 class="modal-title fs-5" id="modalHeader">Add Activity</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="workActivityCRUD/create.php" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="col-form-label">Activity title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <div class="invalid-feedback">Title is required.</div>
            </div>
            <div class="mb-3">
                <label for="desc" class="col-form-label">Description</label>
                <textarea name="desc" id="desc" cols="15" rows="4" class="form-control" required></textarea>
                <div class="invalid-feedback">Description is required</div>
            </div>
            <div class="mb-3">
              <label for="classID" class="col-form-label">Class</label>
              <select name="classID" id="classID" class="form-select" aria-label="Default Select Example" required>
                <option value="" selected disabled>Select a class</option>
                  <?php 

                  $query = "SELECT c.*,st.sectionName, st.gradeLevel,s.subjectName FROM class c INNER JOIN subject s ON(s.subjectID = c.subjectID) INNER JOIN sections st ON(st.sectionID = c.sectionID)";
                  $query_run = mysqli_query($conn, $query);
                  if($query_run){
                      foreach ($query_run as $row) {
                      echo "<option value=" . $row['classID'] . ">" . $row['subjectName'] . "-".  $row['sectionName']. "-".$row['gradeLevel'] . "</option>";
                    }
                  }
                  ?>
              </select>
              <div class="invalid-feedback">Class is required</div>
            </div>
            <div class="mb-3">
              <label for="dueDate" class="col-form-label">Due Date </label>
              <input type="date" name="dueDate" id="dueDate" class="form-control" required>
              <div class="invalid-feedback">Due Date is required</div>
            </div>
            <div class="mb-3">
              <label for="score" class="col-form-label">Score</label>
              <input type="number" name="score" id="score" class="form-control" step="1" required oninput="validateNumberInput()" />
              <div class="invalid-feedback">Score is required</div>
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


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalHeader">Edit Activity</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="workActivityCRUD/update.php" class="needs-validation" novalidate enctype="multipart/form-data">
            <input type="hidden" name="id" id="id_edit">
            <div class="mb-3">
                <label for="title" class="col-form-label">Activity Title</label>
                <input type="text" class="form-control" id="title_edit" name="title_edit" required>
                <div class="invalid-feedback">Title is required.</div>
            </div>
            <div class="mb-3">
                <label for="desc" class="col-form-label">Description</label>
                <textarea name="desc_edit" id="desc_edit" cols="15" rows="4" class="form-control" required></textarea>
                <div class="invalid-feedback">Description is required</div>
            </div>
            <div class="mb-3">
              <label for="classID" class="col-form-label">Class</label>
              <select name="classID_edit" id="classID_edit" class="form-select" aria-label="Default Select Example" required>
                <option value="" selected disabled>Select a class</option>
                  <?php 

                  $query = "SELECT c.*,st.sectionName, st.gradeLevel,s.subjectName FROM class c INNER JOIN subject s ON(s.subjectID = c.subjectID) INNER JOIN sections st ON(st.sectionID = c.sectionID)";
                  $query_run = mysqli_query($conn, $query);
                  if($query_run){
                      foreach ($query_run as $row) {
                      echo "<option value=" . $row['classID'] . " data-classid=".$row['classID'].">" . $row['subjectName'] . "-".  $row['sectionName']. "-".$row['gradeLevel'] . "</option>";
                    }
                  }
                  ?>
              </select>
              <div class="invalid-feedback">Class is required</div>
            </div>
            <div class="mb-3">
              <label for="dueDate" class="col-form-label">Due Date </label>
              <input type="date" name="dueDate_edit" id="dueDate_edit" class="form-control" required>
              <div class="invalid-feedback">Due Date is required</div>
            </div>
            <div class="mb-3">
              <label for="score" class="col-form-label">Score</label>
              <input type="number" name="score_edit" id="score_edit" class="form-control" step="1" required oninput="validateNumberInput()" />
              <div class="invalid-feedback">Score is required</div>
            </div>
            <div class="mb-3">
              <label for="score" class="col-form-label">Files</label>
              <input type="file" name="files[]" class="form-control" multiple>
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
<form action="workActivityCRUD/delete.php" id="deleteForm" method="POST">
  <input type="hidden" name="workActivityID_delete" id="workActivityID_delete">
</form>
<?php 
  require('layout/scripts.php');
?>
<script>
  function validateNumberInput() {
    var inputElement = document.getElementById('score');
    var inputValue = inputElement.value;

    // Remove non-numeric characters and decimals using a regular expression
    inputValue = inputValue.replace(/[^0-9]/g, '');

    // Update the input value with the cleaned numeric value
    inputElement.value = inputValue;
}

</script>
    
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
        
        const id = data[0];
        const classID = data[1];
        const title = data[2];
        const description = data[3];
        const dueDate = data[4];
        const score = data[5];

        $('#id_edit').val(id);
        $('#title_edit').val(title);
        $('#desc_edit').val(description);
        $('#classID_edit option').each(function(){
          if($(this).data('classid') == classID){
            $(this).prop('selected', true);
          }
        });
        $('#dueDate_edit').val(dueDate);
        $('#score_edit').val(score);
      });

        $('#datatable').on('click', '.deleteBtn', function(){
        
          //Get id from table
           $tr = $(this).closest('tr'); 
            const data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);  

            //Get the sectionid on the table
            const id = data[0];

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
              $('#workActivityID_delete').val(id);
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