<?php
session_start();
include("dist/core/conx.php"); 
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="The Corpers Market Place is a classified advertisement website to advertise items for sale, accommodation and other services to Corps members.">
<meta name="keywords" content="Online Advertising in Nigeria, Buying and selling online for Youth Corps members, Business directory for corps members, Online Market Place, cmp, cmp.com.ng, NYSC, National Youth Service Corps, find accomodation, services, Things for sale, Buying selling for corps members, mami market, Corper">
<meta name="robots" content="index" />
<meta name="author" content="wizedavis">
<title>Business Market Place</title>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="dist/css/cmp.css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!--Scripts-->
<script src="dist/js/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/js.cookie.min.js"></script>

<script>
$(document).ready(function(){
	setTimeout(function(){
		if(!Cookies.get('modalShown')){
			$('#myIntroModal').modal('show');
			Cookies.set('modalShown',true);
		}
	},3000);
});</script>
<script src="dist/js/stt.js"></script>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75831363-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Begin Cookie Consent plugin by Silktide -->
<script type="text/javascript">
    window.cookieconsent_options = {"message":"This site uses cookies from Google to deliver its services. Information about your use of this site is shared with Google. By using this site, you agree to its use of cookies.","dismiss":"Got it!","learnMore":"More info","link":"https://en.wikipedia.org/wiki/HTTP_cookie","theme":"dark-bottom"};
</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
<!-- End Cookie Consent plugin -->

</head>
<body>
<!--Conatiner-->
<div class="container">
<div class="modal fade" id="myIntroModal" tabindex="-1" role="dialog" aria-hidden="true" data-width="100">
	<div class="modal-content center">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">X</a>
		</div>
		<div class="modal-body">
			<img src="dist/img/cmp-intro.jpg" width="280" height="280" alt="introimage">
		</div>
		<div class="modal-footer center">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>	
	</div>
	
</div>
<?php include 'dist/header.php'; ?>
<div class="row">
<div class="col-md-3 col-sm-12" style="background-color:#E6E6E6; border-radius:2px; margin-top:20px;">
<div class="row">

<h4><b>Find Ads</b></h4>
<form method="GET" action="search.php">
<input autofocus class="searchbar1" name="search" autocomplete="off" spellcheck="false" placeholder="Type something" type="text" size="30">
<input class="searchbarbtn1" type="submit" name="submit" value="Go">
</form>
<br>
<!--POINT-->	
<h4><b>View ads by State</b></h4>

<form id="stateFilterForm" action="ads-by-state.php" method="POST" >
<select name="mySelection" id="mySelection" onChange="$('#stateFilterForm').submit()";>
<option> ---------- Select a state ---------- </option>	
<option value="Abia">Abia</option>
<option value="Adamawa" >Adamawa</option>
<option value="Akwa-Ibom">Akwa-Ibom</option>
<option value="Anambra">Anambra</option>
<option value="Bauchi">Bauchi</option>
<option value="Bayelsa">Bayelsa</option>
<option value="Benue">Benue</option>
<option value="Borno">Borno</option>
<option value="Cross River">Cross River</option>
<option value="Delta">Delta</option>
<option value="Ebonyi">Ebonyi</option>
<option value="Edo">Edo</option>
<option value="Ekiti">Ekiti</option>
<option value="Enugu">Enugu</option>
<option value="FCT Abuja">FCT Abuja</option>
<option value="Gombe">Gombe</option>
<option value="Imo">Imo</option>
<option value="Jigawa">Jigawa</option>
<option value="Kaduna">Kaduna</option>
<option value="Kano">Kano</option>
<option value="Katsina">Katsina</option>
<option value="Kebbi">Kebbi</option>
<option value="Kogi">Kogi</option>
<option value="Kwara">Kwara</option>
<option value="Lagos">Lagos</option>
<option value="Nassarawa">Nassarawa</option>
<option value="Niger">Niger</option>
<option value="Ogun" >Ogun</option>
<option value="Ondo">Ondo</option>
<option value="Osun">Osun</option>
<option value="Oyo">Oyo</option>
<option value="Plateau" >Plateau</option>
<option value="Rivers">Rivers</option>
<option value="Sokoto">Sokoto</option>
<option value="Taraba" >Taraba</option>
<option value="Yobe">Yobe</option>
<option value="Zamfara">Zamfara</option>
</select>
</form>
<br>

