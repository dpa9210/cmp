<?php 
session_start();
require("../dist/core/conx.php");
if(!isset($_SESSION['email']) || $_SESSION['authorize']!= "true"){
	header('Location:index.php?reply='.urlencode(base64_encode("Login with your email and password.")));

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
<meta name="robots" content="index" />
<meta name="author" content="wizedavis">
<title>My Account | Corpers Market Place</title>
<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
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
	<li><a href="index">Home</a></li>
	<li><a href="account" class="active">My account</a></li>
</uL>

<?php  
include("user-menu.php");
echo "<a class='btn btn-success btn-xs' href='new-ad.php'>"."New Ad <span class='glyphicon glyphicon-plus-sign'></span>"."</a>";
?>
<hr>
<?php
if (!empty($_GET['reply'])){
		echo "<div class='alert alert-danger' role='alert'>";
		echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
		echo "<span class='sr-only'>Error:</span>";
        echo base64_decode(urldecode($_GET['reply']));
        echo "</div>";}

?>
<p>Make your ad visible to the public by changing its status using the update button.</p>
<p><span style="Color:red;">Warning!</span> Once an ad is deleted it cannot be restored.</p>
<hr>
<?php 
//display my ads
if($result = $link->query("SELECT * FROM ads WHERE ad_email='$emsessvar' ORDER BY ad_id DESC")){
	if($result->num_rows > 0){
		echo "<div class='table-responsive'>";
		echo "<table class='table table-striped table-bordered' >";
		echo "<thead>"."<tr style='background-color:green;color:white;'><th>Title</th><th>Status</th><th>Set On/Off</th><th>View</th><th>Edit</th><th>Delete</th></tr>"."</thead>";
		echo "<tbody>";
		while($row = $result->fetch_object()){
			echo "<tr>";
			echo "<td>". $row->ad_title . "</td>";
			echo "<td>";
			if ($row->ad_status<1){
				echo "<b style='color:red;'>Disabled</b>";
			}else{
				echo "<b style='color:green;'>Enabled</b>";

			}
			echo "</td>";
			//echo "<td>". $row->ad_status . "</td>";
			/*echo "<td>";
			echo "<div class='checkbox center'>";
			echo "<input type='checkbox' checked data-toggle='toggle' data-size='mini' data-onstyle='success' data-offstyle='danger'>";
			echo "</div>";
			echo "</td>";*/
			echo "<td><a class='btn btn-info btn-xs' href='change-stat.php?id=" . $row->ad_id . "'>Hide/Unhide</a></td>";
			echo "<td><a class='btn btn-info btn-xs' href='../ad/".$row->ad_id."/".$row->url."' target='_blank'>View</a></td>";
			echo "<td><a class='btn btn-info btn-xs' href='edit.php?id=".$row->ad_id."'>Edit</a></td>";
			echo "<td><a class='btn btn-danger btn-xs' href='delete.php?id=". $row->ad_id."'>Delete</a></td>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}else{
		echo "<div class='well'>You don't have any ads to be displayed.</div>";
	}
}	
	
$link->close();
?>
<br>
<a href="confirm-delete.php" class="btn btn-danger form-control btn-xm"><span class="glyphicon glyphicon-remove-sign"></span> Delete my account</a>
</div>
<div class="col-md-3">


</div>
<div class="col-md-3"></div>



</div>



</div><!--row end-->

<!--
<div class="panel-footer">
<p>&copy 2015 CMP | Privacy | Terms</p>
</div> -->
</div><!--container end-->

</body>
</html>