<?php 
session_start();
require_once("../dist/core/conx.php");
ob_start();
if(!isset($_SESSION['authorize']) || $_SESSION['authorize']!="true"){
header('Content-Type:text/html; charset=utf-8');
}else{
header("Location:account");
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
<title>User login | Corpers Market Place</title>
<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../dist/css/cmp.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<script src="../dist/js/jquery.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
</head>
<body style="margin-top:10px; margin-bottom:auto;">
<div class="container" style="background-color:#FFF">
<span class="glyphicon glyphicon-home"><a href="../index.php"> Main</a></span>
<hr>
<uL class='breadcrumb'>
<li><a href="index.php">Home</a></li>
</uL>
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<br>
<?php 
function writeToLog1(){
$email1 = $_POST['emailfld'];
$file = fopen("../log/userlog.txt", "a");
$contentToWrite = " \n $email1 " .  date("l d-m-Y ") . date('h:i:sa')." Success";
fwrite($file, $contentToWrite);
fclose($file);
}
function writeToLog2(){
$email2 = $_POST['emailfld'];
$file = fopen("../log/userlog.txt", "a");
$contentToWrite = " \n $email2 " .  date("l d-m-Y ") . date('h:i:sa')." Fail";
fwrite($file, $contentToWrite);
fclose($file);
}
?>
<?php 
$error= '';
if(isset($_POST['loginBtn'])){
$email = mysqli_real_escape_string($link, $_POST['emailfld']);
$passwd = mysqli_real_escape_string($link, $_POST['passwordfld']);
$query = "SELECT user_email, user_password FROM users WHERE user_email = '$email' AND user_password = '$passwd'";
$result = mysqli_query($link, $query);
$count = mysqli_num_rows($result);
if($count ==1){
$_SESSION['email'] = $email;
$_SESSION['authorize'] = "true";
header("Location:account");
ob_flush();
writeToLog1();
}else{
header('Location:index.php?reply='.urlencode(base64_encode("Invalid email or password, try again.")));
writeToLog2();
}
}
?>
<?php
if (!empty($_GET['reply'])){
echo "<div class='alert alert-danger' role='alert'>";
echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
echo "<span class='sr-only'>Error:</span>";
echo base64_decode(urldecode($_GET['reply']));
echo "</div>";}
?>
<span class="errormsg"><?php echo $error; ?></span>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<fieldset> 
<legend>Login Details</legend>
<div class="input-group input-group-md">
<span class="input-group-addon">
<span class="glyphicon glyphicon-envelope"></span>
</span>
<input class="form-control" autofocus type="email" name="emailfld" placeholder="Your email"><br>
</div><br>
<div class="input-group input-group-md">
<span class="input-group-addon">
<span class="glyphicon glyphicon-lock"></span>
</span>
<input class="form-control" type="password" name="passwordfld" placeholder="Password">
</div><br>
<input class="form-control btn btn-success btn-sm" type="submit" value="login" name="loginBtn" id="loginBtn1";>
<p class="center" style="color:Brown;"><a href="register">register an account </a> | <a href="recover-account">recover account</a></p>
</fieldset>
</form>
<hr>
</div>
<div class="col-md-4"></div>
</div>
</div>
</body>
</html>