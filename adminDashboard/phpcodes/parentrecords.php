<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin Parent Records</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Brand</h1>
        </div>
        <ul>
            <li><span><a href="admin.php">Dashboard</a></span></li>
            <li><span><a href="studentrecords.php">Students</a></span></li>
            <li><span><a href="teacherrecords.php">Teachers</a></span></li>
            <li><span><a href="parentrecords.php">Parents</a></span></li>
            <li><span><a href="income_link.php">Income</a></span></li>
            <li><span><a href="settings_link.php">Settings</a></span></li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="search">
                    <input type="text" placeholder="Search..">
                    <button type="submit"><img src="search.png" alt=""></button>
                </div>
                <div class="user">
                    <a href="addparent.php#" class="btn">Add New</a>
                    <img src="notifications.png" alt="">
                    <div class="img-case">
                        <img src="user.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="cards">
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Parent Records</h2>
                    </div>
                    <table>
                        <?php
                            include("phpcodes/parenttable.php");
                        ?>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>