<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br /><br />

        <?php

            if(isset($_SESSION['add']))
            {
               echo $_SESSION['add'];//Displaying Session Message
               unset($_SESSION['add']);//Removing Session Message
            }
            if(isset($_SESSION['upload']))
            {
               echo $_SESSION['upload'];//Displaying Session Message
               unset($_SESSION['upload']);//Removing Session Message
            }
        ?>
        <br /><br  />
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>   
                <tr>
                    <td>Featured: </td>
                    <td><input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td><input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


    </div>
</div>

<?php include('partials/footer.php');?>


<?php
//Process the value from form and save it in database
//Check whether submit button is clicked or not
 if(isset($_POST['submit']))
 {
    //Button Clicked
    //echo "Button Clicked";

    //Getting data from form
     $title = $_POST['title'];
     //$username = $_POST['username'];
     //$password = md5($_POST['password']); //Encrypting password
     //For radio input we need to check whether button is selected or not
     if(isset($_POST['featured']))
     {
        //Get Value from form 
        $featured = $_POST['featured'];
     }
     else
     {
        //set default value
        $featured = 'No';
     }


     if(isset($_POST['active']))
     {
        //Get Value from form 
        $active = $_POST['active'];
     }
     else
     {
        //set default value
        $active = 'No';
     }

     //check whether image is selected or not and set the value for image name accordingly
     //print_r($_FILES['image']);die();
     if(isset($_FILES['image']['name']))
     {
        //Upload The Image
        //to upload image we need image name , source path and destination path
        $image_name = $_FILES['image']['name'];

        //upload image only if image is selected
        if($image_name !="")
        {

            //auto rename the image
            //get the extension of our image(jpg,png,gif etc.)
            $ext = end(explode('.', $image_name));

            //rename the image
            $image_name ="Food_Category_".rand(000,999).'.'.$ext;//ex: Food_Category_834.jpg

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            //Finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether image is uploaded or not
            //and if image is not uploaded then we will stop the process and redirect with error message
            if($upload==false)
            {
                //set message
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                //redirect to add category page
                header('location'.SITEURL.'admin/add-category.php');
                //stop the process
                die();
            }
        }
     }
     else
     {
        //Don't upload the image set image as blank
        $image_name = " ";
     }

     //SQl Query to Save data into database
     $sql = "INSERT INTO tbl_category SET
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'     
     ";
    //execute query and save in database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //Check whether data is inserted or not and display appropriate message
    if($res==True)
    {
        //Data inserted
        //echo "Data Inserted";
        //Create a session variable to display message
        $_SESSION['add'] ="<div class='success'>Category Added Successfully.</div>";
        //Redirect Page
        header('location:'.SITEURL.'admin/manage-category.php');

    }
    else
    {
        //Data not inserted
        //echo "Data Not Inserted";
        $_SESSION['add'] ="Failed To Add Category.";
        //Redirect Page to add-admin
        header('location:'.SITEURL.'admin/add-category.php');
    }
 }
 
?>