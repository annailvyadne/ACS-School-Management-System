<?php
require('StudentLayout/header.php');
require('StudentLayout/topbar.php');
require('../db/config.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
<?php 
print_r($_POST);
if (isset($yourArray['sectionID'])) {
    $sectionID = $_SESSION['sectionID'];
    $query = "SELECT subject.* FROM subject INNER JOIN class ON subject.subjectID = class.subjectID WHERE class.sectionID = $sectionID";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        foreach ($query_run as $row) {
            echo "<div class='col-xl-3 col-md-6 mb-4'>
                    <a href='studentGrade.php?subjectid=".$row['subjectID']."' class='card-link'>
                        <div class='card border-left-success shadow h-100 py-2'>
                            <div class='card-body'>
                                <div class='row no-gutters align-items-center'>
                                    <div class='col text-center'>
                                        <div class='mt-3'>
                                            <img src='https://img.freepik.com/free-vector/hand-drawn-philippine-people-with-traditional-clothing_23-2149407098.jpg?w=740&t=st=1705808911~exp=1705809511~hmac=cabdb673d697a8f5e975798930c8b4ac546dfd34eecb6f0ada190ff925cbecd9' alt='Subject Image' class='img-fluid' style='max-width: 100%; max-height: 250px;'>
                                            <div class='mt-2'>" .$row['subjectName'] ."</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>";
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
}
?>


<?php
    require('StudentLayout/script.php');
?>