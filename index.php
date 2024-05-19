<?php 
include('partials-front/menu.php');
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
    <form action="<?php echo SITEURL; ?>/food-search.php" method="POST">

            <input type="search" name="search" placeholder="Search for what you love.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->


<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php 
        // Create SQL query to display categories from database
        $sql = "SELECT * FROM tbl_category WHERE active='yes' AND featured='yes' LIMIT 6";
        // Execute the query
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0) {
            // Categories available
            while ($row = mysqli_fetch_assoc($res)) {
                // Get values like id, image name, and title
                $id = $row['id'];
                $image_name = $row['image_name'];
                $title = $row['title'];
        ?>
        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id?>">
            <div class="box-3 float-container">
                <?php 
                if($image_name == "") {
                    echo "<div class='error'>No Image Available!</div>";
                } else {
                ?>
                <!-- Image available -->
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                <?php } ?>
               <!-- <h3 class="float-text text-white"><?php echo $title; ?></h3>-->
            </div>
        </a>
        <?php
            }
        } else {
            // Categories not available
            echo "<div class='error'><p>Sorry! No Category Available Right Now.</p></div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
        // Create SQL query to fetch food items from the database
        $food_sql = "SELECT * FROM tbl_food WHERE featured='Yes' LIMIT 2";

        // Execute the query
        $food_res = mysqli_query($conn, $food_sql);
        if(mysqli_num_rows($food_res) > 0) {
            // Food items available
            while ($food_row = mysqli_fetch_assoc($food_res)) {
                // Get values like title, price, description, and image
                $food_id= $food_row['id'];
                $food_title = $food_row['title'];
                $food_price = $food_row['price'];
                $food_description = $food_row['description'];
                $food_image = $food_row['image_name'];
        ?>
        <div class="food-menu-box">
            <div class="food-menu-img">
                <img src="<?php echo SITEURL; ?>images/food/<?php echo $food_image; ?>" alt="<?php echo $food_title; ?>" class="img-responsive img-curve">
            </div>
            <div class="food-menu-desc">
                <h4><?php echo $food_title; ?></h4>
                <p class="food-price">₹<?php echo $food_price; ?></p>
                <p class="food-detail"><?php echo $food_description; ?></p>
                <br>
                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $food_id; ?>" class="btn btn-primary">Order Now</a>

            </div>
        </div>
        <?php
            }
        } else {
            // Food items not available
            echo "<div class='error'><p>Sorry! No Food Available Right Now.</p></div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="<?php echo SITEURL ; ?>foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php 
include('partials-front/footer.php');
?>
