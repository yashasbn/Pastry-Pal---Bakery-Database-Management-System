<?php
    //Authorization -Acess Control
    //Check whether user is logged in or not
    if(!isset($_SESSION['user']))//If user session is not set
    {
        //User is not logged in
        //Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='success text-center'>Please login to access Admin Panel.</div>";
        //redirect to login page
        header("location:".SITEURL.'admin/login.php');
    }
?>