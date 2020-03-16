<?php 
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
require("../dist/core/conx.php");
include('Mail.php');?>
<?php
$emailErr = "";
//function to strip
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if(isset($_POST['recBtn'])){
	if(empty($_POST["recemailfld"])){
		$emailErr = "Enter your email address";
	}else{
		$email = test_input($_POST["recemailfld"]);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$emailErr = "Invalid email format";
	}
	}
	//send data
	$email = $_POST['recemailfld'];
	$new_error_msg = $emailErr;
	if($new_error_msg == ""){
		$query = "SELECT user_email, user_password, user_nickname FROM users WHERE user_email ='".$email."'";
		$result = mysqli_query($link, $query);
		$Results = mysqli_fetch_array($result);
		if(count($Results)>=1){
			$username = 'noreply@cmp.com.ng';
			$password = 'davis@123';

			$to = "$email";
			$subject ="Corpers Market Place Account Details";
			$from = "noreply@cmp.com.ng";
			$body = 'Dear '.$Results['user_nickname']."\n\n". "Your login details are:
			Email: " .$Results['user_email']." 
			Password: " .$Results['user_password']." \n\n".
			"CMP Administrator."."\n".'support@cmp.com.ng';
			$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject); // the email headers
			$smtp = Mail::factory('smtp', array ('host' =>'localhost', 'auth' => true, 'username' => $username, 'password' => $password, 'port' => '25'));
			$mail = $smtp->send($to, $headers, $body);
            //mail($to,$subject,$body,$headers);
        	header('location:recover-account.php?reply='.urlencode(base64_encode("Your account details have been sent, check your spam if it is not in your inbox.")));
			$email= "";
		}else{
			   header('location:recover-account.php?reply='.urlencode(base64_encode("We could not find any account associated with that email. You may <a href='register.php'>register</a> for a new account")));

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
<title>Recover Account Details | Corpers Market Place</title>
<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

<link rel="stylesheet" href="../dist/css/cmp.css">
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<!--Scripts-->
<script src="../dist/js/jquery.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
</head>
<body>

<!--Conatiner-->
<div class="container" style="background-color:#FFF">
<span class="glyphicon glyphicon-home"><a href="../index.php"> Main</a></span><hr>
<uL class='breadcrumb'>
	<li><a href="index.php">Home</a></li>
	<li><a href="recover-account.php">Recover account</a></li>
</uL>
<div class="row">
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
<legend>Recover account</legend>
Enter the email you used to register and we will send you your registerastion details.<br><br>
<div class="input-group input-group-md">
<span class="input-group-addon">
<span class="glyphicon glyphicon-envelope"></span>
</span>
<input type="email" autofocus class="form-control" placeholder="Email address" name="recemailfld">
</div>
<span class="error"><?php echo $emailErr; ?></span><br><br>
<input class="btn btn-success form-control" type="submit" name="recBtn" id="recbtn" value="Send">
</fieldset>
	
</form>
</div>
<div class="col-md-4"></div>



</div><!--row end-->

</div><!--container end-->

</body>
</html>