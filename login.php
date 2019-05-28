<?php
//I certify that this submission is my own original work Danielle Hyland R01852274
 session_start();
 require_once 'functions.php';

 if(!isset($_SESSION['user'])){
     echo <<<END

END;


 }else{echo htmlspecialchars("You already logged in as ". $_SESSION['username']);
 }


if (isset($_POST['username']) &&
    isset($_POST['password']))
{
    if (!empty($_POST['username']) &&
        !empty($_POST['password']))
    {
        $user = sanitizeMySQL($conn, $_POST['username']);
        $pw = sanitizeMySQL($conn, $_POST['password']);

        $query   = "SELECT * FROM users WHERE username='$user'";
        $result  = $conn->query($query);

        if (!$result) die("User not found");
        elseif ($result->num_rows)
        {
            $row = $result->fetch_array(MYSQLI_NUM);

            $result->close();

            if (password_verify($pw, $row[2]))
            {
                //session_start();
                $_SESSION['username'] = $row[0];
                $_SESSION['email']  = $row[1];
                //header("Location:main.php");
                echo htmlspecialchars("You are now logged in as ". $_SESSION['username']);

                echo "<br><a href='main.php'>Click here to continue to main menu</a>";

            }else die("Invalid username/password combination. <a href='login.php'>Click here to login again</a>");
        }
    }else echo"Please enter a username and password";
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
    <title>Log In to View to Camera Database</title>
</head>
<header>
    <!--NavBar-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark purple-gradient scrolling-navbar">
        <a class="navbar-brand" href="main.php"><strong>Cameras</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php  if(isset($_SESSION['user'])) {
            echo "
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
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
            </ul>
            <div class='form-inline my-2 ml-lg-2'>
                <form method='post' action='logOut.php' onsubmit='return true'>
                    <button type='submit' class='btn btn-success '>Log Out</button>
                </form>
            </div>
        </div>";
            }?>
    </nav>
</header>
<body>
<div class="container">
    <h1>Log In:</h1>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" id="username" >
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" >
        </div>
        <button type="submit" class="btn btn-pink">Log In</button>
    </form>
</div>
<!-- Optional JavaScript -->
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
</body>
</html>
