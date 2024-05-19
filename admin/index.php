<?php include('partials/menu.php'); ?>

<!----Main Content Section Starts---->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>
        <?php
        // Query for categories
        $query1 = "SELECT * FROM tbl_category";
        $result1 = mysqli_query($conn, $query1);
        $count1 = mysqli_num_rows($result1);
        ?>
        <div class="col-4 text-center">
            <h1><?php echo $count1 ?></h1>
            <br>
            Categories
        </div>
        <?php
        // Query for foods
        $query2 = "SELECT * FROM tbl_food";
        $result2 = mysqli_query($conn, $query2);
        $count2 = mysqli_num_rows($result2);
        ?>
        <div class="col-4 text-center">
            <h1><?php echo $count2 ?></h1>
            <br>
            Foods
        </div>
        <?php
        // Query for total orders
        $query3 = "SELECT * FROM tbl_order";
        $result3 = mysqli_query($conn, $query3);
        $count3 = mysqli_num_rows($result3);
        ?>
        <div class="col-4 text-center">
            <h1><?php echo $count3 ?></h1>
            <br>
            Total Orders
        </div>
        <?php
        // Query for revenue generated
        $query4 = "SELECT SUM(total) AS TOTAL FROM tbl_order WHERE status='DELIVERED' ";


        // $query4 = "SELECT SUM(total) AS TOTAL 
        // FROM tbl_order 
        // WHERE status='DELIVERED' 
        // AND order_date >= '2024-03-21 00:00:00' 
        // AND order_date < '2024-03-22 00:00:00' ";

        
        // $query4 = "SELECT SUM(total) AS TOTAL 
        // FROM tbl_order 
        // WHERE status='DELIVERED' 
        // AND food='Margharitta Pizza' ";



        $result4 = mysqli_query($conn, $query4);
        $data = mysqli_fetch_assoc($result4);
        $revenue = $data['TOTAL'];
        ?>
        <div class="col-4 text-center">
            <h1>₹<?php echo $revenue ?></h1>
            <br>
            Revenue Generated
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!----Main Content Section Ends---->

<?php include("partials/footer.php") ?>
