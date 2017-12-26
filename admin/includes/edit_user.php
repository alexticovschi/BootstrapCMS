
<form action="" method="post" enctype="multipart/form-data">

    <div class ="form-group">
        <label for ="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class ="form-group">
        <label for ="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>


    <div class ="form-group">
        <label for ="user_role">User Role</label>
        <br>
        <select name="user_role" id="">

            <?php

            // $query = "SELECT * FROM users";
            // $select_user_role = mysqli_query($connection, $query);

            // confirm_query($select_user_role);

            // while($row = mysqli_fetch_assoc($select_user_role)) {
            //     $user_id   = $row['user_id'];
            //     $user_role = $row['user_role'];

            //     echo "<option value='$user_id'>{$user_role}</option>";
            // }


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
        <input type="text" class="form-control" name="username">
    </div>

    <div class ="form-group">
        <label for ="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class ="form-group">
        <label for ="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
    </div>

</form>