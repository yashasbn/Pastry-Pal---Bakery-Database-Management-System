<?php 
include('partials-front/menu.php');
?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php 
// Get the Search keyword
$search = $_POST['search'];
        ?>
        <!--<h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>-->
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menu</h2>

        <?php 
        
        
        // SQL query to get food based on the search keyword
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($result);

        // Check if food is available or not
        if ($count > 0) {
            // Food available
            while ($row = mysqli_fetch_assoc($result)) {
                // Get the details: id, title, price, description, image_name
                $title = $row["title"];
                $price = $row["price"];
                $description = $row["description"];
                $image_name = $row["image_name"];
                $food_id = $row["id"];
                ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php 
                        // Check the presence of image
                        if ($image_name == '') {
                            // Image not available
                            echo "<div class='error'>Image not available</div>";
                        } else {
                            // Image available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">₹<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $food_id;?>" class="btn btn-primary">Order Now</a>

                    </div>
                </div>
                
                <?php
            }
        } else {
            // Food unavailable
            echo "<div class='error'>No Food Found.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>

   

</section>
<!-- fOOD Menu Section Ends Here -->

<?php 
include('partials-front/footer.php');
?>
