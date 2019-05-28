<!--I certify that this submission is my own original work Danielle Hyland R01852274-->
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
    <title>Register for an Account</title>
    <script>
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("confirmPassword");

        function validate(form)
        {
            fail = validateUsername(form.username.value)
            fail += validateEmail(form.email.value)
            fail += validatePassword(form.password.value)
            fail += confirmPassword(form.confirmPassword.value, form.password.value)

            if   (fail == "")   return true
            else { alert(fail); return false }
        }

        function validateUsername(field)
        {
            if (field == "") return "No Username was entered.\n"
            else if (field.length < 5)
                return "Usernames must be at least 5 characters.\n"
            else if (/[^a-zA-Z0-9_-]/.test(field))
                return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
            return ""
        }

        function validatePassword(field)
        {
            if (field == "") return "No Password was entered.\n"
            else if (field.length < 6)
                return "Passwords must be at least 6 characters.\n"
            else if (! /[a-z]/.test(field) ||
                ! /[A-Z]/.test(field) ||
                ! /[0-9]/.test(field))
                return "Passwords require one each of a-z, A-Z and 0-9.\n"
            return ""
        }

        function confirmPassword(field1, field2)
        {
            if (field1 === "") return "No confirmation Password was entered.\n"
            else if (field1 !== field2)
                return"The passwords do not match.\n"
            return ""
        }

        function validateEmail(field)
        {
            if (field == "") return "No Email was entered.\n"
            else if (!((field.indexOf(".") > 0) &&
                (field.indexOf("@") > 0)) ||
                /[^a-zA-Z0-9.@_-]/.test(field))
                return "The Email address is invalid.\n"
            return ""
        }
    </script>
</head>
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
                <form method='post' action='login.php' onsubmit='return true'>
                    <button type='submit' class='btn btn-success '>Log In</button>
                </form>
            </div>
        </div>
    </nav>
</header>
<?
require_once 'functions.php';

$username = $password = $email = $confirmPassword="";


//Checks if the username, email, password and confirm password fields are filled out
if (isset($_POST['username'])   &&
    isset($_POST['email'])    &&
    isset($_POST['password']) &&
    isset($_POST['confirmPassword']))
{
    if (!empty($_POST['username'])   &&
        !empty($_POST['email'])    &&
        !empty($_POST['password']) &&
        !empty($_POST['confirmPassword'])){

        //Sanitizes user data
        $username = sanitizeMySQL($conn, $_POST['username']);
        $email = sanitizeMySQL($conn, $_POST['email']);
        $password = sanitizeMySQL($conn, $_POST['password']);
        $confirmPassword = sanitizeMySQL($conn, $_POST['confirmPassword']);

        //validates user data via PHP
        $fail = validate_username($username);
        $fail .= validate_email($email);
        $fail .= validate_password($password);
        $fail .= confirmPassword($confirmPassword, $password);

        echo $fail;

        if ($fail == "")
        {
            echo "Form data successfully validated:
            $username, $password, $email.<br>";

            //Salts and hashes the password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            //checks if the username already exists in the database and returns 1 if it does or nothing if it does not
            $query = "SELECT 1 from users WHERE username='$username'";

            $result = $conn->query($query);
            $row = $result->fetch_assoc();

            //If the username exists displays an error message
            if ($row["1"]== 1){
                echo "This username already exists, please select a different user name and <a href='register.php'> register</a> again";
            }else {
                //If the username does not exist in the database runs the function to add a new user to the users table
                add_user($conn, $username, $email, $hash);
            }

            exit;
        }
    }else echo "Please enter all fields";

}


?>
<body>
<div class="container">
    <h1>Register User:</h1>
    <form action="register.php" method="post" onsubmit="return validate(this)">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" >
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="none@yahoo.com" >
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password"  >
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" >
        </div>
        <button type="submit" class="btn btn-pink">Register</button>
    </form>
</div>

<!-- Optional JavaScript -->
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>

</body>
</html>

