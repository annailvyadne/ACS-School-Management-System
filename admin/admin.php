<?php 
    require('layout/header.php');
    require('layout/sidebar.php');
?>
 <body>
 <div class="container">
      <?php 
        require('layout/navbar.php');
      ?>
        <div class="content">
            <div class="cards">
                <div class="card">
                    <div class="box">
                        <?php
                            include('phpcodes/totalstudents.php');
                        ?>
                        <h3>Students</h3>
                    </div>
                    <div class="icon-case">
                        <img src="students.png" alt=""> <!--logo-->
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1>53</h1>
                        <h3>Teachers</h3>
                    </div>
                    <div class="icon-case">
                        <img src="teachers.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <?php
                            include('phpcodes/totalparents.php');
                        ?>
                        <h3>Parents</h3>
                    </div>
                    <div class="icon-case">
                        <img src="schools.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <?php 
                            $query = "SELECT COUNT(DISTINCT subjectName) as tot FROM subject";
                            $query_run = mysqli_query($conn,$query);
                            if($query_run){
                                foreach($query_run as $row){
                                    echo "<h1>" . $row['tot'] . "</h1>";
                                }
                            }
                        ?>
                        
                        <h3>Subjects</h3>
                    </div>
                    <div class="icon-case">
                        <img src="income.png" alt="">
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Recent Payments</h2>
                        <a href="#" class="btn">View All</a>
                    </div>
                    <table>
                        <?php
                            include('phpcodes/paneltable1.php');
                        ?>
                    </table>
                </div>
                <div class="new-students">
                    <div class="title">
                        <h2>New Students</h2>
                        <a href="#" class="btn">View All</a>
                    </div>
                    <table>
                        <?php
                            include('phpcodes/paneltable2.php');
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const logoutBtn = document.getElementById('logoutBtn');
        logoutBtn.addEventListener('click', function(){
            console.log('hi');
        });
    });
</script>
</body>
</html>