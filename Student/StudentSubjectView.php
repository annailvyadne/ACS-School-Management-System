<?php
require('StudentLayout/header.php');
require('StudentLayout/topbar.php');
?>

<h1 style="font-size: 60px; background-color: #808080; color: white; padding: 10px;">Filipino</h1>


<!-- Page Wrapper -->
<div id="wrapper">

<?php
require('StudentLayout/sidebar.php');
?>


   <!-- Rectangle Shape as a Container -->
    <div style="width: 1100px; height: 600px; background-color: #d3d3d3; margin: 20px; padding: 10px;">

<table class="table">
  <thead>
    <tr>
      <th scope="col">HOMEWORK</th>
      <th scope="col">DUEDATE</th>
      <th scope="col">STATUS</th>
      <th scope="col">GRADE</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>






    </div>
    <!-- End of Page Wrapper -->

    <?php
    require('StudentLayout/script.php');
    ?>

