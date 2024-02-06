<?php
require('StudentLayout/header.php');
require('StudentLayout/topbar.php');
?>

<h1 style="font-size: 60px;">Filipino</h1>

<!-- Page Wrapper -->
<div id="wrapper">

<?php
require('StudentLayout/sidebar.php');
?>


<div class="container-fluid">
    <div class="accordion-container">
        <div class="accordion" id="accordionExample">
            <!-- Accordion Item #1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Accordion Item #1
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul class="list-group" style="width: 100%;">
                            <li class="list-group-item">Homework 1</li>
                            <li class="list-group-item">Homework 2</li>
                            <li class="list-group-item">Homework 3</li>
                            <!-- Add more list items if needed -->
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Accordion Item #2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Accordion Item #2
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul class="list-group" style="width: 100%;">
                            <li class="list-group-item">Topic 1 Lesson</li>
                            <li class="list-group-item">Topic 2 Powerpoint</li>
                            <li class="list-group-item">Topic 3 Link</li>
                            <!-- Add more list items if needed -->
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- End of Accordion -->
    </div>
</div>





    </div>
    <!-- End of Page Wrapper -->

    <?php
    require('StudentLayout/script.php');
    ?>
