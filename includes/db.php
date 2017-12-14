<?php 

// connect to cms database
$connection = mysqli_connect('localhost', 'root', 'root', 'cms');

if($connection) {
	echo "We are connected";
} else {
	echo "No connection";
}


?>