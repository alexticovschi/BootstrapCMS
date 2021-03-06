<?php include("includes/header.php"); ?>

    <!-- Navigation -->
    <?php include("includes/navigation.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8 mt-5">
                
                <?php

                if(isset($_POST['submit'])) {
                    $search = $_POST['search'];
                    // select all from posts where post_tags are like our SEARCH 
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                    $search_query = mysqli_query($connection, $query);

                    if(!$search_query) {
                        die("Query Failed: " . mysqli_error($connection));
                    }

                    $count = mysqli_num_rows($search_query);

                    if($count == 0) {
                        echo "<h1>No Result</h1>";
                    } else {

                        while($row = mysqli_fetch_assoc($search_query)) {
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
        

                        <?php }  // close the loop
                            
                        }
                } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include("includes/sidebar.php"); ?>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<!-- Footer -->
<?php include("includes/footer.php"); ?>

