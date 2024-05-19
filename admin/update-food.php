<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br /><br />
        <?php
         //1. Get ID of selected food item
        if(isset($_GET['id']))
        {
            // Get id
            $id = $_GET['id'];
            // Create SQL query to get all other details
            $sql = "SELECT * FROM tbl_food WHERE id=$id";

            //3. Execute Query
            $res = mysqli_query($conn,$sql);

            if($res==True)
            {
                // Check whether data is available or not
                $count = mysqli_num_rows($res);
                // Check whether we have food data or not
                if($count == 1)
                {
                    // Get the details
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_image = $row['image_name'];
                    $category = $row['category_id'];
                    $active = $row['active'];
                    $featured = $row['featured'];
                }
                else
                {
                    // Redirect to manage food page
                    $_SESSION['no-food-found']="<div class='error'>Food item not found.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        }
         else
         {
            // Redirect to manage food page
            header('location:'.SITEURL.'admin/manage-food.php');
         }        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="num" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image !="")
                            {
                                // Display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                // Display Message
                                echo "<div class='error'>Image not Added</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <!-- Populate categories from the database -->
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='YES'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $selected = ($category == $row['id']) ? "selected" : "";
                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['title'] . "</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if($active == 'Yes') echo "checked"; ?>> Yes
                        <input type="radio" name="active" value="No" <?php if($active == 'No') echo "checked"; ?>> No
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if($featured == 'Yes') echo "checked"; ?>> Yes
                        <input type="radio" name="featured" value="No" <?php if($featured == 'No') echo "checked"; ?>> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php 
// Check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    // Get all values from Form to update
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $active = $_POST['active'];
    $featured = $_POST['featured'];
    $current_image = $_POST['current_image'];

    // Check if new image is selected
    if(isset($_FILES['image']['name']))
    {
        $image_name = $_FILES['image']['name'];
        // Check whether image is available or not
        if($image_name != "")
        {
            // Image available, upload and update image
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = "Food_" . uniqid() . '.' . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;
            // Finally upload the image
            if(!move_uploaded_file($source_path, $destination_path))
            {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
            // Remove the current image if available
            if($current_image != "")
            {
                $remove_path = "../images/food/".$current_image;
                $remove = unlink($remove_path);
                // Check whether image is removed or not
                if($remove == false)
                {
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();
                }
            }
            
        }
        else
        {
            // No new image, set image name to current image
            $image_name = $current_image;
        }

    }
    else
    {
        // No image selected, set image name to current image
        $image_name = $current_image;
    }

    // Create SQL query to update Food
    $sql2 = "UPDATE tbl_food SET
    title = '$title',
    description = '$description',
    price = $price,
    image_name = '$image_name',
    category_id = $category,
    active = '$active',
    featured = '$featured'
    WHERE id='$id'";

    // Execute the Query
    $res2 = mysqli_query($conn,$sql2);

    // Check if query is executed successfully or not
    if ($res2) {
        $_SESSION['add'] = "<div class='success'>Food updated successfully.</div>";
        header('location: ' . SITEURL . 'admin/manage-food.php');
        exit;
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to update food.</div>";
        header('location: ' . SITEURL . 'admin/add-food.php');
    }
}
?>

<?php include('partials/footer.php'); ?>
