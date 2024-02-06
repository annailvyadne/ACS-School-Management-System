<?php
require('phpcodes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <title>ACS Admin Dashboard</title>
  </head>
  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="#"
          >ACS</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
            <div class="input-group">
              <input
                class="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle ms-2"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-person-fill"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="../main/SchoolPortal.php">Logout</a></li>

              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->

    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="admin.php" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <a href="student.php" class="nav-link px-3">
                <span class="me-2"><i class="fi fi-rr-graduation-cap"></i></span>
                <span>Students</span>
              </a>
            </li>
            <li>
              <a href="teacher.php" class="nav-link px-3">
                <span class="me-2"><i class="fi fi-rr-users-alt"></i></span>
                <span>Teachers</span>
              </a>
            </li>
            <li>
              <a href="parent.php" class="nav-link px-3">
                <span class="me-2"><i class="i fi-rr-users"></i></span>
                <span>Parents</span>
              </a>
            </li>
            <li>
              <a href="sections.php" class="nav-link px-3">
                <span class="me-2"><i class="fi fi-rr-edit-alt"></i></span>
                <span>Sections</span>
              </a>
            </li>
            <li>
              <a href="subjects.php" class="nav-link px-3">
                <span class="me-2"><i class="fi fi-rr-book-open-cover"></i></span>
                <span>Subjects</span>
              </a>
            </li>
            <li>
              <a href="class.php" class="nav-link px-3">
                <span class="me-2"><i class="fi fi-rr-add-document"></i></span>
                <span>Classes</span>
              </a>
            </li>
            <li>
              <a href="materials.php" class="nav-link px-3">
                <span class="me-2"><i class="fi fi-rr-layout-fluid"></i></span>
                <span>Materials</span>
              </a>
            </li>
            <li>
              <a href="activity.php" class="nav-link px-3">
                <span class="me-2"><i class="fi fi-rr-pencil"></i></span>
                <span>Activities</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4 style="font-size: 36px; font-weight: bold;">Dashboard</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
              <div class="card-body py-5" style="font-size: 28px;">Students</div>
                <?php
                    //include('phpcodes/totalstudents.php');
                         
                   $query = "SELECT COUNT(studentID) AS TOT FROM students;";
                  $query_run = mysqli_query($conn,$query);
                            if($query_run){
                                foreach($query_run as $row){
                                    echo "<h1 style='color: white; padding-left: 20px;'>" . $row['TOT'] . "</h1>";
                                }
                            }
                    
                 ?>
              <a href='studentrecords.php'>
              <div class="card-footer d-flex">
                
                <a href="student.php" style="color: white; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='lightgray';" onmouseout="this.style.color='white';">View Details</a>
                <span class="ms-auto">
                </span></a>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark h-100">
              <div class="card-body py-5" style="font-size: 28px; color: white;">Teachers</div>
              <?php
                $query = "SELECT COUNT(facultyID) AS TOT FROM faculty;";
                $query_run = mysqli_query($conn,$query);
                            if($query_run){
                                foreach($query_run as $row){
                                    echo "<h1 style='color: white; padding-left: 20px;'>" . $row['TOT'] . "</h1>";
                                }
                            }
                ?>
              <div class="card-footer d-flex">
                <a href="teacher.php" style="color: white; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='lightgray';" onmouseout="this.style.color='white';">View Details</a>
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5" style="font-size: 28px;">Parents</div>
                        <?php
                            //include('phpcodes/totalparents.php');
                          $query = "SELECT COUNT(parentID) AS TOT FROM parents;";
                          $query_run = mysqli_query($conn,$query);
                            if($query_run){
                                foreach($query_run as $row){
                                    echo "<h1 style='color: white; padding-left: 20px;'>" . $row['TOT'] . "</h1>";
                                }
                            }
                        ?>
              <div class="card-footer d-flex">
                <a href="parent.php" style="color: white; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='lightgray';" onmouseout="this.style.color='white';">View Details</a>
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100">
              <div class="card-body py-5" style="font-size: 28px;">Sections</div>
              <?php
                $query = "SELECT COUNT(sectionID) AS TOT FROM sections;";
                $query_run = mysqli_query($conn,$query);
                            if($query_run){
                                foreach($query_run as $row){
                                    echo "<h1 style='color: white; padding-left: 20px;'>" . $row['TOT'] . "</h1>";
                                }
                            }
                ?>


              <div class="card-footer d-flex">
                <a href="sections.php" style="color: white; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='lightgray';" onmouseout="this.style.color='white';">View Details</a>
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Faculty Members
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                                      <thead>
                        <tr>
                            <th>Faculty ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile Number</th>
                            <th>Email Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT faculty.*, facultyTypes.typeName FROM faculty INNER JOIN facultyTypes ON FacultyTypes.facultyTypeID = faculty.facultyTypeID";
                            $query_run = mysqli_query($conn, $query);

                            if ($query_run) {
                                foreach ($query_run as $row) {
                                    echo "
                                        <tr>
                                            <td>" . $row['facultyID'] . "</td>
                                            <td>" . $row['facultyFirstName'] . "</td>
                                            <td>" . $row['facultyLastName'] . "</td>
                                            <td>" . $row['facultyMobileNo'] . "</td>
                                            <td>" . $row['facultyEmailAdd'] . "</td>
                                            <td>
                                                <i style='color:green' class='fi fi-rr-edit editBtn'></i>
                                                <i style='color:red;' class='fi fi-rr-trash deleteBtn'></i>
                                            </td>
                                        </tr>
                                    ";
                                }
                            }
                        ?>
                    </tbody>
                    <tfoot>
                      <th>Faculty ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Mobile Number</th>
                      <th>Email Address</th>
                      <th>Actions</th>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
