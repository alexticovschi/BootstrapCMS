<?php include("includes/admin_header.php"); ?>

    <div id="wrapper">

    <?php 

    $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $count = mysqli_num_rows(mysqli_query($connection, $query));

    $session_query = "INSERT INTO users_online(session, time) VALUES('$session', '$time')";
    if($count == NULL) {
        mysqli_query($connection, $session_query);    
    } 


    ?>


        <!-- Navigation -->
        <?php include("includes/admin_navigation.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['username']; ?></small>

                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->                            
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <?php 

                                    $query = "SELECT * FROM posts";
                                    $select_all_posts = mysqli_query($connection, $query);

                                    $post_count = mysqli_num_rows($select_all_posts);
                                    echo "<div class='huge'>$post_count</div>";

                                    if($post_count > 1) {
                                        echo "<div>Posts</div>";
                                    } else {
                                        echo "<div>Post</div>";
                                    }

                                    ?>

                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <?php 

                                    $query = "SELECT * FROM comments";
                                    $select_all_comments = mysqli_query($connection, $query);

                                    $comment_count = mysqli_num_rows($select_all_comments);
                                    echo "<div class='huge'>$comment_count</div>";

                                    if($comment_count > 1) {
                                        echo "<div>Comments</div>";
                                    } else {
                                        echo "<div>Comment</div>";
                                    }

                                    ?>

                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <?php 

                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query($connection, $query);

                                    $user_count = mysqli_num_rows($select_all_users);
                                    echo "<div class='huge'>$user_count</div>";

                                    if($user_count > 1) {
                                        echo "<div>Users</div>";
                                    } else {
                                        echo "<div>User</div>";
                                    }

                                    ?>

                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <?php 

                                    $query = "SELECT * FROM categories";
                                    $select_all_categories = mysqli_query($connection, $query);

                                    $category_count = mysqli_num_rows($select_all_categories);
                                    echo "<div class='huge'>$category_count</div>";

                                    if($category_count > 1) {
                                        echo "<div>Categories</div>";
                                    } else {
                                        echo "<div>Category</div>";
                                    }

                                    ?>

                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <?php 

                $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                $published_posts = mysqli_query($connection, $query);
                $post_published_count = mysqli_num_rows($published_posts);

                $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
                $draft_posts = mysqli_query($connection, $query);
                $post_draft_count = mysqli_num_rows($draft_posts);

                $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                $unapproved_comments = mysqli_query($connection, $query);
                $unapproved_comment_count = mysqli_num_rows($unapproved_comments);

                $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
                $subscribers = mysqli_query($connection, $query);
                $subscriber_count = mysqli_num_rows($subscribers);

                ?>
    



                <div class="row">
                    
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Data', 'Count'],
                        
                            <?php 

                            $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                            $element_count = [$post_count, $post_published_count, $post_draft_count,  $comment_count,  $unapproved_comment_count, $user_count, $subscriber_count, $category_count];

                            for($i = 0; $i < 8; $i++) {
                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            } 

                            ?>


                          
                        ]);

                        var options = {
                          chart: {
                            title: '',
                            subtitle: '',
                          }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>                
                    
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

                </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>
