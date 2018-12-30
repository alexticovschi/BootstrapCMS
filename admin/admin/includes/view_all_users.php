
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
       
    <?php

    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);

    confirm_query($select_users);

    while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id']; 
        $username = $row['username']; 
        $user_firstname = $row['user_firstname']; 
        $user_lastname = $row['user_lastname']; 
        $user_email = $row['user_email']; 
        $user_role = $row['user_role']; 
        // $user_date = $row['user_date']; 



        echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>"; 
            echo "<td>$user_email</td>";   
            echo "<td>$user_role</td>";  
            // echo "<td>$user_date</td>";
            echo "<td><a href='users.php?admin=$user_id'>Admin</a></td>";
            echo "<td><a href='users.php?subscriber=$user_id'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
            echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";                                                        
        echo "</tr>";
    } 

    ?>



    <?php

    if(isset($_GET['delete'])) {

        if($_SESSION['user_role']) {

            if($_SESSION['user_role'] === 'admin') {
                $this_user_id = mysqli_real_escape_string($_GET['delete']);

                $query = "DELETE FROM users WHERE user_id = $this_user_id";
                $delete_user = mysqli_query($connection, $query);

                confirm_query($delete_user);
                header("Location: users.php");
            }
        }
    }

    ?>



    <?php 

    if(isset($_GET['admin'])) {
        $this_user_id = $_GET['admin'];

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $this_user_id ";

        $update_user_role = mysqli_query($connection, $query);

        confirm_query($update_user_role);

        header("Location: users.php");
    }   


    if(isset($_GET['subscriber'])) {
        $this_user_id = $_GET['subscriber'];

        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $this_user_id ";

        $update_user_role = mysqli_query($connection, $query);

        confirm_query($update_user_role);

        header("Location: users.php");
    } 

    ?>

    
    </tbody>
</table>








