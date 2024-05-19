<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br /><br />
        <?php
         //1.Get ID of selected category
        if(isset($_GET['id']))
        {
            //Get id
            //echo "Getting data";
            $id = $_GET['id'];
            //create sql query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //3.Execute Query
            $res = mysqli_query($conn,$sql);

                if($res==True)
            {
                //Check whether data is available or not
                $count = mysqli_num_rows($res);
                //check whether we have admin data or not
                if($count == 1)
                {
                    //get the details
                    //echo "Category Available";
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }
                else
                {
                    //redirect to manage category page
                    $_SESSION['no-category-found']="<div class='error'>Category not found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        }
         else
         {
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');

         }        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image !="")
                            {
                                //Dispaly the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px";
                                <?php
                            }
                            else
                            {
                                //Display Message
                                echo "<div class='error'>Image not Added</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured =="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured =="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active =="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active =="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

</div>
</div>
<?php 
//Check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //echo "Button Clicked";
    //Get all values from Form to update
     $id = $_POST['id'];
     $title = $_POST['title'];
     $current_image  = $_POST['current_image'];
     $featured = $_POST['featured'];
     $active = $_POST['active'];

     //check whether image is selected or not
     if(isset($_FILES['image']['name']))
     {
        //Get Image details
        $image_name = $_FILES['image']['name'];
        //check whether image is available or not
        if($image_name !="")
        {
            //Image available
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
                header('location'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
            //remove the current image if available
            if($current_image != "")
            {
                $remove_path = "../images/category/".$current_image;
                $remove  = unlink($remove_path);

                //check whether image is removed or not
                //If failed to remove then display the message and stop the process
                if($remove==false)
                {
                    //Failed to remove image
                    $_SESSION['failed-remove'] = "<div class-error'>Failed to Remove Current Image.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();
                }
            }
            
        }
        else
        {
            $image_name = $current_image;
        }

     }
     else
    {
        $image_name = $current_image;
    }

     //Create a SQL query to update Category
     $sql2 = "UPDATE tbl_category SET
     title = '$title',
     image_name = '$image_name',
     featured = '$featured',
     active =  '$active'
     WHERE id='$id';
     ";

     //Execute the Query
     $res2 = mysqli_query($conn,$sql2);

     //Check if query is executed successfully or not
     if($res==True)
     {
        //Query executed and Admin Updated
        $_SESSION['update']="<div class='success'>Category Updated Successfully,</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
     }
     else
     {
        //Failed to Update Admin
        $_SESSION['update']="<div class='error'>Failed to Update Category</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
     }
}
?>
<?php include('partials/footer.php'); ?>