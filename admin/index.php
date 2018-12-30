<?php include("includes/header.php"); ?>


    <!-- Navigation -->
    <?php include("includes/navigation.php"); ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8 mt-5">

            <?php

            $per_page = 6;

            isset($_GET['page']) ? $page = $_GET['page'] : $page = '';
            ($page == "" || $page == 1) ? $page_1 = 0 : $page_1 = ($page * $per_page) - $per_page;
                

            $post_count = "SELECT * FROM posts";
            $total_posts = mysqli_num_rows(mysqli_query($connection, $post_count));
            $total_posts = ceil($total_posts / $per_page);


            $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";
            $posts_query = mysqli_query($connection, $query);

            if (mysqli_num_rows($posts_query) == 0) {
                echo "<h3 style='padding: 100px; text-align: center; border: 2px solid grey; '> No Posts</h3>";
            }

            while($row = mysqli_fetch_assoc($posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_content = substr($row['post_content'], 0, 265) . '...';
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_status = $row['post_status'];

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

          <?php } ?>

        </div>

        <!-- Sidebar Widgets Column -->
        <?php include("includes/sidebar.php"); ?>

      </div>
      <!-- /.row -->

      <ul class="pagination pagination-md justify-content-center">
          <?php 
                  
              for($i = 1; $i <= $total_posts; $i++) {
                  if($i == $page) {
                      echo "<li class='page-item'><a class='page-link active_link' href='index.php?page={$i}'>{$i}</a></li>";
                  } else { 
                      echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                  }
              }

          ?>
      </ul>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include("includes/footer.php"); ?>
    