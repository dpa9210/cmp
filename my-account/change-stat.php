<?php 
session_start();
require("../dist/core/conx.php");
if(!isset($_SESSION['email']) || $_SESSION['authorize']!= "true"){

	
	header('Refresh:0; url=index.php?msg='.urlencode(base64_encode("Login with your email and password")));
	die();

}else{
	header("Content-Type: text/html; charset= utf-8");
	$emsessvar = $_SESSION['email'];

}
?>
<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])){ 
$id = $_GET['id'];
$sql = mysqli_query($link, "SELECT ad_status FROM ads WHERE ad_id = '$id'");
$rows = mysqli_fetch_array($sql);
if($rows['ad_status']<1){
	$sql2 = mysqli_query($link, "UPDATE ads SET ad_status = 1 WHERE ad_id = '$id'");
	header('location:account.php?reply='.urlencode(base64_encode("Your ad is now visible to public.")));
}else{
	$rows['ad_status']>0;
	$sql1 = mysqli_query($link, "UPDATE ads SET ad_status = 0 WHERE ad_id = '$id'");
	header('location:account.php?reply='.urlencode(base64_encode("Your ad is no longer visible.")));
}
}


?>