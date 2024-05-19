<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <?php
        // Check if the order ID is set in the URL
        if (isset($_GET['id'])) {
            $id = $_GET['id']; // Get the order ID from the URL

            // Fetch the order details from the database based on the order ID
            $sql = "SELECT * FROM tbl_order WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    // Order found, fetch details
                    $row = mysqli_fetch_assoc($res);
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $contact = $row['customer_contact'];
                    $email = $row['customer_email'];
                    $address = $row['customer_address'];
                } else {
                    // Order not found
                    $_SESSION['order-not-found'] = "<div class='error'>Order not found.</div>";
                    header('location:' . SITEURL . 'admin/manage-order.php');
                    exit;
                }
            } else {
                // Query execution failed
                $_SESSION['order-not-found'] = "<div class='error'>Failed to fetch order details.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
                exit;
            }
        } else {
            // Order ID not provided in the URL
            header('location:' . SITEURL . 'admin/manage-order.php');
            exit;
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Ordered:</td>
                    <td><?php echo $food; ?></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>₹<?php echo $price; ?></td>
                </tr>
                <tr>
                    <td>Quantity:</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option value="Ordered" <?php if ($status == 'Ordered') echo 'selected'; ?>>Ordered</option>
                            <option value="On Delivery" <?php if ($status == 'On Delivery') echo 'selected'; ?>>On Delivery</option>
                            <option value="Delivered" <?php if ($status == 'Delivered') echo 'selected'; ?>>Delivered</option>
                            <option value="Cancelled" <?php if ($status == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td><input type="text" name="contact" value="<?php echo $contact; ?>"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?php echo $email; ?>"></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><textarea name="address"><?php echo $address; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Get the form data
            $id = $_POST['id'];
            $qty = $_POST['qty'];
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            // Update the order in the database
            $sql_update = "UPDATE tbl_order SET 
                            qty = '$qty',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$contact',
                            customer_email = '$email',
                            customer_address = '$address'
                            WHERE id = $id";

            $res_update = mysqli_query($conn, $sql_update);

            if ($res_update) {
                // Order updated successfully
                $_SESSION['update'] = "<div class='success'>Order updated successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            } else {
                // Failed to update order
                $_SESSION['update'] = "<div class='error'>Failed to update order.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