</div>

</div>

<br>

<div class="col-md-3">

<div class="well well-sm" style="color:#FFFFFF; margin-top:10px; background-color:#A71931;"><b>ITEMS FOR SALE</b></div>

<?php
if ($result = $link->query("SELECT * FROM ads WHERE ad_status = '1' and ad_type = 'item for sale' ORDER by ad_id ASC LIMIT 8"))
{
	//display records if any
	if($result->num_rows > 0){
		//display records in a list-group
		echo "<ul class='list-group'>";
		
		while($row = $result->fetch_object()){
			//set up a row for each record
			$amount = $row->ad_price;
			$famount = number_format($amount);
			
			echo "<li class='list-group-item listh'>"."<a class='active' href='ad/".$row->ad_id."/".$row->url."'>".'<b>'.$row->ad_title.'</b>'. "</a>" ."<br>" .$row->ad_town . ", " .$row->ad_state."." . "<span class='badge'> ₦ $famount </span>" ."</li>";
			
			
		}
		echo "</ul>";
	}
		//if there are no records in the db
		else{
			echo "<p style='color:red;''>No Data to be Displayed!</p>";
		}
	}
	else{
	echo "An error has occurred.";
}

?>

</div>

<div class="col-md-3">

<div class="well well-sm" style="color:#FFFFFF; margin-top:10px; background-color:#A71931;"><b>ACCOMODATION</b></div>
<?php 
if ($result = $link->query("SELECT * FROM ads WHERE ad_status = '1' AND ad_type = 'Accomodation' LIMIT 8"))
{
	//display records if any
	if($result->num_rows > 0){
		//display records in a list-group
		
		echo "<ul class='list-group'>";
		while($row = $result->fetch_object()){
			//set up a row for each record
			$amount = $row->ad_price;
			$famount = number_format($amount);
			
			echo "<li class='list-group-item'>"."<a class='active' href='ad/".$row->ad_id."/".$row->url."'>" .'<b>'.$row->ad_title.'</b>'. "</a>" ."<br>".$row->ad_town . ", " .$row->ad_state."." . "<span class='badge'> ₦ $famount </span>" ."</li>";
			
			
		}
		echo "</ul>";
	}
		
		else{
		echo "<p style='color:red;''>No Data to be Displayed!</p>";		}
	}
	
	else{
	echo "An error has occurred";
}




?>


</div>


<div class="col-md-3">

<div class="well well-sm" style="color:#FFFFFF; margin-top:10px; background-color:#A71931;"><b>SERVICES</b></div>
<?php
if ($result = $link->query("SELECT * FROM ads WHERE ad_status = '1' and ad_type = 'Service' ORDER by ad_id ASC LIMIT 8"))
{
	//display records if any
	if($result->num_rows > 0){
		//display records in a list-group
		echo "<ul class='list-group'>";
		
		while($row = $result->fetch_object()){
			//set up a row for each record
			$amount = $row->ad_price;
			$famount = number_format($amount); 
			
			echo "<li class='list-group-item'>"."<a class='active' href='ad/".$row->ad_id."/".$row->url."'>" .'<b>'.$row->ad_title.'</b>'. "</a>" ."<br>" .$row->ad_town. ", " .$row->ad_state."." . "<span class='badge'> ₦ $famount </span>" ."</li>";
			
			
		}

		echo "</ul>";
	}
		//if there are no records in the db
		else{
		echo "<p style='color:red;''>No Data to be Displayed!</p>";		}
	}
	// show an error if there is an issue with the database query
	else{
	echo "An error has occurred";
}
// close database connection
	$link->close();

?>



</div>


</div>





<?php include 'dist/footer.php'; ?>
</div>





</body>
</html>