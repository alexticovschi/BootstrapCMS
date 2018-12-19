<?php include("includes/admin_header.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/admin_navigation.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            <?php 

                                $query = "SELECT comment_post_id FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $_GET['id']) ."";
                                $select_comment = mysqli_query($connection, $query);

                                confirm_query($select_comment);

                                while($row = mysqli_fetch_assoc($select_comment)) {
                                    $comment_post_id = $row['comment_post_id']; 
   
                                    $query = "SELECT post_title FROM posts WHERE post_id = $comment_post_id";
                                    $select_post_id = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_assoc($select_post_id)) {
                                        $post_title = $row['post_title'];
                                    }
                                }  
                                echo empty($post_title) ? '' : $post_title;   

                            ?>
                            <p class="text-muted" style="font-size: 18px;">Comments page</p>
                            <!-- <small><?php echo $_SESSION['username']; ?></small>  -->
                        </h3>


                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response to</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                                $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $_GET['id']) ."";
                                $select_comments = mysqli_query($connection, $query);

                                confirm_query($select_comments);

                                while($row = mysqli_fetch_assoc($select_comments)) {
                                    $comment_id = $row['comment_id']; 
                                    $comment_post_id = $row['comment_post_id']; 
                                    $comment_author = $row['comment_author'];
                                    $comment_email = $row['comment_email']; 
                                    $comment_content = $row['comment_content']; 
                                    $comment_status = $row['comment_status']; 
                                    $comment_date = $row['comment_date']; 

                                    echo "<tr>";
                                        echo "<td>$comment_id</td>";
                                        echo "<td>$comment_author</td>";
                                        echo "<td>$comment_content</td>";
                                        echo "<td>$comment_email</td>"; 
                                        echo "<td>$comment_status</td>";


                                        // RELATE COMMENTS TO POSTS
                                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                        $select_post_id = mysqli_query($connection, $query);

                                        while($row = mysqli_fetch_assoc($select_post_id)) {
                                            $post_id = $row['post_id'];
                                            $post_title = $row['post_title'];
                                            $title = $post_title;
                                            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                        }

                                            
                                        echo "<td>$comment_date</td>";  
                                        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                                        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                                        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";                                                        
                                    echo "</tr>";
                                }     

                            ?>
                        </tbody>
                    </table>

                    <?php 

                    unapprove_comment();

                    approve_comment();  

                    ?>



                    <?php delete_comment(); ?>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>







