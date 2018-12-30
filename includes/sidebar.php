
<div class="col-md-4 mt-4">

    <!-- Search Widget -->
    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <form action="search.php" method="post">
                <div class="input-group">
                    <input name="search" type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-submit" type="submit">Go!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <!-- LOGIN -->
    <div class="card my-4">
        <h5 class="card-header">Login</h5>
        <div class="card-body">
            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Enter username">
                </div>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter password">
                    <span class="input-group-btn">
                        <button class="btn btn-submit" name="login" type="submit">Submit</button>
                    </span>
                </div>
            </form>
            <!-- /.input-group -->
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                    <?php  

                        $query = "SELECT * FROM categories";
                        $category_sidebar = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($category_sidebar)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "<li class='category'><a href='categories.php?category=$cat_id'>{$cat_title}</a></li>";

                        }

                    ?> 
                </ul>
            </div>
        </div>
    </div>
    </div>

    <!-- Side Widget -->
    <?php include("includes/widget.php") ?>


</div>