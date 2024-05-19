<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .card {
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .card h2 {
            margin-bottom: 20px;
            color: #007bff;
        }
        .card table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .card th, .card td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .card th {
            background-color: #f2f2f2;
        }
        .card tr:hover {
            background-color: #f5f5f5;
        }
        .confirmation {
            font-weight: bold;
            font-size: 24px;
            color: green;
            margin-bottom: 20px;
        }
        .btn-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .logo {
            display: block;
            margin: 30px auto;
            width: 150px;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
    </style>
</head>
<body>
    <img class="logo" src="images/logo.png" alt="Pastrypal Logo">
    <h1>Thank you for ordering with Pastrypal!</h1>
    <div class="container">
        
        <?php 
        // Ensure $order_id is set and not empty
        if(isset($_GET['order_id']) && !empty($_GET['order_id'])) {
            $order_id = $_GET['order_id'];

            // SQL query to select the row with the specified order_id
            $sql = "SELECT * FROM tbl_order WHERE id = $order_id";

            // Execute the query
            $result = mysqli_query($conn, $sql);
            

            // Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
                // Output order confirmation message

                // Output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='card'>";
                    echo "<h2>Order Details</h2>";
                    echo "<table>
                            <tr>
                                <th>ID</th>
                                <td>" . $row["id"] . "</td>
                            </tr>
                            <tr>
                                <th>Food</th>
                                <td>" . $row["food"] . "</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>₹" . $row["price"] . "</td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>" . $row["qty"] . "</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>₹" . $row["total"] . "</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>" . $row["order_date"] . "</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>" . $row["status"] . "</td>
                            </tr>
                            <tr>
                                <th>Customer Name</th>
                                <td>" . $row["customer_name"] . "</td>
                            </tr>
                            <tr>
                                <th>Customer Contact</th>
                                <td>" . $row["customer_contact"] . "</td>
                            </tr>
                            <tr>
                                <th>Customer Email</th>
                                <td>" . $row["customer_email"] . "</td>
                            </tr>
                            <tr>
                                <th>Customer Address</th>
                                <td>" . $row["customer_address"] . "</td>
                            </tr>
                        </table>";
                    echo "</div>";
                }
            } else {
                // If no rows found, display a message
                echo "<div class='confirmation'>0 results</div>";
            }
        } else {
            // If order_id is not set or empty, display an error message
            echo "<div class='confirmation'>Order ID is missing or invalid.</div>";
        }
        ?>
    </div>
    
    <div class="btn-container">
            <a href="<?php echo SITEURL; ?>" class="btn">Back to Home</a>
        </div>
</body>
</html>
