<?php

    $u_id = $_GET['u_id']; // get the user id from the url
    
    if(isset($_GET['u_id'])) {
        $query = "SELECT * FROM users WHERE user_id = $u_id ";
        $select_users = mysqli_query($connection, $query);

        confirm_query($select_users);

        while($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id']; 
            $username = $row['username']; 
            $user_firstname = $row['user_firstname']; 
            $user_lastname = $row['user_lastname']; 
            $user_email = $row['user_email']; 
            $user_role = $row['user_role']; 
            $user_password = $row['user_password']; 

        }
    }



?>




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
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>

</form>