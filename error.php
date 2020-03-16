<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Corpers Market Place, Buying and Selling for Corpers">
<meta name="keywords" content="">
<meta name="author" content="wizedavis">
<title>Error| Corpers Market Place</title>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="dist/css/cmp.css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!--Scripts-->
<script src="dist/js/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
</head>
<body>
<?php $msgg = "<p class='bg-warning'>"."The Page you are looking for has been deleted or moved to a different url."."</p>"; ?>

<div class="container" style="background-color:#FFF">
<?php include 'dist/header.php'; ?>
<div class="row">
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
<?php
echo $msgg. "<br>";


 ?>

</div>
<div class="col-md-4"></div>


</div>


<?php include 'dist/footer.php'; ?>
</div>

</body>
</html>