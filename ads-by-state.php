<?php 
require("dist/core/conx.php"); 
//$stateName = ($_POST['mySelection']);
error_reporting(0);
?>

<?php

 $sql = "SELECT COUNT(ad_id) FROM ads WHERE ad_status = '1' AND ad_state LIKE '%".mysqli_real_escape_string($link, $_POST['mySelection'])."%'";
 $query = mysqli_query($link, $sql) or die("An Error has occurred");
 $row = mysqli_fetch_row($query);
 
 $rows = $row[0];
 
 $page_rows = 50;
 
 $last = ceil($rows/$page_rows);
 
 if($last < 1){
 	$last = 1;
 }

 $pagenum = 1;
 
 if(isset($_GET['pn'])){
 	$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
 }


 if ($pagenum < 1){
 	$pagenum = 1;
 }else if ($pagenum > $last){
 	$pagenum = $last;
 }
 
 $limit = 'LIMIT ' .($pagenum - 1) * $page_rows. ',' . $page_rows;
 
 $sql ="SELECT * FROM ads WHERE ad_status = '1' AND ad_state LIKE '%".mysqli_real_escape_string($link, $_POST['mySelection'])."%' $limit";
 $query = mysqli_query($link, $sql) or die("An Error has occurred ");
 $textline1 = 'Ads available in'. " ".mysqli_real_escape_string($link, $_POST['mySelection']).'.';
 $textline2 = "Page <b>$pagenum</b> of <b>$last</b>";

 $paginationCtrls = '';

 if($last !=1){
 	if ($pagenum > 1){
 		$previous = $pagenum - 1;
 		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';

 		for($i = $pagenum-4; $i < $pagenum; $i++){
 			if($i > 0){
 				$paginationCtrls .='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
 			}
 		}

 	}
 		
 	$paginationCtrls .= ''.$pagenum.'&nbsp; ';
 		
 	for ($i = $pagenum+1; $i <= $last; $i++){
 		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a>&nbsp; ';
 		if($i >= $pagenum+4){
 			break;
 		}
 	}
 	
 		if($pagenum != $last){
 			$next = $pagenum + 1;
 			$paginationCtrls .='&nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a>';
 		}

 }

 $list = '';
 while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
 	$id = $row["ad_id"];
 	$name = $row["ad_title"];
 	$type = $row["ad_type"];
 	$price = $row["ad_price"];
 	$desc = $row["ad_description"];
 	$town = $row["ad_town"];
 	$url = $row["url"];
 	$famount = number_format($price);
 	$list.= '<p><a href="ad/'.$id.'/'.$url.'">'."<b>".''.$name .''."</b>"."</a>".' '.'| '.''.'₦ '.''.$famount. ''."<br>".'' .$desc."<br>". $type. ' '.' in '.'  ' .$town.''.'</p>'.'<hr>';

 } 

mysqli_close($link);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Corpers Market Place, Buying and Selling for NYSC Corps members.">
<meta name="keywords" content="">
<meta name="author" content="wizedavis">
<title>Ads Filter by State | Corpers Market Place</title>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="dist/css/cmp.css">
<link rel="icon" href="favicon.ico" type="../image/x-icon">

<!--Scripts-->
<script src="dist/js/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/pnation.js"></script>
</head>
<body>

<!--Conatiner-->
<div class="container" style="background-color:#FFF">
<?php include 'dist/header.php'; ?>
<div class="row">
<div class="col-md-6">

  <h3><?php echo "<div class='well well-sm' style='height:auto;'>".$textline1."</div>"; ?></h3><hr>
  <p><?php echo $textline2; ?></p>
  <p><?php echo $list; ?></p>
  <hr>
  <div id="pagination_controls"><?php echo $paginationCtrls; ?><br></div>

</div>

</div>






<?php

 /*
 //////Displaying Data/////////////
$stateName = mysql_real_escape_string($_POST["mySelection"]); // Collecting data from query string

if ($result = $link->query("SELECT * FROM ads WHERE ad_status = '1' AND ad_state = '$stateName' "))

{
	//display records if any
	if($result->num_rows > 0){
		//display records in a table
		echo "<h3>"."Ads in ". $stateName .' State'."</h3>".".";

		echo "<table class='table table-bordered table-striped table-condensed result'>";
		//set table headers
		echo "<thead>";
		echo "<tr><th>Name</th><th>Type</th><th>Description</th><th>Price</th><th>State</th><th>Town</th><th>Owner</th></tr>";
		echo "</thead>";
		while($row = $result->fetch_object()){
			//set up a row for each record
			
			echo "<tbody>";
			echo "<tr>";
			echo "<td>" ."<a class='active' href='ad-details.php?id=" . $row->ad_id . "'>" .$row->ad_title. "</a>" . "</td>";
			echo "<td>". $row->ad_type . "</td>";
			echo "<td>". $row->ad_description . "</td>";
			echo "<td>"."₦" .$row->ad_price . "</td>";
			echo "<td>". $row->ad_state . "</td>";
			echo "<td>". $row->ad_town . "</td>";
			echo "<td>". $row->ad_sellername . "</td>";
		
		
			echo "</tr>";
			echo "</body>";
			

			
		}

		echo "</table>";
	}
		//if there are no records in the db
		else{
			echo "No Ads posted in $stateName!";
		}
	}
	// show an error if there is an issue with the database query
	else{
	echo "Error with the connection";
}

// close database connection
$link->close();*/

?>
</div>
<div class="col-md-6">

</div>




</div><!--row end-->

<?php include 'dist/footer.php'; ?>
</div><!--container end-->





</body>
</html>















