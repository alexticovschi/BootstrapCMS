<?php 

$db['db_host'] = "localhost"; // hostname
$db['db_user'] = "root"; 	  // username
$db['db_pass'] = "root"; 	  // MySQL password
$db['db_name'] = "cms"; 	  // database name

foreach($db as $key => $value) {
	define(strtoupper($key), $value);
}


// connect to cms database
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($connection) {
	echo "We are connected";
} else {
	echo "No connection";
}


?>