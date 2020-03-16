<?php 
 session_start();
 header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
require("../dist/core/conx.php");
//include('Mail.php');
$nicknameErr = $emailErr = $passwdErr = $passwdErr1 = "";
$errorMsg = "";
$successMsg = "";
//function to strip
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
//function for email

if(isset($_POST['newRegSubBtn'])){
	if(empty($_POST["nicknamefld"])){
		$nicknameErr = "Enter a nickname";
	}else{
		$nickname = test_input($_POST["nicknamefld"]);
		if(!preg_match("/^[a-zA-Z]*$/", $nickname)){
			$nicknameErr = "Can only contain letters, numbers and no spaces";
		}
	}
if(empty($_POST["emailfld"])){
	$emailErr = "Enter an email address";
}else{
	$email = test_input($_POST["emailfld"]);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$emailErr = "Invalid email format";
	}
}
if(empty($_POST["passwordfld"])){
	$passwdErr = "Enter a password";
}
else{
	$passwd = test_input($_POST["passwordfld"]);
}
if(empty($_POST["passwordfld1"])){
	$passwdErr1 = "Confirm password";
}else{
	$passwd1 = test_input($_POST["passwordfld"]);
}
if($_POST['passwordfld'] !== $_POST['passwordfld1']){
	$passwdErr1 = "Passwords don't match";
}

//send data
$nickname = $_POST['nicknamefld'];
$email = $_POST['emailfld'];
$passwd = $_POST['passwordfld'];
$ip = $_POST['ipfld'];
$date = $_POST['datefld'];

$new_error_msg = $nicknameErr."".$emailErr."".$passwdErr."".$passwdErr1;
if ($new_error_msg ==""){
	$query = "INSERT INTO users (user_nickname, user_email, user_password, user_ip, user_signupdate)VALUES(?,?,?,?,?)";
	$statement = $link->prepare($query);
	$statement->bind_param("sssss", $nickname, $email, $passwd, $ip, $date);
	if($statement->execute()){
		/**send email
			$username = 'noreply@cmp.com.ng';
			$password = 'davis@123';
			$to = "$email";
			$subject ="CMP Account Registration";
			$from = "noreply@cmp.com.ng";
			$body = 'Dear '.$_POST['nicknamefld'].', '."\n\n".'Thank you for registering with Corpers Market Place'."\n".
			'Your login id is: '.$_POST['emailfld']."\n".
			"\n\n".'CMP Administrator'."\n".'support@cmp.com.ng';
			$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject); // the email headers
			$smtp = Mail::factory('smtp', array ('host' =>'localhost', 'auth' => true, 'username' => $username, 'password' => $password, 'port' => '25'));
			$mail = $smtp->send($to, $headers, $body);*/
            header('location:register.php?reply='.urlencode(base64_encode("Registration successful. You may <a href='index.php'>login</a> with your email and password. <br>An email has been sent to you with your registration details.")));

		$nickname = "";
		$email = "";
		$passwd = "";
	}else{
		header('location:register.php?reply='.urlencode(base64_encode("An error has occurred, make sure you suppied the right information, try again.")));

		}


}
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
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">
<title>New User Registration | Corpers Market Place</title>
<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

<link rel="stylesheet" href="../dist/css/cmp.css">
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<!--Scripts-->
<script src="../dist/js/jquery.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
<script src="../dist/js/pp.js"></script>
<script src="../dist/js/em.js"></script>
</head>
<body style="margin-top:auto;margin-bottom:auto;">
<!--Conatiner-->
<div class="container" style="background-color:#FFF">
<div class="row">
<span class="glyphicon glyphicon-home"><a href="../index.php"> Main</a></span><hr>
<uL class='breadcrumb'>
	<li><a href="index.php">Home</a></li>
	<li><a href="register.php">Register account</a></li>
</uL>
<div class="col-md-4"></div>
<div class="col-md-4">
<?php
if (!empty($_GET['reply'])){
		echo "<div class='alert alert-danger' role='alert'>";
		echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
		echo "<span class='sr-only'>Error:</span>";
        echo base64_decode(urldecode($_GET['reply']));
        echo "</div>";}

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<fieldset>
<legend>Registration Details</legend><p style="color:red;">All fields are mandatory</p>

<div class="input-group input-group-md">
<span class="input-group-addon">
<span class="glyphicon glyphicon-star"></span>
</span>
<input type="text" class="form-control" autofocus name="nicknamefld" placeholder="nickname" value="<?php 
if(isset($_POST['nicknamefld'])){ echo $nickname;}
?>">
</div>
<span class="error"><?php echo $nicknameErr;?></span><br>

<div class="input-group input-group-md">
<span class="input-group-addon">
<span class="glyphicon glyphicon-envelope"></span>
</span> 
<input onkeyup="checkemail();" class="form-control" type="text" name="emailfld" id="emailfld" placeholder="Your email" value="<?php
if(isset($_POST['emailfld'])){
	echo $email; }
 ?>">
 </div>
 <span class="error"><?php echo $emailErr; ?></span>
 <span id="email_status"></span>
 <br>

<div class="input-group input-group-md">
<span class="input-group-addon">
<span class="glyphicon glyphicon-lock"></span>
</span> 
<input class="form-control" type="password" placeholder="Password" name="passwordfld" id="pass">
</div>
 <span class="error"><?php echo $passwdErr; ?></span><br>

<div class="input-group input-group-md">
<span class="input-group-addon">
<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
</span>  <span class="error"> 
<input class="form-control" type="password" placeholder="Confirm password" name="passwordfld1" id="confpass"><br>
</div>
<span class="error"><?php echo $passwdErr1; ?></span><br>
<div class="registrationFormAlert" id="divCheckPasswordMatch">
</div>

<input type="hidden" name="ipfld" value="<?php echo $_SERVER["REMOTE_ADDR"]; ?>"   >
<input type="hidden" name="datefld" value="<?php echo date("l, d-m-Y h:i:sa"); ?>"><br>

<input class="form-control btn btn-success" type="submit" value="Register" name="newRegSubBtn"><br>
<p style="color:Brown" class="center"><a href="index.php">login if you have an account</a> | <a href="recover-account">recover account</a></p>
</fieldset>
</form>
<hr>


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