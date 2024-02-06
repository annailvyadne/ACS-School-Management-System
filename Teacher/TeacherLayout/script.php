<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  new DataTable('#datatablegrade');
</script>

<script>
  // Add click event listeners to the table cells
  document.getElementById('homework1Row').addEventListener('click', function () {
    $('#homework1Modal').modal('show');
  });

  document.getElementById('homework2Row').addEventListener('click', function () {
    $('#homework2Modal').modal('show');
  });

  // Add more event listeners as needed for other rows
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
  $('#logoutBtn').on('click', function(){
    Swal.fire({
      title: "Do you want to logout?",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Yes",
      denyButtonText: "No"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'logout.php', // Replace with the actual path to your server-side script
          type: 'POST',
          data: { action: 'logout' },
          success: function(response) {
            // Redirect to another page after successful logout
            window.location.href = "teacherLogin.php";
          },
          error: function() {
            Swal.fire("Error during logout", "", "error");
          }
        });
      } else if (result.isDenied) {
        Swal.fire("Changes are not saved", "", "info");
      }
    });
  })
</script>

</body>
</html>

