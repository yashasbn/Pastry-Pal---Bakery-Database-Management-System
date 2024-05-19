<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Displaying Session Message
            unset($_SESSION['add']); // Removing Session Message
        }
        ?>
        <br /><br />
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Food Title"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <!-- Populate categories from the database -->
                            <?php
                            // Include database connection and configuration here
                            $sql = "SELECT * FROM tbl_category WHERE active='YES'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No" > No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No" > No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php
// Process the form data and save it in the database
if (isset($_POST['submit'])) {
    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // Upload image
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if (!empty($image_name)) {
            // Image is selected
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = "Food-" . uniqid() . "." . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;
            if (move_uploaded_file($source_path, $destination_path)) {
                // Image uploaded successfully
            } else {
                echo "Failed to upload image.";
            }
        }
    } else {
        $image_name = ""; // Set default value
    }

    // Insert data into the database
    $sql = "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active)
            VALUES ('$title', '$description', $price, '$image_name', $category, '$featured', '$active')";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
        header('location: ' . SITEURL . 'admin/manage-food.php');
        exit;
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
        header('location: ' . SITEURL . 'admin/add-food.php');
    }
}
?>
