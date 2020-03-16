<?php 
//start session
session_start();
//create coonection
require("../dist/core/conx.php"); 
//check if session variable is set
if(!isset($_SESSION['email']) || $_SESSION['authorize']!= "true"){

	//$error =  "<p style='color:Red; font-size:15px;'>"."Login with your email and password"."</p>";
	//header("Refresh:0; url=index.php");
	header('location:index.php?msg='.urlencode(base64_encode("Login with your email and password")));
	die();

}else{
	header("Content-Type: text/html; charset= utf-8");
	$emsessvar = $_SESSION['email'];
}


?>
<?php

	//update the recrd in odatabase
	$sql = "DELETE FROM users WHERE user_email ='$emsessvar'";
	if(mysqli_query($link, $sql)){
		header('location:index.php?reply='.urlencode(base64_encode("Account delete successful. We hope you can use this service again by registering with your email")));
		session_destroy();
		
	}else{
		header('location:account.php?reply='.urlencode(base64_encode("An error has occurred, try again.")));
	}
	
	$link->close();
    	

 ?>