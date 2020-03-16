<?php 
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
require('../dist/core/conx.php');
if(!isset($_SESSION['email']) || $_SESSION['authorize']!= "true"){

	header('location:index.php?reply='.urlencode(base64_encode("Login with your email and password or <a href='register.php'>register</a> new account to post an ad.")));
	die();

}else{
	header("Content-Type: text/html; charset= utf-8");
	$emsessvar = $_SESSION['email'];
}

?>
<?php
//Define variables and set empty values
$nameErr = $typeErr = $descErr = $priceErr = $stateErr = $townErr = $contactErr = $secErr = $agrmntErr = $imageErr ="";
$name = $type = $desc = $price = $state = $town = $displayname = $contact = $sec = $datefld = $image ="";
$errormsg = "";
$successmsg = "";
//function to strip
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
function string_limit_words($string, $word_limit) 
{
$words = explode(' ', $string);
return implode(' ', array_slice($words, 0, $word_limit));
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(empty($_POST["adnamefld"])){
		$nameErr = "Enter a name for your ad";
	}else{
		$name = test_input($_POST["adnamefld"]);
	}
if(empty($_POST["adtypefld"])){
	$typeErr = "Select your type of ad";
}else{
	$type = test_input($_POST["adtypefld"]);
}
if(strlen($_POST["descriptionfld"])<=1){//this is because the textarea by default add up some empty white space, 
//using the php trim() function will erase the whitespace but still allow 1 character white space
	$descErr = "Enter a description for your ad";
}else{
	$desc = test_input($_POST["descriptionfld"]);
}
if(empty($_POST["pricefld"])){
	$priceErr = "Enter a price for your ad";
}else{
	$price = test_input($_POST["pricefld"]);
}
if(empty($_POST["statefld"])){
	$stateErr = "Select the state you want your ad to be displayed";
} else{
	$state = test_input($_POST["statefld"]);
}
if(empty($_POST["townfld"])){
	$townErr = "Enter the town you want your ad to be displayed";
} else{
	$town = test_input($_POST["townfld"]);
}
if(empty($_POST["contactfld"])){
	$contactErr = "Enter your contact number";
}else{
	$contact = test_input($_POST["contactfld"]);
}
if(empty($_POST["secfld"])){
	$secErr = "You failed the security check, try again!";
}else{
	if($_POST["secfld"]=="1960"){
	$sec = 1960;
	}else{
	$secErr = "You failed the security check, try again!";
	}
	
}
if(empty($_POST["agreementfld"])){
	$agrmntErr = "You must accept the terms to proceed";
}

if(empty($_POST['imagefld'])){
	$imageErr = "";
}else{
	$image = test_input($_POST['imagefld']);

}
		
	//send the data 
//================================ NEW INSERT CODE ==================================================	
		$adnamefld=$_POST['adnamefld'];
		$adtypefld=$_POST['adtypefld'];
		$descriptionfld=$_POST['descriptionfld'];
		$pricefld=$_POST['pricefld'];
		$statefld=$_POST['statefld'];
		$townfld=$_POST['townfld'];
		$secfld=$_POST['secfld'];
		$displaynamefld=$_POST['displaynamefld'];
		$contactfld=$_POST['contactfld'];
		$datefld = $_POST['datefld'];
		$emailfld = $_POST['emailfld'];
		$useridfld = $_POST['useridfld'];
		$uploadDir = "/uploads/";
		$fileName = $_FILES['imagefld']['name'];
		$filePath = $uploadDir .$fileName;

//Title to friendly URL conversion
$newtitle=string_limit_words($adnamefld, 6); // First 6 words
$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
$newurltitle=str_replace(" ","-",strtolower($newtitle));
$url= $newurltitle; // Final URL

//$new_error_message = $nameErr."".$typeErr."".$descErr."".$priceErr."".$stateErr."".$townErr."".$contactErr."".$secErr."".$agrmntErr."";		
	
if(move_uploaded_file($_FILES['imagefld']['tmp_name'], "../uploads/".$_FILES['imagefld']['name'])){
$query = "INSERT INTO ads (ad_title, ad_type, ad_description, ad_price,
 ad_state, ad_town, ad_sellername, ad_contact, ad_date, ad_email, user_id, url, ad_image)
VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$statement = $link->prepare($query);
$statement->bind_param("ssssssssssiss", $adnamefld, $adtypefld, $descriptionfld, $pricefld, $statefld, $townfld, $displaynamefld, $contactfld, $datefld, $emailfld, $useridfld, $url, $filePath);
if($statement->execute()){
		header('location:new-ad.php?reply='.urlencode(base64_encode("Submission successfull. Goto My account and enable your new ad to make it visible for public viewing.")));


		$adnamefld="";
		$adtypefld="";
		$descriptionfld="";
		$pricefld="";
		$statefld="";
		$townfld="";
		$displaynamefld="";
		$contactfld="";
		$secfld="";
		$imagefld= "";
}else{
header('location:new-ad.php?reply='.urlencode(base64_encode("An error has occurred, try again.")));
}
	
}
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
<title>Post new ad | Corpers Market Place</title>
<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="../dist/css/cmp.css">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<script src="../dist/js/jquery.min.js"></script>
<script type="text/javascript" src="../dist/js/naps.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="background-color:#FFF">
<span class="glyphicon glyphicon-home"><a href="../index.php"> Main</a></span><hr>
<ul class='breadcrumb'>
	<li><a href="index">Home</a></li>
	<li><a href="account">My account</a></li>
	<li><a href="new-ad">New ad</a></li>
