<?php  include "includes/header.php"; ?>


<?php 

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {

        $username = mysqli_real_escape_string($connection, $username);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $email    = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));


        // $query = "SELECT randSalt FROM users";
        // $select_randsalt_query = mysqli_query($connection, $query);

        // confirm_query($select_randsalt_query);

        // $row = mysqli_fetch_assoc($select_randsalt_query);
        // $salt = $row['randSalt'];

        $query  = "INSERT INTO users ";
        $query .= "(username, user_firstname, user_lastname, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}', '{$firstname}', '{$lastname}', '{$email}', '{$password}', 'subscriber') ";

        $register_user = mysqli_query($connection, $query);

        confirm_query($register_user);   
     
        $message = "<h4 class='text-center' style='background-color:#295cad;color:#fff;padding:8px; font-weight:bold; border-radius:4px'>Your Registration has been submitted</h4>"; 

    } else if(empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($password)){

        $message = "<h4 class='text-center' style='background-color:red; color:#fff;padding:8px; font-weight:bold; border-radius:4px'>Fields cannot be empty</h4>";;

    }
} 

?>



<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
    

<!-- Page Content -->
    <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 mx-auto mt-5">
                    <div class="form-wrap">
                        <h1 class="text-center">Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div id="message"><?php if(isset($message)) echo $message; ?></div>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="sr-only">firstname</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter FirstName">
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="sr-only">lastname</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter LastName">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>
                    
                            <input type="submit" name="submit" id="btn-login" class="btn read-more btn-lg btn-block" value="Register">
                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div>

<?php include "includes/footer.php";?>
