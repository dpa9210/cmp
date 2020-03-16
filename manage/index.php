<?php 
session_start();
require("../dist/core/conx.php"); 
if(!isset($_SESSION['email']) || $_SESSION['authorize']!= "true"){
	header("Content-Type: text/html; charset= utf-8");
	
}else{
	header('location:dashboard.php');
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
<title>Admin | Corpers Market Place</title>
<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../dist/css/cmp.css">
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<!--Scripts-->
<script src="../dist/js/jquery.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
</head>
<body>

<!--Conatiner-->
<div class="container" style="background-color:#FFF">

<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">

<h3>Administrator</h3>
<?php
if (!empty($_GET['reply'])){
		echo "<div class='alert alert-danger' role='alert'>";
		echo "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'>"."</span>";
		echo "<span class='sr-only'>Error:</span>";
        echo base64_decode(urldecode($_GET['reply']));
        echo "</div>";}

?>
<br>
<?php
function writeToLog1(){
	$email1 = $_POST['emailfld'];
	$file = fopen("../log/adlog.txt", "a");
	$contentToWrite = " \n $email1 " .  date("l d-m-Y ") . date('h:i:sa')." Success";
	fwrite($file, $contentToWrite);
	fclose($file);
}
function writeToLog2(){
	$email2 = $_POST['emailfld'];
	$file = fopen("../log/adlog.txt", "a");
	$contentToWrite = " \n $email2 " .  date("l d-m-Y ") . date('h:i:sa')." Fail";
	fwrite($file, $contentToWrite);
	fclose($file);
}
if(isset($_POST['loginBtn'])){
$email = mysqli_real_escape_string($link, $_POST['usernamefld']);
$passwd	 = mysqli_real_escape_string($link, $_POST['passwordfld']);
$query = "SELECT email, password FROM manager WHERE email = '$email' AND password = '$passwd'";
$result = mysqli_query($link, $query);
$check_user = mysqli_num_rows($result);
if($check_user==1){
	$_SESSION['email'] = $email;
	$_SESSION['authorize'] = "true";
	header("location:dashboard.php");
	writeToLog1();

}else{
	header('location:index.php?reply='.urlencode(base64_encode("Invalid email or password, try again.")));
	writeToLog2();
}
}

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<fieldset>
<legend>Login Details</legend>
<div class="input-group input-group-md">
<span class="input-group-addon">
<span class="glyphicon glyphicon-envelope"></span>
</span>
<input autofocus class="form-control" type="email" placeholder="Email" name="usernamefld">
</div>
<br>

<div class="input-group input-group-md">
<span class="input-group-addon">
<span class="glyphicon glyphicon-lock"></span>
</span>
<input class="form-control" type="password" placeholder="Password" name="passwordfld">
</div>
<br><br>
<input class="form-control btn btn-success" type="submit" value="login" name="loginBtn" >
<hr>
</fieldset>

</form>


</div>
<div class="col-md-4"></div>



</div><!--row end-->

<!--
<div class="panel-footer">
<p>&copy 2015 CMP | Privacy | Terms</p>
</div> -->

</div><!--container end-->

</body>
</html>