</ul>
<?php include 'user-menu.php'; ?>
<div class="row">

<div class="col-md-6">
<?php
if (!empty($_GET['reply'])){
		echo "<div class='alert alert-danger' role='alert'>";
		echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
		echo "<span class='sr-only'>Error:</span>";
        echo base64_decode(urldecode($_GET['reply']));
        echo "</div>";}
      ?>
<div class="panel panel-info">
<div class="panel-heading">New Ad <span style="color:#F00" class="pull-right"> <?php echo 'All fields marked '."<span class='error'>*</span>".' are mandatory';?></span></div>
<div class="panel-body">
<form role="form" enctype="multipart/form-data" name="newAdForm" id="newAdForm" 
method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label for="file">Image</label><span class="error"> <?php echo $imageErr; ?></span>
<input type="file" name="imagefld" id="file" class="form-control"><br>
<label for="adnamefld" class="control-form">Title</label>  <span class="error"> * <?php echo $nameErr; ?></span>
<input autofocus type="text" class="form-control" name="adnamefld" placeholder="name your ad" value="<?php
if(isset($_POST['adnamefld'])){
echo $adnamefld;}?>"><br>
<label for="adtype" class="control-form">Ad type</label> <span class="error"> * <?php echo $typeErr; ?></span>
<select name="adtypefld" class="form-control">
<option value="" <?php if(isset($_POST['adtypefld'])){
if($_POST['adtypefld']==""){
echo "selected";
}
} ?>>Select type</option>	
<option value="Accomodation" <?php if(isset($_POST['adtypefld'])){
if($_POST['adtypefld']=="Accomodation"){
echo "selected";
}
} ?>>Accomodation</option>
<option value="Item for sale" <?php if(isset($_POST['adtypefld'])){
if($_POST['adtypefld']=="Item for sale"){
echo "selected";
}
} ?>>Item for sale</option>
<option value="Service" <?php if(isset($_POST['adtypefld'])){
if($_POST['adtypefld']=="Service"){
echo "selected";
}
} ?>>Service</option>
</select><br>
<script>
</script>
<!---descriptionfld-->
<label for="descriptionfld" class="control-form">Desription</label> <span class="error"> * <?php echo $descErr; ?></span>
<textarea placeholder="Describe your ad" title="Type the description of your ad here" name="descriptionfld" maxlength="500" rows="3" class="form-control" id="descFld"> <?php
if(isset($_POST['descriptionfld'])){echo trim($descriptionfld);}
?></textarea><br>
<label for="pricefld" class="control-form">Price</label> <span class="error"> * <?php echo $priceErr; ?></span>
<div class="input-group">
<span class="input-group-addon">₦</span>
<input class="form-control" type="number" placeholder="Use 0 if its free" name="pricefld"  value="<?php
if(isset($_POST['pricefld'])){
echo $pricefld;
}?>">
</div><br><br>
<label for="state">State</label><span class="error"> * <?php echo $stateErr; ?></span>
<select class="form-control" name="statefld">
<option value="">Select State</option>
<option value="Abia" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Abia'){echo "selected";} ?> >Abia</option>
<option value="Adamawa" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Adamawa'){echo "selected";} ?> >Adamawa</option>
<option value="Akwa-Ibom" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Akwa-Ibom'){echo "selected";} ?> >Akwa-Ibom</option>
<option value="Anambra" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Anambra'){echo "selected";} ?> >Anambra</option>
<option value="Bauchi" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Bauchi'){echo "selected";} ?> >Bauchi</option>
<option value="Bayelsa" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Bayelsa'){echo "selected";} ?> >Bayelsa</option>
<option value="Benue" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Benue'){echo "selected";} ?> >Benue</option>
<option value="Borno" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Borno'){echo "selected";} ?> >Borno</option>
<option value="Cross River" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Cross River'){echo "selected";} ?> >Cross River</option>
<option value="Delta" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Delta'){echo "selected";} ?> >Delta</option>
<option value="Ebonyi" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Ebonyi'){echo "selected";} ?> >Ebonyi</option>
<option value="Edo" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Edo'){echo "selected";} ?> >Edo</option>
<option value="Ekiti" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Ekiti'){echo "selected";} ?> >Ekiti</option>
<option value="Enugu" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Enugu'){echo "selected";} ?> >Enugu</option>
<option value="FCT Abuja" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='FCT Abuja'){echo "selected";} ?> >FCT Abuja</option>
<option value="Gombe" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Gombe'){echo "selected";} ?> >Gombe</option>
<option value="Imo" <?php echo (isset($_POST['state'])&&($_POST['state']=='Imo')?'Selected="selected"':'');?> >Imo</option>
<option value="Jigawa" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Jigawa'){echo "selected";} ?>  >Jigawa</option>
<option value="Kaduna" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Kaduna'){echo "selected";} ?> >Kaduna</option>
<option value="Kano" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Kano'){echo "selected";} ?> >Kano</option>
<option value="Katsina" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Katsina'){echo "selected";} ?> >Katsina</option>
<option value="Kebbi" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Kebbi'){echo "selected";} ?> >Kebbi</option>
<option value="Kogi" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Kogi'){echo "selected";} ?> >Kogi</option>
<option value="Kwara" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Kwara'){echo "selected";} ?> >Kwara</option>
<option value="Lagos" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Lagos'){echo "selected";} ?> >Lagos</option>
<option value="Nassarawa" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Nassarawa'){echo "selected";} ?> >Nassarawa</option>
<option value="Niger" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Niger'){echo "selected";} ?> >Niger</option>
<option value="Ogun" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Ogun'){echo "selected";} ?> >Ogun</option>
<option value="Ondo" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Ondo'){echo "selected";} ?> >Ondo</option>
<option value="Osun" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Osun'){echo "selected";} ?> >Osun</option>
<option value="Oyo" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Oyo'){echo "selected";} ?> >Oyo</option>
<option value="Plateau" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Plateau'){echo "selected";} ?> >Plateau</option>
<option value="Rivers" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Rivers'){echo "selected";} ?> >Rivers</option>
<option value="Sokoto" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Sokoto'){echo "selected";} ?> >Sokoto</option>
<option value="Taraba" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Taraba'){echo "selected";} ?> >Taraba</option>
<option value="Yobe" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Yobe'){echo "selected";} ?> >Yobe</option>
<option value="Zamfara" <?php if(isset($_POST['statefld'])&&$_POST['statefld']=='Zamfara'){echo "selected";} ?> >Zamfara</option>
</select><br>
<label for="town" class="control-form">Town</label><span class="error"> * <?php echo $townErr; ?></span>
<input class="form-control" type="text" name="townfld" placeholder="town/city" 
 value="<?php
