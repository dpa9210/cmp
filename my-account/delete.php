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
	$sql = "DELETE FROM ads WHERE ad_id = '$id' AND ad_email ='$emsessvar'";
	if($link->query($sql)===TRUE){
		header('location:account.php?reply='.urlencode(base64_encode("Delete successful.")));
	}else{
		header('location:account.php?reply='.urlencode(base64_encode("An error has occurred, try again.")));
	}
	
	$link->close();
    	
	}



 ?>