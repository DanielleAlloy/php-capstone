<?php
//I certify that this submission is my own original work Danielle Hyland R01852274
session_start();
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Camera Database</title>

    <!--Bootstrap CSS-->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <!--MDB CSS-->
    <link rel='stylesheet' href='css/mdb.css' >
    <!--Custom CSS-->
    <link rel='stylesheet' href='css/style.css' >
</head>
<body>
<header>
    <!--NavBar-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark purple-gradient scrolling-navbar">
        <a class="navbar-brand" href="main.php"><strong>Cameras</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
                <?php  if(isset($_SESSION['user'])) {
                    echo "
                <li class='nav-item'>
                <a class='nav-link' href='main.php'>Main Menu</a>
                </li>
                <li class='nav-item active'>
                    <a class='nav-link' href='list.php'>List<span class='sr-only'>(current)</span></a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='add.php'>Add</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='search.php'>Search</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='delete.php'>Delete</a>
                </li>
                ";
                }?>
            </ul>
            <div class='form-inline my-2 ml-lg-2'>
                <form method='post' action='register.php' onsubmit='return true'>
                    <button type='submit' class='btn btn-success '>Register</button>
                </form>
                <div class='form-inline my-2 ml-lg-2'>
                    <form method='post' action='login.php' onsubmit='return true'>
                        <button type='submit' class='btn btn-success '>Log In</button>
                    </form>
                </div>
            </div>
    </nav>
</header>
<div class="view" style="background-image: url('images/camera.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <div class="mask flex-center rgba-black-strong">


        <div class="container text-center">
            <div class="row">
                <div class="col">
                <h1 class="white-text">Welcome to the Camera Database Site</h1>
                </div>
            </div>
            <div class="row">
                <div class="col"><a href="register.php" class="btn btn-deep-purple  lighten-1 float-right">Register</a> </div>
                <div class="col "><a href="login.php" class="btn btn-pink pink lighten-1 float-left">Log In</a> </div>
            </div>

            </div>
        </div>

    </div>

    </div>

</body>

</html>