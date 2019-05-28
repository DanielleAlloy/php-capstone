<?php
//I certify that this submission is my own original work Danielle Hyland R01852274
    session_start();
    require_once 'functions.php';

    //destroys the session data and variables
    if(isset($_SESSION['username'])){
        destroy_session_and_data();
        //Returns the user to the login page
        header('Location: login.php');
    }

    ?>