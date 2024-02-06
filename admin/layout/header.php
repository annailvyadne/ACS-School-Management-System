<?php 
    require('../db/config.php');
    session_start();
    if (!isset($_SESSION['facultyID'])) {
        header('location: ../Teacher/TeacherLogIn.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Admin Dashboard</title>
    <body>
    <style>
        .nav{
            display: flex;
            flex-direction: row-reverse;
        }
        a {
            color: white;
            text-decoration: none;
        }
        .links a:hover {
    color: red;

}
    </style>
</head>
<body>


