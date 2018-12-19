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

                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                }

                                $query = "SELECT comment_post_id FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $id) ."";
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

                                $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $id) ."";
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
                                        echo "<td><a href='post_comments.php?approve=$comment_id&id=" .  $id . "'>Approve</a></td>";
                                        echo "<td><a href='post_comments.php?unapprove=$comment_id&id=" .  $id . "'>Unapprove</a></td>";
                                        echo "<td><a href='post_comments.php?delete=$comment_id&id=". $id ."'>Delete</a></td>";                                                        
                                    echo "</tr>";
                                }     

                            ?>
                        </tbody>
                    </table>

                    <?php 

                    // UNAPPROVE COMMENT
                    if(isset($_GET['unapprove'])) {
                        $comment_status = $_GET['unapprove'];

                        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_status ";
                        $update_comment_status = mysqli_query($connection, $query);

                        confirm_query($update_comment_status);

                        header("Location: post_comments.php?id=" . $id ."");
                    }    
                

                    // APPROVE COMMENT
                    if(isset($_GET['approve'])) {
                        $comment_status = $_GET['approve'];

                        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_status ";
                        $update_comment_status = mysqli_query($connection, $query);

                        confirm_query($update_comment_status);

                        header("Location: post_comments.php?id=" . $id ."");
                    }      
                

                    ?>



                    <?php 

                    if(isset($_GET['delete'])) {
                        $comment_id = $_GET['delete'];

                        $query = "DELETE FROM comments WHERE comment_id=$comment_id";
                        $delete_comment = mysqli_query($connection, $query);

                        confirm_query($delete_comment);

                        header("Location: post_comments.php?id=" . $id ."");

                    }

                    ?>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>







