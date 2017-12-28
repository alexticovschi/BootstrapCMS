<?php include("includes/admin_header.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/admin_navigation.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?php

                if(isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $query = "SELECT * FROM users WHERE username = '{$username}' ";
                    $select_user_profile = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_user_profile)) {
                        $user_id       = $row['user_id'];
                        $username       = $row['username']; 
                        $user_firstname = $row['user_firstname']; 
                        $user_lastname  = $row['user_lastname']; 
                        $user_email     = $row['user_email']; 
                        $user_role      = $row['user_role'];
                        $user_password  = $row['user_password'];
                    }
                } 

                ?>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
        

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class ="form-group">
                                <label for ="firstname">Firstname</label>
                                <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
                            </div>

                            <div class ="form-group">
                                <label for ="lastname">Lastname</label>
                                <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
                            </div>


                            <div class ="form-group">
                                <label for ="user_role">User Role</label>
                                <br>
                                <select name="user_role" id="">
                                  <option value="<?php echo $user_role; ?>"><?php echo ucfirst($user_role); ?></option>
                                 
                                  <?php
                                 
                                      $roles = ["admin", "subscriber"];
                                     
                                      foreach ($roles as $role) {
                                        if ($role !== $user_role) {
                                          echo "<option value='{$role}'>" . ucfirst($role) . "</option>";
                                        }
                                      }
                                 
                                  ?>

                                </select>
                            </div>



                        <!-- 
                            <div class ="form-group">
                                <label for ="user_image">User Image</label>
                                <input type="file" name="image">
                            </div> -->

                            <div class ="form-group">
                                <label for ="username">Username</label>
                                <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
                            </div>

                            <div class ="form-group">
                                <label for ="user_email">Email</label>
                                <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
                            </div>

                            <div class ="form-group">
                                <label for ="user_password">Password</label>
                                <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_user" value="Update Profile">
                            </div>

                        </form>



                        

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include("includes/admin_footer.php"); ?>