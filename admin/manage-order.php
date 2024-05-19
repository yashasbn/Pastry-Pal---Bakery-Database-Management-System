<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Orders</h1>
        <br>

        <?php 
        if(isset($_SESSION['update']))
        {
            echo "<span style='color:green;font-size:20px'>" . $_SESSION['update'] . "</span>";
            unset($_SESSION['update']);
        }
        ?>
        <br><br>
        <table class="tbl-full" style="border-collapse: collapse; width: 100%; text-align: center;">
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 5px; border: 1px solid #dddddd;">Sl. No.</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Food Ordered</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Price</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Quantity</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Total</th>
                <th style="padding: 20px; border: 1px solid #dddddd;">Order Date</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Status</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Customer Name</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Contact</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Email</th>
                <th style="padding: 10px; border: 1px solid #dddddd;">Address</th>
                <th style="padding: 20px; border: 1px solid #dddddd;">Actions</th>
            </tr>
            <?php
            // Define a function to determine the color based on the order status
            function getStatusColor($status) {
                switch ($status) {
                    case 'Cancelled':
                        return 'red';
                    case 'On Delivery':
                        return 'orange';
                    case 'Delivered':
                        return 'green';
                    case 'Ordered':
                        return 'blue';
                    default:
                        return 'black'; // Default color if status is unknown
                }
            }

            // Get all orders from the database
            $sql ="CALL `getOrder`()";

            // Execute Query
            $res = mysqli_query($conn, $sql);

            // Count rows
            $count = mysqli_num_rows($res);
            $sn = 1;
            if ($count > 0) {
                // Orders available
                while ($row = mysqli_fetch_assoc($res)) {
                    $order_id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $price * $qty;
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $contact = $row['customer_contact'];
                    $email = $row['customer_email'];
                    $address = $row['customer_address'];
                    ?>
                    <tr>
                        <td style="padding: 5px; border: 1px solid #dddddd;"><?php echo $sn++; ?></td>
                        <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $food; ?></td>
                        <td style="padding: 10px; border: 1px solid #dddddd;">₹<?php echo $price; ?></td>
                        <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $qty; ?></td>
                        <td style="padding: 10px; border: 1px solid #dddddd;">₹<?php echo $total; ?></td>
                        <td style="padding: 20px; border: 1px solid #dddddd;"><?php echo $order_date; ?></td>
                        <td style="padding: 10px; border: 1px solid #dddddd; color: <?php echo getStatusColor($status); ?>"><?php echo $status; ?></td>
                        <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $customer_name; ?></td>
                        <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $contact; ?></td>
                        <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $email; ?></td>
                        <td style="padding: 10px; border: 1px solid #dddddd;"><?php echo $address; ?></td>
                        <td style="padding: 20px; border: 1px solid #dddddd;">
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $order_id; ?>" class="btn-secondary" style="padding: 5px 10px; font-size: 12px;">Update</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                // No orders available
                echo "<tr><td colspan='12' class='error' style='border: 1px solid #dddddd;'>No orders available</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
