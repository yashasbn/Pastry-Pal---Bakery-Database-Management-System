<?php 
include('partials-front/menu.php');
?>

<section class="food-search text-center">
    <div class="container">
    <form action="<?php echo SITEURL; ?>/food-search.php" method="POST">

            <input type="search" name="search" placeholder="Search for what you love.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Bakery Items</h2>

        <?php 
        // Create SQL query to display categories from the database
        $sql = "SELECT * FROM tbl_category WHERE active='yes'";
        // Execute the query
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0) {
            // Categories available
            while ($row = mysqli_fetch_assoc($res)) {
                // Get values like image name and title
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
                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                <?php } ?>

                <!--<h3 class="float-text text-white"><?php echo $title; ?></h3>-->
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


<?php 
include('partials-front/footer.php');
?>
