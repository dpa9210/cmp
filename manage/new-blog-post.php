<?php 
session_start();

require("../dist/core/conx.php"); 
if(!isset($_SESSION['email']) || $_SESSION['authorize']!= "true"){
	header('location:index.php?msg='.urlencode(base64_encode("Login with your email and password")));
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
<title>New blog post | Corpers Market Place</title>
<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="../dist/css/cmp.css">
<link rel="stylesheet" href="../dist/css/sidebar.css">
<link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
<div class="container" style="background-color:#FFF">
<?php 
include '../manage/adminhdr.php';
?>
<div class="row">
<div class="col-md-6">

	<h2>New Blog post</h2>
	<form action="nbp.php" method="post" id="nbpform">
	<input type="text" autofocus name="titlefld" id="titlefld" class="form-control" placeholder="Blog title"><br>
	<textarea id="postbodyfld" name="postbodyfld" class="form-control"></textarea>
	<input type="hidden" id="datefld" name="datefld" class="form-control" value="<?php echo date("l, d-m-Y ")."at ". date("h:i:sa"); ?>"><br>
	<input type="hidden" name="nicknamefld" id="nicknamefld" value="<?php $query = mysqli_query($link, "SELECT nickname from manager WHERE email = '$emsessvar'"); 
	$result = mysqli_fetch_assoc($query);
	echo $result['nickname'];
	?>">
	<br>
	<button class="btn btn-success" name="sub" id="sub">Add post</button>
	</form>
	<span id="insertresponse"></span>
	<!--Scripts
<script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>-->

<script src="ckeditor/ckeditor.js"></script>
<script src="../dist/js/jquery.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
<script src="nbp.js" type="text/javascript"></script>
 <script>
 CKEDITOR.replace('postbodyfld');
 </script>
<!--
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
-->
</div>
<div class="col-md-6"></div>
</div>

</div>





</body>
</html>