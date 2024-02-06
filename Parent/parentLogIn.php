<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

     <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Meta -->
    <title>Abra De Ilog Central School</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i" rel="stylesheet">

    <!-- Custom & Default Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="style.css">

    <!--[if lt IE 9]>
        <script src="js/vendor/html5shiv.min.js"></script>
        <script src="js/vendor/respond.min.js"></script>
    <![endif]-->

  <style>
    .form-container {
      background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background for the form */
      padding: 20px;
      border-radius: 10px;
      margin: 50px auto;
      max-width: 400px;
    }

    .form-group, .form-check {
      margin-bottom: 15px;
    }

    .form-check-inline {
      margin-right: 10px;
    }
  </style>

  <title>Teacher Log In Form</title>
</head>

<body style="background-image: url('assets/SP1.png'); background-size: cover;">

   <!-- LOADER -->
    <div id="preloader">
        <img class="preloader" src="images/loader.gif" alt="">
    </div><!-- end loader -->
    <!-- END LOADER -->

    <div id="wrapper">
        <!-- BEGIN # MODAL LOGIN -->
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Begin # DIV Form -->
                    <div id="div-forms">
                        <form id="login-form">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="flaticon-add" aria-hidden="true"></span>
                            </button>
                            <div class="modal-body">
                                <input class="form-control" type="text" placeholder="What you are looking for?"
                                    required>
                            </div>
                        </form><!-- End # Login Form -->
                    </div><!-- End # DIV Form -->
                </div>
            </div>
        </div>
        <!-- END # MODAL LOGIN -->
   

<button type="button" class="btn btn-primary" onclick="window.location.href='../main/SchoolPortal.html'" style="margin-top: 25px; margin-left: 25px; border: 2px solid; border-radius: 10px;">Go back</button>



<div class="form-container" style="z-index: 1000; text-align: center;">
    <form action="verify.php" method="post">

        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" style="background-color: white; font-size: 14px;">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="background-color: white; font-size: 14px;">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
    </form>
</div>




<br>
<br>
<br>
<br>
<footer class="section footer noover">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="widget clearfix">
                    <h3 class="widget-title">Subscribe Our Newsletter</h3>
                    <div class="newsletter-widget">
                        <p>You can opt out of our newsletters at any time.<br></p>
                        <form class="form-inline" role="search">
                            <div class="form-1">
                                <input type="text" class="form-control" placeholder="Enter email here..">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa fa-paper-plane-o"></i></button>
                            </div>
                        </form>
                    </div><!-- end newsletter -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-3 col-md-3">
                <div class="widget clearfix">
                    <h3 class="widget-title">Popular Tags</h3>
                    <div class="tags-widget">
                        <ul class="list-inline">
                            <li><a href="#">Abra De Ilog Central School</a></li>
                            <li><a href="#">Subjects</a></li>
                            <li><a href="#">Elementary</a></li>
                            <li><a href="#">High School</a></li>
                            <li><a href="#">Faculty</a></li>
                            <li><a href="#">Facilities</a></li>
                            <li><a href="#">Equipment</a></li>
                            <li><a href="#">Knowledge</a></li>
                            <li><a href="#">Learnings</a></li>
                            <li><a href="#">Formation</a></li>
                        </ul>
                    </div><!-- end list-widget -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-2 col-md-2">
                <div class="widget clearfix">
                    <h3 class="widget-title">Website</h3>
                    <div class="list-widget">
                        <ul>
                            <li><a href="homepage.html">Home</a></li>
                            <li><a href="aboutpage.html">About Us</a></li>
                            <li><a href="Admissions.html">Admissions</a></li>
                            <li><a href="Academics.html">Academics</a></li>
                            <li><a href="SchoolPortal.html">School Portal</a></li>
                            <li><a href="events.html">Events</a></li>
                            <li><a href="page-contact.html">Contact Us</a></li>
                        </ul>
                    </div><!-- end list-widget -->
                </div><!-- end widget -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</footer><!-- end footer -->

<div class="copyrights">
    <div class="container">
        <div class="clearfix">
            <div class="pull-left">
                <!--"EDULOGY" Logo is an inserted image -->
                <div class="cop-logo">
                    <a href="#"><img src="Logo.png" alt=""></a>
                </div>
            </div>

            <div class="pull-right">
                <div class="footer-links">
                    <ul class="list-inline">
                        <li>©2024 by Latvia Group</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- end container -->
</div><!-- end copy -->
</div><!-- end wrapper -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <!-- jQuery Files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/parallax.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
<!-- VIDEO BG PLUGINS -->
<script src="js/videobg.js"></script>

</body>
</html>
