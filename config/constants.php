<?php
    //Start Session
    session_start();

    //Create Constants to store no repeating values
    define('SITEURL','http://localhost/Bakery/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','bakery_management');
    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die(mysqli_error()); //Database Connection
    $db_select =mysqli_select_db($conn,'bakery_management') or die(mysqli_error());  //Selecting Database
?>