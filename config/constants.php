<?php 

    // Starting the sessions
    session_start();

    // Creating the constants variables
    define('SITEURL', "http://localhost/marc's_food/");
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('PASS', '');
    define('DB_NAME', "marc's_food");

    //Connection to the database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, PASS) or die(mysqli_error()); //this line of code is responsible to connect to the database
    // selecting the database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

?>