<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <!-- Button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-admin.php" class="btn-primary">Add Admin</a>
        <br><br/><br>

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
                <th style="padding: 10px; border: 1px solid #dddddd;">Full Name</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Username</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Actions</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;
            if($count > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $full_name = $row['full_name'];
                    $username = $row['username'];
            ?>
            <tr>
    <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $sn++; ?></td>
    <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $full_name; ?></td>
    <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $username; ?></td>
    <td style="padding: 5px; border: 1px solid #dddddd;">
        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary" style="padding: 5px 10px; font-size: 12px; ">Change Password</a>
        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary" style="padding: 5px 10px; font-size: 12px;">Update Admin</a>
        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger" style="padding: 5px 10px; font-size: 12px;">Delete Admin</a>
    </td>
</tr>

            <?php
                }
            } else {
                echo "<tr><td colspan='4' style='padding: 10px; border: 1px solid #dddddd;' class='error'>No Admins Added.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
