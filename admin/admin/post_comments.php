<?php include("includes/admin_header.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/admin_navigation.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <h2 class="text-center">Admin Post Comments Page</h2>

                        <?php 

                        if(isset($_GET['id']) && !empty($_GET['id'])) {
                            $id = $_GET['id'];

                            $comment_post_id = mysqli_real_escape_string($connection, $id);

                            $query = "SELECT * FROM posts WHERE post_id = '$comment_post_id'";
                            $select_comment_post_query = mysqli_query($connection, $query);
                            
                            while($row = mysqli_fetch_assoc($select_comment_post_query)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                                $post_status =  $row['post_status'];
    

                        ?>

                        <!-- Blog Post -->
                        <div class="col-md-2"></div>

                        <div class="col-md-8">
        
                            <?php echo "<h4>Post Id:<span style='font-weight:bold'>&nbsp;{$post_id}</span></h4><h4>Post status:<span style='font-weight:bold'>&nbsp;{$post_status}</span></h4>"; ?>
                           
                                
                            <h3>
                                <a href="../post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                            </h3>
                            <p class="lead">
                                by <a href="../author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                            <hr>
                            <p><?php echo $post_content; ?></p>

                            <hr>
                        </div>
                        <div class="col-md-2"></div>
                    </div>



                    <?php }

                    $query = "SELECT * FROM comments WHERE comment_post_id = '$comment_post_id' ORDER BY comment_id DESC ";
                    $select_all_comments = mysqli_query($connection, $query);
                    $total_comments = mysqli_num_rows($select_all_comments);

                    if ($total_comments > 0) {

                    ?>
                    <h3>Total Comments: <?php echo $total_comments; ?></h3>
                    <div class="row">
                        <table class="table table-bordered table-hover">
                        <thead>
                           <tr>
                            <td>Id</td>
                            <td>Author</td>
                            <td>Comment</td>
                            <td>Email</td>
                            <td>Status</td>
                            <td>Date</td>
                            <td>Approve</td>
                            <td>Unapprove</td>
                            <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody> 
                        <?php   } else { echo "<h2 class='text-center'>There are no comments to display for this post.</h2>"; } 


                        while($row = mysqli_fetch_assoc($select_all_comments)) {
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
                                

                                echo "<td>{$comment_date}</td>";
                                
                                echo "<td><a class='btn-sm btn-success' href='post_comments.php?approve=$comment_id&id=" .  $id . "'>Approve</a></td>";
                                echo "<td><a class='btn-sm btn-warning' href='post_comments.php?unapprove=$comment_id&id=" .  $id . "'>Unapprove</a></td>";
                                echo "<td><a class='btn-sm btn-danger' href='post_comments.php?delete=$comment_id&id=". $id ."'>Delete</a></td>";
                                echo "</tr>";
                            }
                        

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
                        


                            if(isset($_GET['delete'])) {
                                $comment_id = $_GET['delete'];

                                $query = "DELETE FROM comments WHERE comment_id=$comment_id";
                                $delete_comment = mysqli_query($connection, $query);

                                confirm_query($delete_comment);

                                header("Location: post_comments.php?id=" . $id ."");

                            }

                        } else { echo "<h2 class='text-center'>No matching post.</h2>"; }

                    ?>
                        </tbody>
                    </table> 
                                      
                   </div>
                </div>
                <!-- /.row -->
 
            </div>
            <!-- /.container-fluid -->
        </div>
 
      <?php include "includes/admin_footer.php"; ?>

                    