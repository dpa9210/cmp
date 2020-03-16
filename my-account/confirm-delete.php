<?php 
session_start();
require("../dist/core/conx.php");
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

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Corpers Market Place, Buying and Selling for Corpers">
<meta name="keywords" content="">
<meta name="author" content="wizedavis">
<title>My Account | Corpers Market Place</title>
<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../dist/css/cmp.css">
<link rel="stylesheet" href="../dist/css/btc.css">
<link rel="icon" href="../favicon.ico" type="image/x-icon">

<!--Scripts-->
<script src="../dist/js/jquery.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
<script src="../dist/js/btj.js"></script>
</head>
<body>
<!--Conatiner-->
<div class="container" style="background-color:#FFF">

<div class="row">
<div class="col-md-6">
<span class="glyphicon glyphicon-home"><a href="../index.php"> Main</a></span><hr>
<uL class='breadcrumb'>
	<li><a href="index.php">Home</a></li>
	<li><a href="account.php" >My account</a></li>
	<li><a href="#" >Confirm account delete</a></li>

</uL>

<?php  
include("user-menu.php");
?>
<p style="color:red">Are you sure you want to delete your account?<br>Note that deleting it will also remove all the ads you have posted and this process cannot be undone.</p><br>
<a class="btn btn-danger form-control" href="delete-account.php">Proceed</a>

</div>
<div class="col-md-3">


</div>
<div class="col-md-3"></div>



</div>



</div><!--row end-->


</div>

</body>
</html>