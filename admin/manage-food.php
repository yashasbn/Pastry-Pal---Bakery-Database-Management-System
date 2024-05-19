<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <!-- Button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br><br>

        <?php 
        if(isset($_SESSION['add'])) {
            echo "<div style='color:green; font-size: 20px;'>" . $_SESSION['add'] . "</div>";
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete'])) {
            echo "<div style='color:red; font-size: 20px;'>" . $_SESSION['delete'] . "</div>";
            unset($_SESSION['delete']);
        }
        ?>

        <table class="tbl-full" style="border-collapse: collapse; width: 100%;">
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 10px; border: 1px solid #dddddd;">Sl. No.</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Title</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Price</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Image</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Featured</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Active</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Action</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;
            if($count > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
            <tr>
                <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $sn++; ?></td>
                <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $title; ?></td>
                <td style="padding: 10px; border: 1px solid #dddddd;">₹<?php echo $price; ?></td>
                <td style="padding: 10px; border: 1px solid #dddddd;">
                    <?php
                    if($image_name == "") {
                        echo "<div style='color:red;'>Image not added.</div>";
                    } else {
                    ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ?>" width="100px">
                    <?php } ?>
                </td>
                <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $featured; ?></td>
                <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $active; ?></td>
                <td style="padding: 10px; border: 1px solid #dddddd;">
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary" style="padding: 5px 10px; font-size: 12px;"> UPDATE </a>
                     
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ;?>" class="btn-danger"style="padding: 5px 10px; font-size: 12px;"> DELETE </a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7' style='padding: 10px; border: 1px solid #dddddd;' class='error'>Food not added yet.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
