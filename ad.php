<?php require("dist/core/conx.php");
$id=$_GET['id']; 
if(!is_numeric($id)){
echo "Data Error"; 
exit;}
?>
<?php
$result = mysqli_query($link, "SELECT * FROM ads where ad_id = $id LIMIT 1");
$addetails = mysqli_fetch_assoc($result); 
$addetails['ad_contact'] == 'phone';
 ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Buying and Selling for Corpers">
<meta name="keywords" content="Ad Details">
<meta name="author" content="wizedavis">
<title><?php echo $addetails['ad_title'];?> | Corpers Market Place</title>
<base href="/">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="/dist/css/cmp.css" />
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!--Scripts-->
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="/dist/js/pn.js"></script>
<script>
function goBack() {
    window.history.back();
}
</script>

</head>
<body>
<!--Conatiner-->
<div class="container" style="background-color:#FFF">
<?php include 'dist/header.php'; ?>
<div class="row">
<div class="col-md-6">
<button onclick="goBack()">Go Back</button>
<span class="glyphicon glyphicon-print pull-right"><a href="javascript:window.print()"> Print</a></span>
<div class="panel panel-primary">
<div class="panel-heading">
</div>
<div class="panel-body">
<h1><?php echo $addetails['ad_title']; ?></h1>

<?php echo "<img alt='ad picture' class='img-thumbnail' width='304px' height='236px' src='cmp".$addetails['ad_image']."'>"; ?>
<hr>
<span class="glyphicon glyphicon-info-sign"></span><?php echo $addetails['ad_description']; ?>
<hr>
<b><span class="glyphicon glyphicon-shopping-cart ">Price:</b> <?php 
$amount = $addetails['ad_price'];;
$famount = number_format($amount);
 echo "₦ ".$famount; ?>
<hr>
<b><span class="glyphicon glyphicon-tent ">State:</b> <?php echo $addetails['ad_state']; ?>
<hr>
<b><span class="glyphicon glyphicon-road ">Town:</b> <?php echo $addetails['ad_town']; ?>
<hr>
<b><span class="glyphicon glyphicon-user "></span>Owner:</b> <?php echo $addetails['ad_sellername']; ?>
<hr>
<b><span class="glyphicon glyphicon-phone-alt "></span>Contact: </b> <div id="phnumber" style="display:inline;"><?php echo '<a href="tel:phone"]">'. $addetails['ad_contact']. "</a>"; ?> </div> <input style="display:inline;" class="btn bg-success" type="button" id="hideshow" value="show/hide number">
<hr>
<span class="glyphicon glyphicon-calendar"></span><b>Date posted: </b><?php echo $addetails['ad_date'];
$link->close();
?>

<script type="text/javascript">
  $('#phnumber').hide();

</div>

</div>





</div>
<div class="col-md-6"></div>




</div>

<?php include 'dist/footer.php'; ?>
</div>
</body>
</html>

