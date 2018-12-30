<?php include("includes/header.php"); ?>

    <!-- Navigation -->
    <?php include("includes/navigation.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8 mt-5">
                
                <?php

                if(isset($_GET['category'])) {
                    $post_cat_id = $_GET['category'];
                }

                $query = "SELECT * FROM posts WHERE post_category_id = $post_cat_id";
                $post_query = mysqli_query($connection, $query);

                if(empty($count = mysqli_num_rows($post_query))) {
                    echo "<h2 style='padding: 100px; text-align: center; border: 2px solid grey;'>No Posts from this Category</h2>";
                }
                while($row = mysqli_fetch_assoc($post_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];

                ?>    

                <!-- Blog Post -->
                <div class="card mb-4 post">
                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                        <img class="card-img-top" src="images/<?php echo $post_image ?>" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <h2 class="card-title">
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="card-text"><?php echo $post_content; ?></p>
                            <a href="post.php?p_id=<?php echo $post_id; ?>" class="btn read-more">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a> on <?php echo $post_date; ?>
                    </div>
                </div>
    

                <?php } ?> <!-- close the loop -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include("includes/sidebar.php"); ?>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<!-- Footer -->
<?php include("includes/footer.php"); ?>

