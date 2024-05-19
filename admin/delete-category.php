<?php 
    //Include constant.php file here
    include('../config/constants.php');
   //Get id of admin to be deleted
     if(isset($_GET['id']) AND isset($_GET['image_name']))
     {
        //echo "Get the value and Delete";
        $id=$_GET['id'];
        $image_name = $_GET['image_name'];

        //remove physical image file if available
        if($image_name!="")
        {
            //image is available so we remove it
            $path ="../images/category/".$image_name;
            //remove image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove == false)
            {
                //set the session message
                $_SESSION['remove'] ="<div class='error'>Failed to Remove Category Image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }
        //delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute query
        $res = mysqli_query($conn, $sql);

        //check whether query executed successfully or not
    if($res==True)
    {
        //Succesful executuiom and category deleted
        //Create Session Variable to Display Message
        $_SESSION['delete']="<div class='success'>Category Deleted Successfully.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        //Failed to delete category
        //echo "Failed to Delete category";
        $_SESSION['delete']="<div class='success'>Failed to Delete Category.</div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-category.php');
    }


    }
     else
     {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
     }
   //Create SQL Query to Delete Admin
    //$sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    //$res = mysqli_query($conn, $sql);

    //check whether query executed successfully or not
    /*if($res==True)
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
   //Redirect to Manage Admin page with message(success/error)*/


?>