<?php 
session_start();
require("../dist/core/conx.php"); 
//check if session variable is set
if(!isset($_SESSION['email']) || $_SESSION['authorize']!= "true"){
	header('location:index.php?msg='.urlencode(base64_encode("Login with your email and password")));
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
<title>Admin Dashboard | Corpers Market Place</title>
<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="../dist/css/cmp.css">
<link rel="stylesheet" href="../dist/css/sidebar.css">
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<!--Scripts-->
<script src="../dist/js/jquery.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
<script src="../dist/js/sidebar.js"></script>
</head>
<body>

<!--Conatiner-->
<div class="container" style="background-color:#FFF">
<?php 
include '../manage/adminhdr.php';

?>
<div class="row">
<?php echo "<b>Welcome</b>  $emsessvar"; ?>
<h1>My Admin Dashboard</h1>
<h3>Statistics</h3>
<hr>
<!--Total Ads-->
<?php
$sql1 = "SELECT * FROM ads";
$run1 = mysqli_query($link, "$sql1");
$foundnum1 = mysqli_num_rows($run1);
?>
<!--Approved Ads-->
<?php
$sql2 = "SELECT * FROM ads WHERE ad_status = '1'";
$run2 = mysqli_query($link, "$sql2");
$foundnum2 = mysqli_num_rows($run2);
?>
<!--UnApproved Ads-->
<?php
$sql3 = "SELECT * FROM ads WHERE ad_status = '0'";
$run3 = mysqli_query($link, "$sql3");
$foundnum3 = mysqli_num_rows($run3);
?>

<!--Blog Posts-->
<?php 
$postsql = "SELECT * FROM post";
$postnum = mysqli_query($link, $postsql);
$foundpost = mysqli_num_rows($postnum);
?>
<!--Comments-->
<?php 
$cmtsql = "SELECT * FROM comment";
$cmtnum = mysqli_query($link, $cmtsql);
$foundcmt  = mysqli_num_rows($cmtnum);
?>
<button class="btn btn-primary" type="button">Total Ads <br><span class="badge"><?php echo "<span class='dbtxt'>"."$foundnum1"."</span>"; ?></span></button>
<button class="btn btn-primary" type="button">Approved Ads Ads<br> <span class="badge"><?php echo "<span class='dbtxt'>"."$foundnum2"."</span>"; ?></span></button>
<button class="btn btn-primary" type="button">Unapproved Ads Ads<br> <span class="badge"><?php echo "<span class='dbtxt'>"."$foundnum3"."</span>"; ?></span></button>
<hr>
<h3>Blog</h3>
<button class="btn btn-warning" type="button">Total Posts <br><span class="badge"><?php echo "<span class='dbtxt'>"."$foundpost"."</span>"; ?></span></button>

<hr>
<h3>Comments</h3>
<button class="btn btn-info" type="button">Total Comments<br> <span class="badge"><?php echo "<span class='dbtxt'>"."$foundcmt"."</span>"; ?></span></button>

<!--
<div class="table-responsive">
	<table class="table">
		<thead><tr><th>#</th><th>State</th><th>Number of Ads</th></tr></thead>
		<tbody>
			<tr><td>1</td><td>FCT</td><td></td></tr>
			<tr><td>2</td><td>Abia</td><td></td></tr>
			<tr><td>3</td><td>Adamawa</td><td></td></tr>
			<tr><td>4</td><td>Akwa-Ibom</td><td></td></tr>
			<tr><td>5</td><td>Abia</td><td></td></tr>
			<tr><td>6</td><td>Abia</td><td></td></tr>
			<tr><td>7</td><td>Abia</td><td></td></tr>
			<tr><td>8</td><td>Abia</td><td></td></tr>
			<tr><td>9</td><td>Abia</td><td></td></tr>
			<tr><td>10</td><td>Abia</td><td></td></tr>
			<tr><td>11</td><td>Abia</td><td></td></tr>
			<tr><td>12</td><td>Abia</td><td></td></tr>
			<tr><td>13</td><td>Abia</td><td></td></tr>
			<tr><td>14</td><td>Abia</td><td></td></tr>
			<tr><td>15</td><td>Abia</td><td></td></tr>
			<tr><td>16</td><td>Abia</td><td></td></tr>
			<tr><td>17</td><td>Abia</td><td></td></tr>
			<tr><td>18</td><td>Abia</td><td></td></tr>
			<tr><td>19</td><td>Abia</td><td></td></tr>
			<tr><td>20</td><td>Abia</td><td></td></tr>
			<tr><td>21</td><td>Abia</td><td></td></tr>
			<tr><td>22</td><td>Abia</td><td></td></tr>
			<tr><td>23</td><td>Abia</td><td></td></tr>
			<tr><td>24</td><td>Abia</td><td></td></tr>
			<tr><td>25</td><td>Abia</td><td></td></tr>
			<tr><td>26</td><td>Abia</td><td></td></tr>
			<tr><td>27</td><td>Abia</td><td></td></tr>
			<tr><td>28</td><td>Abia</td><td></td></tr>
			<tr><td>29</td><td>Abia</td><td></td></tr>
			<tr><td>30</td><td>Abia</td><td></td></tr>
			<tr><td>31</td><td>Abia</td><td></td></tr>
			<tr><td>32</td><td>Abia</td><td></td></tr>
			<tr><td>33</td><td>Abia</td><td></td></tr>
			<tr><td>34</td><td>Abia</td><td></td></tr>
			<tr><td>35</td><td>Abia</td><td></td></tr>
			<tr><td>36</td><td>Abia</td><td></td></tr>
			
			

	</table>-->
</div>



</div><!--row end-->

<!--
<div class="panel-footer">
<p>&copy 2015 CMP | Privacy | Terms</p>
</div> -->

</div><!--container end-->

</body>
</html>