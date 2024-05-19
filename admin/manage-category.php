<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br>

        <?php
        if(isset($_SESSION['add'])) {
            echo "<div>" . $_SESSION['add'] . "</div>";
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['remove'])) {
            echo "<div>" . $_SESSION['remove'] . "</div>";
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete'])) {
            echo "<div>" . $_SESSION['delete'] . "</div>";
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found'])) {
            echo "<div>" . $_SESSION['no-category-found'] . "</div>";
            unset($_SESSION['no-category-found']);
        }
        if(isset($_SESSION['update'])) {
            echo "<div>" . $_SESSION['update'] . "</div>";
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload'])) {
            echo "<div>" . $_SESSION['upload'] . "</div>";
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-remove'])) {
            echo "<div>" . $_SESSION['failed-remove'] . "</div>";
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br>
        <!--Button to add category -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br><br>

        <table class="tbl-full" style="border-collapse: collapse; width: 100%; text-align: center;">
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 10px; border: 1px solid #dddddd;">Sl. No.</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Title</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Image</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Featured</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Active</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Actions</th>
            </tr>
            <?php
            // Query to get all categories
            $sql = "SELECT * FROM tbl_category";
            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check whether query is executed or not
            if($res == TRUE) {
                // Count rows to check whether we have data in the database or not
                $count = mysqli_num_rows($res);
                $sn = 1; // Create variable and assign value 1
                // Check number of rows
                if($count > 0) {
                    // We have data in the database
                    while($rows = mysqli_fetch_assoc($res)) {
                        // Get individual data
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];

                        // Display value in our table
                        ?>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $sn++; ?></td>
                            <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $title ?></td>
                            <td style="padding: 10px; border: 1px solid #dddddd;">
                                <?php   
                                // Check whether image name is available or not
                                if($image_name != '') {
                                    // Display the image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                    <?php
                                } else {
                                    // Display the image
                                    echo "<div class='error'>Image not added.</div>";
                                }
                                ?>
                            </td>
                            <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $featured; ?></td>
                            <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $active; ?></td>
                            <td style="padding: 10px; border: 1px solid #dddddd;">
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary" style="padding: 5px 10px; font-size: 12px;">UPDATE</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger" style="padding: 5px 10px; font-size: 12px;">DELETE</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // We do not have data in the database
                    ?>
                    <tr>
                        <td colspan="6" style="border: 1px solid #dddddd;"><div class="error">No Category Added.</div></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php') ?>
