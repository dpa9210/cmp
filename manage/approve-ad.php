<?php 
//start session
session_start();
//create coonection
require("../dist/core/conx.php"); 
//check if session variable is set
if(!isset($_SESSION['email']) || $_SESSION['authorize']!= "true"){

	//$error =  "<p style='color:Red; font-size:15px;'>"."Login with your email and password"."</p>";
	//header("Refresh:0; url=index.php");
	header('Refresh:0; url=index.php?msg='.urlencode(base64_encode("Login with your email and password")));
	die();

}else{
	header("Content-Type: text/html; charset= utf-8");
	$emsessvar = $_SESSION['email'];
}

?>

<?php

//confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id'])){
	
	//get the 'id' variable from the url
	$id = $_GET['id'];
	//update the record in database
	if($stmt = $link->prepare("UPDATE ads SET ad_status = '1' WHERE ad_id = ? LIMIT 1")){
		
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->close();
	} else{
		
		echo "ERROR: could not execute.";
	}
	$link->close();
	//redirect user after the update is suceesful
	echo "Product Status now approved";
	header("Refresh: 2;url=unapproved-ads.php");
	
	} else{
		//if the id variable isnt sent set, redirect the user.
		echo "An error has occurred!";
		
		header("Refresh: 2;url=unapproved-ads.php");
		
    	
	}



 ?>