<?php
// Include menu file
 //include('partials-front/menu.php');
 include('config/constants.php'); 
// Check if order ID is set in the URL
if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details from the database
    // Assuming $conn is your database connection
    $sql = "SELECT o.*, f.image_name 
            FROM tbl_order o 
            INNER JOIN tbl_food f ON o.food = f.title
            WHERE o.id = $order_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['food'];
        $price = $row['total'];
        $food = $row['food'];
        $qty = isset($_POST['qty']) ? $_POST['qty'] : 1;
    } else {
        // No order found with the provided ID, redirect to home page
        header("Location: payment.php?order_id=$order_id");
        exit; // Exit to prevent further execution
    }
} else {
    // Redirect if order ID is not set
    header('location:'.SITEURL);
    exit; // Exit to prevent further execution
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        label {
            font-weight: bold;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
        }
        .card-body {
            padding: 20px;
        }
        .food-menu-img {
            border: 2px solid #ccc;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .food-menu-img img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .btn-payment {
            background-color: #343a40;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-payment:hover {
            background-color: #212529;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-5 display-4 text-capitalize text-center">
                <h3 class="text-white">Payment Portal</h3>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Payment Checkout</h4>
                    </div>
                    <div class="card-body">
                        <div class="food-menu-img">
                            <?php 
                            if(empty($row['image_name'])) {
                                echo "<div class='error'>No Image Available!</div>";
                            } else {
                            ?>
                            <!-- Image available -->
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $row['image_name']; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php } ?>
                        </div>
                        <p>Selected Food: <?php echo $title; ?></p>
                        <p>Amount to be paid: ₹<?php echo $price ; ?></p>
                        <form action="pay.php?order_id=<?php echo $order_id; ?>" method="post">
                            <div>
                                <button type="submit" name="payment" class="btn btn-payment btn-block font-weight-bold">Proceed to Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>


