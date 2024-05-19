<?php
include('partials-front/menu.php');

// Check if food_id is set in the URL
if(isset($_GET['food_id']))
{
    $food_id = $_GET['food_id'];

    // Query to fetch food details
    $sql = "SELECT title, price, image_name FROM tbl_food WHERE id='$food_id'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {  
        // Fetch the data
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        // Food not found, redirect to home page
        header('location:'.SITEURL);
        exit; // Exit to prevent further execution
    }
}
else
{
    // Food ID not passed, redirect to home page
    header('location:'.SITEURL);
    exit;
}

?>

<!-- Your HTML code -->

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="#" class="order" method="POST">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                    if($image_name == "") {
                        echo "<div class='error'>No Image Available!</div>";
                    } else {
                    ?>
                    <!-- Image available -->
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                    <?php } ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">₹<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" min=1 max=10 required>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required>
                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 123-456-7890" class="input-responsive" required>
                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. john@example.com" class="input-responsive" required>
                <div class="order-label">Address</div>
                <textarea name="address" rows="5" placeholder="E.g. 123 Main St, Cityville, Countryland" class="input-responsive" required></textarea>
                <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php
        // check if submit button is clicked or not
        if(isset($_POST['submit'])) {
            // get the values from the form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty; // calculate the total price of food item
            date_default_timezone_set('Asia/Kolkata');
            $order_date = date("Y-m-d H:i:s"); // current time
            $status = "ordered"; // pending, on delivery, cancelled
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // Save data to SQL
            $sql2 = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) 
                     VALUES ('$food', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";
            
            // execute query
            $res2 = mysqli_query($conn, $sql2);

            // check if query is executed successfully
            if($res2) {
                // Query executed successfully
                $_SESSION["order"] = "<div class='success text-center'>Order placed Successfully!</div>";
                // Redirect to payment page with order ID
                $order_id = mysqli_insert_id($conn);
                header("Location: payment.php?order_id=$order_id");
                exit;
            } else {
                // Failed to order food
                $_SESSION["order"] = "<div class='failure text-center'>Failed to place order. </div>";
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit;
            }
        }
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php 
include('partials-front/footer.php');
?>
