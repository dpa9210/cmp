<!--Admin dashboard shows all admin activity links and pages-->
<?php 
//start session
session_start();
//create coonection
require("../dist/core/conx.php"); 
//check if session variable is set
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
<title>All Data | Corpers Market Place</title>
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
<?php
include '../manage/adminhdr.php';
?>
<div class="row">
<?php echo "<b>Welcome</b>  $emsessvar" . " |" ."<h4>My Admin Dashboard</h4>"; ?>  

<p><b>View All Ads </b> | </p>
<?php 
if ($result = $link->query("SELECT * FROM ads ORDER by ad_id DESC"))
{
	//display records if any
	if($result->num_rows > 0){
		//display records in a table
		echo "<table class='table table-condensed table-hover table-bordered'>";
		//set table headers
		echo "<thead><tr><th>Id</th><th>Title</th><th>Type</th><th>Description</th><th>Price</th><th>State</th><th>Town</th><th>Name</th><th>Contact</th><th>Date</th><th>Status</th><th></th><th></th><th></th><th></th></tr></thead>";
		echo "<tbody>";
		while($row = $result->fetch_object()){
			//set up a row for each record
			echo "<tr>";
			echo "<td>". $row->ad_id . "</td>";
			echo "<td>". $row->ad_title . "</td>";
			echo "<td>". $row->ad_type . "</td>";
			echo "<td>". $row->ad_description . "</td>";
			echo "<td>". $row->ad_price . "</td>";
			echo "<td>". $row->ad_state . "</td>";
			echo "<td>". $row->ad_town . "</td>";
			echo "<td>". $row->ad_sellername . "</td>";
			echo "<td>". $row->ad_contact . "</td>";
			echo "<td>". $row->ad_date . "</td>";
			echo "<td>". $row->ad_status . "</td>";
			echo "<td><a class='btn btn-primary btn-sm' href='records.php?id=" . $row->ad_id . "'>Edit</a></td>";
			echo "<td><a class='btn btn-danger btn-sm' href='delete-ad.php?id=" . $row->ad_id . "'>Delete</a></td>";
			echo "<td><a class='btn btn-success btn-sm' href='approve-ad.php?id=" . $row->ad_id . "'>Approve</a></td>";
			echo "<td><a class='btn btn-warning btn-sm' href='disapprove-ad.php?id=" . $row->ad_id . "'>Disapprove</a></td>";
			
		}
		echo "</tbody>";
		echo "</table>";
	}
		//if there are no records in the db
		else{
			echo "No Data to be Displayed!";
		}
	}
	// show an error if there is an issue with the database query
	else{
	echo "Error with the connection";
}

// close database connection
	$link->close();

?>


</div><!--row end-->

<!--
<div class="panel-footer">
<p>&copy 2015 CMP | Privacy | Terms</p>
</div> -->

</div><!--container end-->

</body>
</html>