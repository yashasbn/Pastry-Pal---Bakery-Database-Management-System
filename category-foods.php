<?php 
include('partials-front/menu.php');
?>

<?php 
    if(isset($_GET['category_id']))
    {
        // Category id is set, so we need to get the id
        $category_id = $_GET['category_id'];

        // Get category title based on the cat_id
        $sql = "SELECT title FROM tbl_category WHERE id='$category_id'";
        // Execute the query
        $res = mysqli_query($conn, $sql);
        
        // Fetch one row from the result of the query
        $row = mysqli_fetch_assoc($res);
        // Assign the fetched data to variables
        $category_title = $row['title'];

    }
    else
    {
        // Category not passed, redirect to home page
        header('location:' . SITEURL);
    }
?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <!--<h2>Foods on <a href="" class="text-white"><?php echo $category_title; ?></a></h2>-->
    </div>
</section>
<!-- FOOD SEARCH Section Ends Here -->

<!-- FOOD MENU Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menu</h2>

        <?php
        // New SQL query to get food items based on selected category
        $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

        // Execute query
        $res2 = mysqli_query($conn, $sql2);
        // Count rows
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                // Get title, description, price, image_name
                $id = $row2["id"];
                $title = $row2["title"];
                $description = $row2["description"];
                $price = $row2["price"];
                $image_name = $row2['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>No Image Available!</div>";
                        } else {
                            ?>
                            <!-- Image available -->
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Image food" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">₹ <?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>
                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
            }
        } else {
            // No food available
            echo "<h3 class='error'>No Food Available in this Category.</h3>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- FOOD MENU Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
