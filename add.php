<?php
//I certify that this submission is my own original work Danielle Hyland R10852274
session_start();
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
        <title>Add Record to Camera Database</title>
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
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="main.php">Main Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list.php">List</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="add.php">Add<span class="sr-only">(current)</span></a>
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
<?php
require_once 'functions.php';



if (isset($_POST['id']) &&
    isset($_POST['brand'])    &&
    isset($_POST['model']) &&
    isset($_POST['mp'])     &&
    isset($_POST['focusPoints']) &&
    isset($_POST['sensorFormat']))
    {
        //if the records are not empty then continue
        if (!empty($_POST['id']) &&
            !empty($_POST['brand'])    &&
            !empty($_POST['model']) &&
            !empty($_POST['mp'])     &&
            !empty($_POST['focusPoints']) &&
            !empty($_POST['sensorFormat']))
        {
            //Sanitize variables
            $id = sanitizeMySQL($conn, $_POST['id']);
            $brand = sanitizeMySQL($conn, $_POST['brand']);
            $model = sanitizeMySQL($conn, $_POST['model']);
            $mp = sanitizeMySQL($conn, $_POST['mp']);
            $focusPoints = sanitizeMySQL($conn, $_POST['focusPoints']);
            $sensorFormat = sanitizeMySQL($conn, $_POST['sensorFormat']);
            $description = sanitizeMySQL($conn, $_POST['description']);

            //Insert into cameras
            add_record($conn, $id, $brand, $model, $mp, $focusPoints, $sensorFormat, $description);
        }else echo "<div class='container'><h1>All records were not entered please enter all values</h1></div>";
    }
?>
    <div class="container">
        <h1>Add Record</h1>
            <form action="add.php" method="post">
              <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" class="form-control" name="id" id="id" placeholder="Unique ID Number" >
              </div>
              <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" name="brand" id="brand" placeholder="ex. Nikon, Canon, Sony, etc." >
              </div>
              <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" name="model" id="model" placeholder="ex. D600, D4, 5D Mark III" >
              </div>
              <div class="form-group">
                <label for="mp">Megapixels:</label>
                <input type="text" class="form-control" name="mp" id="mp" placeholder="ex. 13.5, 20.0, 24.3" >
              </div>
              <div class="form-group">
                <label for="focusPoints">Number of Focus Points:</label>
                <input type="text" class="form-control" name="focusPoints" id="focusPoints" placeholder="ex. 9, 11, 39, 51" >
              </div>
              <div class="form-group">
                <label for="sensorFormat">Sensor Format:</label>
                <input type="text" class="form-control" name="sensorFormat" id="sensorFormat" placeholder="ex. FX, DX, Mirrorless" >
              </div>
              <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="ex. This is the best Nikon Full-Frame camera in the world">
              </div>
              <button type="submit" class="btn btn-pink">Add Record</button>
            </form>
    </div>

    <!-- Optional JavaScript -->
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
    </body>
</html>
