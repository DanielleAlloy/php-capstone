<?php
//I certify that this submission is my own original work Danielle Hyland R01852274
    $servername = "localhost";
    $username = "jim";
    $password = "mypasswd";
    $dbname = "capstone";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) die("Fatal Error");


    //sanitizes string data
    function sanitizeString($var)
    {
        if (get_magic_quotes_gpc())
            $var = stripslashes($var);
        $var = strip_tags($var);
        $var = htmlentities($var);
        return $var;
    }
    //Sanitizes SQL
    function sanitizeMySQL($connection, $var)
    {
        $var = $connection->real_escape_string($var);
        $var = sanitizeString($var);
        return $var;
    }


    function get_post($conn, $var)
    {
        return $conn->real_escape_string($_POST[$var]);
    }

    //Adds user to the database
    function add_user($conn, $username, $email, $pw)
    {
        //prepared statement
        $stmt = $conn->prepare('INSERT INTO users VALUES(?,?,?)');
        $stmt->bind_param('sss', $username, $email, $pw);
        $stmt->execute();
        echo "User created. Your username is $username<br>Click <a href='login.php'> here to log in</a>." ;
        $stmt->close();
        $conn->close();
    }

    //Adds Record to the database
    function add_record($conn, $id, $brand, $model, $mp, $focusPoints, $sensorFormat, $description)
    {
        $stmt = $conn->prepare('INSERT INTO cameras VALUES(?,?,?,?,?,?,?)');
        $stmt->bind_param('sssdiss',  $id, $brand,$model, $mp, $focusPoints, $sensorFormat, $description);
        $stmt->execute();
        echo "Record inserted.";
        $stmt->close();
        $conn->close();
    }

    //Ends a session
    function destroy_session_and_data()
    {
        $_SESSION = array();
        setcookie(session_name(), '', time() - 2592000, '/');
        session_destroy();
    }

    //PHP Functions for validating user input
    //Validates username field
    function validate_username($field)
    {
        if ($field == "") return "No value was entered in username, please enter a username<br>";
        else if (strlen($field) < 5)
            return "Usernames must be at least 5 characters<br>";
        else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
            return "Only letters, numbers, - and _ in usernames<br>";
        return "";
    }

    //Validates Password field
    function validate_password($field)
    {
        if ($field == "") return "No Password was entered<br>";
        else if (strlen($field) < 6)
            return "Passwords must be at least 6 characters<br>";
        else if (!preg_match("/[a-z]/", $field) ||
            !preg_match("/[A-Z]/", $field) ||
            !preg_match("/[0-9]/", $field))
            return "Passwords require 1 each of a-z, A-Z and 0-9<br>";
        return "";
    }

    //Validates email field
    function validate_email($field)
    {
        if ($field == "") return "No Email was entered<br>";
        else if (!((strpos($field, ".") > 0) &&
                (strpos($field, "@") > 0)) ||
            preg_match("/[^a-zA-Z0-9.@_-]/", $field))
            return "The Email address is invalid<br>";
        return "";
    }

    //Validates confirmPassword field and confirms that the passwords match
    function confirmPassword($field1, $field2)
        {
            if ($field1 === "") return "No confirmation Password was entered.\n";
            else if ($field1 !== $field2)
                return"The passwords do not match.\n";
            return "";
        }
?>