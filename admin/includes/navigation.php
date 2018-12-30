
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Blog CMS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <?php  

                        // $query = "SELECT * FROM categories";
                        // $cat_query = mysqli_query($connection, $query);

                        // while($row = mysqli_fetch_assoc($cat_query)) {
                        //     $cat_title = $row['cat_title'];
                        //     echo "<li class='nav-item'><a class='nav-link' href='#'>{$cat_title}</a></li>";
                            // }


                        ?>


                        <li class='nav-item'>
                            <a class='nav-link' href="admin/index.php">Admin</a>
                        </li>

                        <li class='nav-item'>
                            <a class='nav-link' href="registration.php">Register</a>
                        </li>

                        <?php 

                        if(isset($_SESSION['user_role'])) {
                            if(isset($_GET['p_id'])) {
                                $post_id = $_GET['p_id'];
                                echo "<li class='nav-item'>
                                        <a class='nav-link' href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a>
                                    </li>";
                            }
                        }
                            
                        ?>
                    </ul>
                </div>
            </div>
        </nav>