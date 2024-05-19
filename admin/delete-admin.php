<?php 
    //Include constant.php file here
    include('../config/constants.php');
   //Get id of admin to be deleted
     $id=$_GET['id'];
   //Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //check whether query executed successfully or not
    if($res==True)
    {
        //Succesful executuiom and admin deleted
        //echo "Admin Deleted";
        //Create Session Variable to Display Message
        $_SESSION['delete']="<div class='success'>Admin Deleted Successfully.</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to delete admin
        //echo "Failed to Delete admin";
        $_SESSION['delete']="<div class='success'>Failed to Delete Admin.</div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
   //Redirect to Manage Admin page with message(success/error)


?>