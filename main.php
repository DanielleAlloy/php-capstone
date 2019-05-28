<?php
//I certify that this submission is my own original work Danielle Hyland R01852274
session_start();
require_once 'functions.php';
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}

?>
<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!--Bootstrap CSS-->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <!--MDB CSS-->
    <link rel='stylesheet' href='css/mdb.css' >
    <!--Custom CSS-->
    <link rel='stylesheet' href='css/style.css' >
    <title>Main Menu</title>
</head>
<header>
    <!--NavBar-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark purple-gradient scrolling-navbar">
        <a class="navbar-brand" href="main.php"><strong>Cameras</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="main.php">Main Menu<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list.php">List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add.php">Add</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="delete.php">Delete</a>
                </li>
            </ul>
            <div class="form-inline my-2 ml-lg-2">
                <form method='post' action='logOut.php' onsubmit='return true'>
                    <button type="submit" class="btn btn-success ">Log Out</button>
                </form>
            </div>
        </div>
    </nav>
</header>

    <body>

    <div class="container">
        <!-- Card deck -->
        <div class="card-deck">
            <!-- List Card -->

            <!-- Card -->
            <div class="card mb-4">

                <!--Card image-->
                <div class="view overlay">
                    <img class="card-img-top" src="images/view.jpg" alt="List Cameras">
                    <a href="list.php">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <!--Card content-->
                <div class="card-body">

                    <!--Title-->
                    <h4 class="card-title">List Cameras</h4>
                    <!--Text-->
                    <p class="card-text">View a list of all the cameras in the database</p>
                    <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                    <a href="list.php" class="btn btn-light-blue btn-md">List Cameras</a>

                </div>

            </div>
            <!-- Card -->

            <!-- Add Card -->
            <div class="card mb-4">

                <!--Card image-->
                <div class="view overlay">
                    <img class="card-img-top" src="images/add.jpg" alt="Add Camera">
                    <a href="add.php">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <!--Card content-->
                <div class="card-body">

                    <!--Title-->
                    <h4 class="card-title">Add Camera to the Database</h4>
                    <!--Text-->
                    <p class="card-text">Displays a form which will add that information to the database</p>
                    <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                    <a href="add.php" class="btn btn-light-blue btn-md">Add Camera</a>

                </div>

            </div>
        </div>
        <div class="card-deck">

            <!-- Search Card -->
            <div class="card mb-4">

                <!--Card image-->
                <div class="view overlay">
                    <img class="card-img-top" src="images/search.jpg" alt="search camera records">
                    <a href="search.php">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <!--Card content-->
                <div class="card-body">

                    <!--Title-->
                    <h4 class="card-title">Search Camera Records</h4>
                    <!--Text-->
                    <p class="card-text">Search the camera database using different search variables.</p>
                    <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                    <a href="search.php" class="btn btn-light-blue btn-md">Search Cameras</a>

                </div>

            </div>



            <!-- Delete Card -->
            <div class="card mb-4">

                <!--Card image-->
                <div class="view overlay">
                    <img class="card-img-top" src="images/delete.jpg" alt="Delete Camera Records">
                    <a href="delete.php">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <!--Card content-->
                <div class="card-body">

                    <!--Title-->
                    <h4 class="card-title">Delete Camera Records</h4>
                    <!--Text-->
                    <p class="card-text">View all the records in the camera database and delete them.</p>
                    <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                    <a href="delete.php" class="btn btn-light-blue btn-md">Delete Records</a>

                </div>

            </div>
            <!-- Card -->


        </div>
        <!-- Card deck -->
        <!-- Card Regular -->
    </div>

        <!-- Optional JavaScript -->
        <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>

    </body>
</html>
