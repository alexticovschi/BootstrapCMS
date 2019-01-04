<?php include("db.php"); ?>
<?php include("../admin/functions.php"); ?>
<?php session_start(); ?>


<?php 

if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$username = escape($username);
	$password = escape($password);

	$query = "SELECT * FROM users WHERE username = '$username'";
	$select_user = mysqli_query($connection, $query);

	confirm_query($select_user);

	while($row = mysqli_fetch_assoc($select_user)) {
		$db_user_id = $row['user_id'];
		$db_user_password = $row['user_password'];
		$db_username = $row['username'];
		$db_user_firstname = $row['user_firstname'];
		$db_user_lastname = $row['user_lastname'];
		$db_user_role = $row['user_role'];
	}

	// if($username  === $db_username && $password === $db_user_password && $db_user_role === 'admin') {
	// 	$_SESSION['username'] = $db_username; // assign the $db_username value to the username session
	// 	$_SESSION['firstname'] = $db_user_firstname;
	// 	$_SESSION['lastname'] = $db_user_lastname;
	// 	$_SESSION['user_role'] = $db_user_role;

	// 	header("Location: ../admin");
	// } else {
	// 	header("Location: ../index.php");
	// }

	if(password_verify($password, $db_user_password) && $db_user_role === 'admin') {
		$_SESSION['username'] = $db_username; // assign the $db_username value to the username session
		$_SESSION['firstname'] = $db_user_firstname;
		$_SESSION['lastname'] = $db_user_lastname;
		$_SESSION['user_role'] = $db_user_role;
		
		header("Location: ../admin");
	} else {
		header("Location: ../index.php");
	}


}



?>
