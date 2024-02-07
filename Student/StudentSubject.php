<?php
require('StudentLayout/header.php');
require('StudentLayout/topbar.php');
require('../db/config.php');


if (isset($_GET['subjectid'])) {
    $subjectID  = $_GET['subjectid'];
    $_SESSION['subjectid'] = $subjectID;
} else {
    $subjectID = $_SESSION['subjectid'];
}
// print_r($_GET);
$classID = $_SESSION['classID'];


$studentID = $_SESSION['studentID'];
$query = "SELECT subjectName FROM subject WHERE subjectID = ?";
$stmt = mysqli_prepare($conn, $query);
$stmt->bind_param("i", $subjectID);
$stmt->execute();
$stmt->bind_result($subjName);
$stmt->fetch(); // Fetch the result into bound variables
$stmt->close();
?>

<h1 style="font-size: 60px;"><?php echo $subjName; ?></h1>

<!-- Page Wrapper -->
<div id="wrapper">

    <?php
    require('StudentLayout/sidebar.php');
    ?>


    <div class="container-fluid">
        <div class="accordion-container">
            <h1>Work Activities</h1>
            <div class="accordion" id="accordionExample">

                <?php
                $query = "SELECT * FROM workActivity w INNER JOIN class c ON c.classID = w.class_id WHERE c.subjectID = ?";
                $stmt = mysqli_prepare($conn, $query);
                $stmt->bind_param("i", $subjectID);
                $stmt->execute();
                $result = $stmt->get_result(); // Get the result set from the prepared statement        
                $stmt->close();
                // Assuming you have already fetched data from the database and stored it in $result
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='accordion-item'>
        <h2 class='accordion-header' id='heading{$row['id']}'>
            <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse{$row['id']}' aria-expanded='true' aria-controls='collapse{$row['id']}'>
                {$row['actName']}
            </button>
        </h2>
        <div id='collapse{$row['id']}' class='accordion-collapse collapse show' aria-labelledby='heading{$row['id']}' data-bs-parent='#accordionExample'>
            <div class='accordion-body d-flex justify-content-between'>
                {$row['actDesc']}
                <form action='submit.php' method='post' enctype='multipart/form-data' class='needs-validation' novalidate>
                    <input type='hidden' name='workActivityID' value='" . $row['id'] . "'>
                    <input type='hidden' name='studID' value='" . $studentID . "'>
                    <label for='File Submission'>File Submission</label>
                    <input type='file' name='workA' class='form-control' required>
                    <div class='invalid-feedback'>File is required</div>
                    <button type='submit' class='btn btn-outline-primary mt-2'>Submit</button>

                </form>";

                    if ($row['filePath'] == '') {
                        echo "<button class='btn btn-outline-secondary' disabled>Download</button>";
                    } else {
                        echo "<a href='" . $row['filePath'] . "'><button class='btn btn-outline-primary'>Download</button></a>";
                    }

                    echo "</div>
      </div>
    </div>";
                }
                ?>


            </div> <!-- End of Accordion -->
        </div>
        <h1 class="mt-5">Learning Materials</h1>
        <div class="accordion-container">
            <div class="accordion" id="accordionExample">
                <?php
                $query = "SELECT * FROM learningmaterials WHERE class_ID = ?";
                $stmt = mysqli_prepare($conn, $query);
                $stmt->bind_param("i", $classID);
                $stmt->execute();
                $result = $stmt->get_result(); // Get the result set from the prepared statement

                // Assuming you have already fetched data from the database and stored it in $result
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='accordion-item'>
        <h2 class='accordion-header' id='heading{$row['id']}'>
            <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse{$row['id']}' aria-expanded='true' aria-controls='collapse{$row['id']}'>
                {$row['title']}
            </button>
        </h2>
        <div id='collapse{$row['id']}' class='accordion-collapse collapse show' aria-labelledby='heading{$row['id']}' data-bs-parent='#accordionExample'>
            <div class='accordion-body d-flex justify-content-between'>";

                    if ($row['filePath'] == '') {
                        echo "<button class='btn btn-outline-secondary' disabled>Download</button>";
                    } else {
                        echo "<a href='" . substr($row['filePath'], 3) . "' download ><button class='btn btn-outline-primary'>Download</button></a>";
                    }
                    echo "      
                    
                    </div>
                </div>
            </div>";
                }
                ?>


            </div>
        </div>
        <!-- End of Page Wrapper -->

        <?php
        require('StudentLayout/script.php');
        ?>