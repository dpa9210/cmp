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
<?php
if(isset($_POST['update'])){
$title = $_POST["adtitlefld"];
$desc = $_POST["addescfld"];
$price = $_POST["adpricefld"];
$upid = $_POST["Xvhgvh"];
$sql = "UPDATE ads SET ad_title='$title', ad_description='$desc', ad_price='$price' WHERE ad_id = '$upid'";
if(mysqli_query($link, $sql)){

	header('location:account.php?reply='.urlencode(base64_encode("Data update successfull.")));

}else{
	header('Refresh:0; url=account.php?reply='.urlencode(base64_encode("An internal error has occurred, try again.")));
}}

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
<title>Edit | Corpers Market Place</title>
<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

<link rel="stylesheet" href="../dist/css/cmp.css">
<link rel="stylesheet" href="../dist/css/btc.css">
<link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
<div class="container" style="background-color:#FFF">
<div class="row">
<div class="col-md-6">
<span class="glyphicon glyphicon-home"><a href="../index.php"> Main</a></span><hr>
<uL class='breadcrumb'>
	<li><a href="index.php">Home</a></li>
	<li><a href="account.php">My account</a></li>
	<li><a href="edit.php" class="active">Edit Ad</a></li>
</uL>	
<?php  
include("user-menu.php");
echo "<a class='btn btn-success btn-xs' href='new-ad.php'>"."New Ad"."</a>";
?>
<hr>
<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])){ 
$id = $_GET['id'];
$sql = mysqli_query($link, "SELECT * FROM ads WHERE ad_id = '$id'");
$rows = mysqli_fetch_array($sql);}
?>
<div class="panel panel-info">
	<div class="panel-heading">Edit ad information</div>
	<div class="panel-body">
		<form name="editad" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="titlefld">Name</label>
		<input autofocus type="text" class="form-control" name="adtitlefld" value="<?php echo $rows['ad_title'] ?>">
		<br>
		<label for="addesc">Description</label>
		<textarea class="form-control" name="addescfld" maxlength="200"><?php echo $rows['ad_description'] ?></textarea>
		<br>
		<label for="adprice">Price</label>
		<div class="input-group">
		<span class="input-group-addon">₦</span>
		<input class="form-control" type="number" name="adpricefld" value="<?php echo $rows['ad_price'] ?>">
		</div>
		<input type="hidden" name="Xvhgvh" value="<?php echo $rows['ad_id'] ?>">
		<br>
		<input type="submit" class="form-control btn btn-success" value="Update" role="button" name="update">	
		</form>


	</div>
</div>

</div>	
<div class="col-md-6"></div>
</div>	
</div>


</body>
</html>