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
    <title>Search for Record in Camera Database</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="main.php">Main Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list.php">List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add.php">Add</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="search.php">Search<span class="sr-only">(current)</span></a>
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
    <h1>Search for Record:</h1>
    <form action="search.php" method="post">
        <div class="form-group">
            <label for="searchText">Search Text:</label>
            <input type="text" class="form-control" name="searchText" id="searchText" placeholder="Search Text" >
        </div>
        <div class="form-group">
            <label for="searchBy">Search By:</label>
            <select class="form-control" id="searchBy" name="searchBy">
                <option>ID Number</option>
                <option>Brand</option>
                <option>Model</option>
                <option>Megapixels</option>
                <option>Focus Points</option>
                <option>Sensor Format</option>
            </select>
        </div>
        <button type="submit" class="btn btn-pink">Search</button>
    </form>
    <h1>Search Results</h1>
    <table class="table table-dark table-hover table-responsive">
        <thead class="thead-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Brand</th>
            <th scope="col">Model</th>
            <th scope="col">Megapixels</th>
            <th scope="col">Focus Points</th>
            <th scope="col">Sensor Format</th>
            <th scope="col">Description</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if(!empty($_POST['searchText'])){
            //Sanitizes user data
            $searchText = sanitizeMySQL($conn, $_POST['searchText']);
            $searchBy = sanitizeMySQL($conn, $_POST['searchBy']);

            if ($searchBy =="ID Number"){
                $searchBy = "id";
            }

            if ($searchBy =="Focus Points"){
                $searchBy = "focusPoints";
            }

            if ($searchBy =="Megapixels"){
                $searchBy = "MP";
            }

            if ($searchBy =="Sensor Format"){
                $searchBy = "sensorFormat";
            }

            $query = "SELECT * FROM cameras WHERE $searchBy='$searchText'";
            $result = $conn->query($query);
            if (!$result) die ("Database access failed");

        }

        $rows = $result->num_rows;
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            $row = $result->fetch_array(MYSQLI_NUM);
            echo "<tr>";
            for ($k = 0 ; $k < 7; ++$k)
                echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<!-- Optional JavaScript -->
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
</body>
</html>
