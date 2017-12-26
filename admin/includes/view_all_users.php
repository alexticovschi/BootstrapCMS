
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
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
            echo "<td><a href='users.php?edit=$user_id'>Edit</a></td>";
            echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";                                                        
        echo "</tr>";
    } 


    ?>
    
    </tbody>
</table>








