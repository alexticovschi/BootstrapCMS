<?php include("includes/admin_header.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/admin_navigation.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        
                        <div class="col-xs-6">

                            <?php  
                            // check if the user has submitted some value and store the value in the $cat_title variable 
                            // if the input field is empty, inform the user, else insert the value into categories table
                            // and then check if the query was successful; if it wasn't, kill the script and display the error
                            if(isset($_POST['submit'])) {
                                $cat_title = $_POST['cat_title'];

                                if(trim($cat_title == "") || empty($cat_title)) {
                                    echo "This field should not be empty";
                                } else {
                                    $query = "INSERT INTO categories (cat_title) VALUES ('{$cat_title}')";

                                    $category_query = mysqli_query($connection, $query);

                                    if(!$category_query) {
                                        die('Query Failed: ' . mysqli_error($connection));
                                    }
                                }
                            }

                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title"> 
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category"> 
                                </div>                              
                            </form>
                        </div>

                        <div class="col-xs-6">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php  // FIND ALL CATEGORIES

                                    $query = "SELECT * FROM categories";
                                    $select_categories = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_assoc($select_categories)) {
                                        $cat_id = $row['cat_id'];                               
                                        $cat_title = $row['cat_title'];

                                        echo "<tr>";
                                            echo "<td>{$cat_id}</td>";
                                            echo "<td>{$cat_title}</td>";
                                            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>"; 
                                        echo "</tr>";

                                    }

                                    ?>
                                    
                                    <?php // DELETE CATEGORIES 
                                    // if there is a delele key in the url, and its value is identical with ...
                                    // the id from the categories table, delete that category
                                    // then refresh the page
                                    if(isset($_GET['delete'])) {
                                        $the_cat_id = $_GET['delete'];
                                        $query = "DELETE FROM categories WHERE cat_id = '{$the_cat_id}' ";
                                        $delete_query = mysqli_query($connection, $query);
                                        header("Location: categories.php"); 
                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>