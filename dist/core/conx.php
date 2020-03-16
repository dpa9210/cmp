<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "cmpdb";
$link = mysqli_connect("$servername", "$username", "$password", "$database");
if(mysqli_connect_error()){
	echo "An error has occurred";
	exit();
	}
?>