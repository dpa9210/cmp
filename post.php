<?php require("dist/core/conx.php"); ?>
<?php
$id=$_GET['id']; // Collecting data from query string
if(!is_numeric($id)){ // Checking data it is a number or not
echo "Data Error"; 
exit;}
$result = mysqli_query($link, "SELECT * FROM post where post_id = $id LIMIT 1 ");
$postdetails = mysqli_fetch_assoc($result); 
 ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Buying and Selling for Corpers">
<meta name="keywords" content="Corpers market place, blog">
<meta name="author" content="wizedavis">
<title><?php echo $postdetails['post_title'];?> | Corpers Market Place Blog</title>
<link rel="stylesheet" href="dist/css/bootstrap.min.css" />
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="dist/css/cmp.css" />
<link rel="icon" href="favicon.ico" type="image/x-icon">
<script src="/dist/js/jquery.min.js" /></script>
<script src="/dist/js/bootstrap.min.js" /></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-75831363-1', 'auto');
  ga('send', 'pageview');
</script>
<script>
function goBack() {
    window.history.back();
}
</script>
<base href="/">
</head>
<body>
<div class="container" style="background-color:#FFF;">
<?php include 'dist/header.php'; ?>
<div class="row">
<div class="col-md-6">
<button onclick="goBack()">Go Back</button>

<?php echo "<h3>".$postdetails['post_title']."</h3>";
echo "<sup>" ."by ".$postdetails['post_user']. " on ". $postdetails['post_date']."</sup>"."<hr>";
echo $postdetails['post_body']; 
?>
<hr>

</div>
<div class="col-md-6"></div>




</div>

<?php include 'dist/footer.php'; ?>
</div>
</body>




</html>