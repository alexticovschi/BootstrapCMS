<?php include("db.php"); ?>
<?php include("../admin/functions.php"); ?>


<?php 

if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);

	$query = "SELECT * FROM users WHERE username = '$username' ";
	$select_user = mysqli_query($connection, $query);

	confirm_query($select_user);

	while($row = mysqli_fetch_assoc($select_user)) {
		echo $user_id = $row['user_id'];
		echo "<br>";
		echo $user_firstname = $row['user_firstname'];
		echo "<br>";
		echo $user_lastname = $row['user_lastname'];
	}

}



?>
