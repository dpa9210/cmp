<?php session_start(); ?>
<?php require("../dist/core/conx.php"); 
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
<title>Paginated View| Corpers Market Place</title>
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
<?php include '../dist/header.php'; 
include '../manage/adminhdr.php';
?>
<div class="row">
<h1>My Admin Dashboard</h1>
<p><b>Paginated View</b></p>
<?php 
// number of results to show per page
$per_page = 3;
//figure out total pages in the database
if($result = $link->query("SELECT * FROM product ORDER by id")){
	if($result->num_rows !=0){
		$total_results = $result->num_rows;
		// ceil() returns the next highest integer value by rounding up value if necessary
		$total_pages = ceil($total_results / $per_page );
		// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
		if(isset($_GET['page'])&& is_numeric($_GET['page'])){
			
			$show_page = $_GET['page'];
			
			//Make sure the $show_page value is valid
			if ($show_page > 0 && $show_page <= $total_pages){
				$start = ($show_page -1) * $per_page;
				$end = $start + $per_page;
				
			} else {
				// if page isn't set, show first set of results
				$start = 0;
				$end = $per_page;
			}
		}
		
	}
}


?>


</div><!--row end-->

<!--
<div class="panel-footer">
<p>&copy 2015 CMP | Privacy | Terms</p>
</div> -->
<?php include '../dist/footer.php'; ?>
</div><!--container end-->

</body>
</html>