if(isset($_POST['townfld'])){
echo $townfld;
}
?>"><br>
<input name="displaynamefld" type="hidden" value="<?php
echo $result['user_nickname'];
?>"><br>
<label for="contact" class="control-form">Contact Number</label> <span class="error"> * <?php echo $contactErr; ?></span>
<input name="contactfld" class="form-control" type="tel" placeholder="phone number" 
maxlength="11" value="<?php
if(isset($_POST['contactfld'])){
echo $contactfld;
}
?>"><br>
<label for="sec" class="control-form">Security Check: What year did Nigeria gain Independence?</label> 
<span class="error"> * <?php echo $secErr; ?></span>
<input class="form-control" name="secfld" type="text" maxlength="5" 
placeholder="********" value="<?php
if(isset($_POST['secfld'])){
echo $secfld;
}
?>"><br>
<p>I have read the <a href="../terms-of-use.php">terms</a> and agree &nbsp;<input type="checkbox" name="agreementfld">  <span class="error"> * <?php echo $agrmntErr; ?></span></p>
<hr>
<input type="hidden" name="datefld" value="<?php echo date("l, d-m-Y h:i:sa"); ?>">
<input type="hidden" name="emailfld" value="<?php echo $emsessvar; ?>">
<input type="hidden" name="useridfld" value="
<?php 
$query = mysqli_query($link, "SELECT user_id FROM users WHERE user_email = '$emsessvar'");
$result = mysqli_fetch_assoc($query);
echo $result['user_id'];
?>">
<input class="btn btn-success" type="submit" name="newAdSubBtn" id="newAdSubBtn" value="Submit ad"/>
</form>
</div>
</div>
</div>
<div class="col-md-6">
</div>
<br><br>
</div>
</div>
</body>
</html>