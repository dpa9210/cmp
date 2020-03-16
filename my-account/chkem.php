<?php 
 session_start();
require("../dist/core/conx.php");

if(isset($_POST['emailfld']))
{
	$emailId=$_POST['emailfld'];

	$checkdata="SELECT user_email FROM users WHERE user_email='$emailId' ";

	$query=mysqli_query($link, $checkdata);

	if(mysqli_num_rows($query)>0)
	{
	echo "<p style='color:red;'>Email already in use, please change</p>";
	}
	else
	{
	echo "<p style='color:green;'>Email available ...proceed.</p>";
	}
exit();
}


?>