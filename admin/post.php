<?php include("includes/header.php"); ?>

    <!-- Navigation -->
    <?php include("includes/navigation.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8 mt-5">
                
                <?php

                if(isset($_GET['p_id'])) {
                    $post_id = $_GET['p_id'];
                
                    $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
                    $send_query = mysqli_query($connection, $view_query);

                    if(!$send_query) { die("query failed"); }

                    $query = "SELECT * FROM posts WHERE post_id = $post_id";
                    $post_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($post_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_content = $row['post_content'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];

                    ?>    
                    
                    <!-- Blog Post -->
                    <div class="card mb-4">
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="card-img-top" src="images/<?php echo $post_image ?>" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <h2 class="card-title">
                                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                            </h2>
                            <p class="card-text"><?php echo $post_content; ?></p>
                        </div>
                        <div class="card-footer text-muted">
                            Posted by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a> on <?php echo $post_date; ?>
                        </div>
                    </div>

                    <?php } 

                } else {

                    header("Location: index.php");

                }
                ?> 


                <!-- Blog Comments -->
                <?php

                if(isset($_POST['create_comment'])) {
                    $post_id = $_GET['p_id'];

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = mysqli_escape_string($connection, $_POST['comment_content']);

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {                 

	                    $query  = "INSERT INTO comments ";
	                    $query .= "(comment_post_id, comment_author, comment_email, ";
	                    $query .= "comment_content, comment_status, comment_date) ";
	                    $query .= "VALUES ($post_id, '$comment_author', '$comment_email', ";
	                    $query .= "'$comment_content', 'unapproved', now())";

	                    $insert_comment = mysqli_query($connection, $query);
	                    confirm_query($insert_comment);

	                    // $query  = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
	                    // $query .= "WHERE post_id = $post_id ";

	                    // $update_post_comment_count = mysqli_query($connection, $query);
	                    // confirm_query($update_post_comment_count);

                	}  else {
                		?>
						
						<script>
							alert('Fields cannot be empty!');
						</script>

                		<?php
                	}
                }

                ?>


                <!-- Comments Form -->
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form id="comments_form" action="" method="post" role="form">
                            <div class="form-group">
                                <label for="Author">Author</label>
                                <input class="form-control" type="text" name="comment_author">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input class="form-control" type="email" name="comment_email">
                            </div>
                            <div class="form-group">
                                <label for="comment">Your Comment</label>
                                <textarea name="comment_content" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" name="create_comment" class="btn btn-submit">Submit</button>
                        </form>
                    </div>
                </div>


                <!-- Posted Comments -->
                <?php 

                // DISPLAY COMMENTS BASED ON APPROVAL
                $query  = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";

                $select_comment = mysqli_query($connection, $query);

                confirm_query($select_comment);

                while($row = mysqli_fetch_assoc($select_comment)) {
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];

                ?>


                <!-- Comment -->
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo $comment_author; ?> <span class="badge badge-light" style="font-size: 14px; color: #888"><?php echo $comment_date; ?></span></h5> 
                        <?php echo $comment_content; ?>                    
                    </div>
                </div>

                
                <?php } ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include("includes/sidebar.php"); ?>


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<!-- Footer -->
<?php include("includes/footer.php"); ?>
