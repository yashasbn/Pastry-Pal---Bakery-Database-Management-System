<?php 
    // Include constants.php file here
    include('../config/constants.php');

    // Get id of food to be deleted
    if(isset($_GET['id']) && isset($_GET['image_name'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove physical image file if available
        if($image_name != "") {
            // Image is available so we remove it
            $path = "../images/food/" . $image_name;
            // Remove image
            $remove = unlink($path);

            // If failed to remove image then add an error message and stop the process
            if($remove == false) {
                // Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Food Image.</div>";
                // Redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop the process
                die();
            }
        }
        
        // Delete data from database
        $sql = "DELETE FROM tbl_food WHERE id = $id";

        // Execute query
        $res = mysqli_query($conn, $sql);

        // Check whether query executed successfully or not
        if($res == true) {
            // Successful execution and food item deleted
            // Create Session Variable to Display Message
            $_SESSION['delete'] = "<div class='success'>Food Item Deleted Successfully.</div>";
            // Redirect to manage food page
            header('location:'.SITEURL.'admin/manage-food.php');
        } else {
            // Failed to delete food item
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food Item.</div>";
            // Redirect
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    } else {
        // Redirect to manage food page
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>
