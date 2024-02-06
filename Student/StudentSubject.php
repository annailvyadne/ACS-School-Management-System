<?php
require('StudentLayout/header.php');
require('StudentLayout/topbar.php');
require('../db/config.php');
$subjectID = $_GET['subjectid'];
// print_r($_GET);
print_r($_SESSION);
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
            <div class="accordion" id="accordionExample">

                <?php
                $query = "SELECT * FROM workActivity w INNER JOIN class c ON c.classID = w.class_id WHERE c.subjectID = ?";
                $stmt = mysqli_prepare($conn, $query);
                $stmt->bind_param("i", $subjectID);
                $stmt->execute();
                $result = $stmt->get_result(); // Get the result set from the prepared statement

                // Assuming you have already fetched data from the database and stored it in $result
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='accordion-item'>
                        <h2 class='accordion-header' id='heading{$row['id']}'>
                            <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse{$row['id']}' aria-expanded='true' aria-controls='collapse{$row['id']}'>
                                {$row['actName']}
                            </button>
                            <form action=>

                            </form>
                        </h2>
                        <div id='collapse{$row['id']}' class='accordion-collapse collapse show' aria-labelledby='heading{$row['id']}' data-bs-parent='#accordionExample'>
                            <div class='accordion-body d-flex justify-content-between'>
                                {$row['actDesc']}
                                <a href=" . $row['filePath'] . "><button class='btn btn-outline-primary'>Download</button></a>
                            </div>
                        </div>
                    </div>";
                }
                ?>
                <!-- Accordion Item #1 -->

            </div> <!-- End of Accordion -->
        </div>
    </div>





</div>
<!-- End of Page Wrapper -->

<?php
require('StudentLayout/script.php');
?>