<?php
include("dist/core/conx.php"); 
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Corpers Market Place Blog carries news which or stories that may be beneficial to Corps members.">
<meta name="keywords" content="">
<meta name="author" content="wizedavis">
<title>Blog | Corpers Market Place</title>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<link rel="stylesheet" href="dist/css/cmp.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<script src="dist/js/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
</head>
<body style="margin-top:60px; margin-bottom:auto;">
<div class="jumbotron text-center">
<div class="pull-left"><span class="glyphicon glyphicon-home"></span> Home</div>
	<h1>Corpers Market Place Blog</h1>
	<p><b>Stats:</b></p>
</div>
<div class="container">
<?php include 'dist/header.php'; ?>

	<div class="row">
		<div class="col-md-10">
			<div class="panel panel-info">
<div class="panel-heading"><b>Blog Posts</b></div>
<div class="panel-body">
<?php 
if($result = $link->query("SELECT * FROM post ORDER BY post_id DESC")){
	if($result->num_rows>0){
		echo "<ul style='list-style:none;margin:0;padding:0;'>";
		while($row = $result->fetch_object()){
			$title = $row->post_title;
			echo "<li>"."<a href='post/".$row->post_id."/".$row->seo_title."'>".$title."</a>"."</li>"."<hr>";
		}
		echo "</ul>"."<br>";
	}else{
		echo "No data to display.";
	}
}else{
	echo "An error has occurred.";
}

?>

</div>

		</div>
		<div class="col-md-2"></div>
	</div>
</div>





<?php include ('dist/footer.php'); ?>
</body>
</html>