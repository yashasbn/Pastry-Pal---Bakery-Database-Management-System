<?php
include('config/constants.php'); 


// Check if order ID is set in the URL
if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details from the database
    // Assuming $conn is your database connection
    $sql = "SELECT *
            FROM tbl_order 
            WHERE id = $order_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $price = $row['total'];
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: sky-blue;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        label {
            font-weight: bold;
        }
        .blade-logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 100px;
        }
    </style>
</head>
<body >
    <div class="container">
        <h1 align="center">Pastry Pay</h1>
        <img src="images/logo.png" alt="BladePay Logo" class="blade-logo">
        <h2 class="text-center mb-4">Payment Checkout</h2>
        <form action="payment_confirmation.php?order_id=<?php echo $order_id; ?>" method="post">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" class="form-control" id="card_number" name="card_number" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cvv">CVV</label>
                    <input type="number" class="form-control" id="cvv" name="cvv" required>
                </div>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $price?>" readonly required>
            </div>
            <input type="submit" class="btn btn-primary" value="Proceed to Payment">
        </form>
    </div>
    <script>
        document.getElementById("expiry_date").addEventListener("input", function() {
            var today = new Date();
            var inputDate = new Date("20" + this.value.split("/").reverse().join("/"));
            if (inputDate < today) {
                this.setCustomValidity("Expiry date must be after the current date");
            } else {
                this.setCustomValidity("");
            }
        });

        document.getElementById("cvv").addEventListener("input", function() {
            if (this.value.length !== 3) {
                this.setCustomValidity("CVV must be 3 characters long");
            } else {
                this.setCustomValidity("");
            }
        });
        document.getElementById("card_number").addEventListener("input", function() {
    // Remove non-numeric characters
    var cardNumber = this.value.replace(/\D/g, '');
    
    // Check if the card number length is valid (typically 16 digits for Indian cards)
    if (cardNumber.length !== 16) {
        this.setCustomValidity("Invalid card number");
    } else {
        // Optionally, you can perform additional checks here
        
        this.setCustomValidity("");
    }
});

    </script>
</body>
</html>
