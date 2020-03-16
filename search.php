<?php require("dist/core/conx.php"); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Buying and Selling for Corpers">
<meta name="keywords" content="">
<meta name="author" content="wizedavis">
<title>Search Result | Corpers Market Place</title>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="dist/css/cmp.css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!--Scripts-->
<script src="dist/js/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>

</head>
<body>

<!--Conatiner-->
<div class="container" style="background-color:#FFF">
<?php include 'dist/header.php'; ?>
<div class="row">
<div class="col-md-6">
<div class="page-header"><h3>Search Result</h3></div>
<?php
    
$button = $_GET ['submit'];
$search = $_GET ['search']; 
  
if(strlen($search)<=1)
echo "Search term too short, please type a word or more.";
else{
echo "You searched for <b>$search</b> <hr size='1'>";

    
$search_exploded = explode (" ", $search);
 
$x = "";
$construct = "";  
    
foreach($search_exploded as $search_each)
{
$x++;
if($x==1)
$construct .="ad_title LIKE '%$search_each%'";
else
$construct .="AND ad_description LIKE '%$search_each%'";
    
}
  
$constructs ="SELECT * FROM ads WHERE ad_status = '1' AND $construct";
$run = mysqli_query($link, "$constructs");
    
$foundnum = mysqli_num_rows($run);
    
if ($foundnum==0)
echo "Sorry, there are no matching results for <b>$search</b>.</br></br>1. 
Try more/other words</br>2. Please check your spelling";
else
{ 
  
echo "<b>$foundnum</b> results found!<p>";
  
$per_page = 20;
$start = isset($_GET['start']) ? $_GET['start']: '';
$max_pages = ceil($foundnum / $per_page);
if(!$start)
$start=0; 
$getquery = mysqli_query($link, "SELECT * FROM ads WHERE ad_status = '1' AND $construct LIMIT $start, $per_page");
  
while($runrows = mysqli_fetch_assoc($getquery))
{
$id = $runrows['ad_id'];
$title = $runrows ['ad_title'];
$desc = $runrows ['ad_description'];
$price = $runrows['ad_price'];
$state = $runrows['ad_state'];
$town = $runrows['ad_town'];
$url = $runrows['url'];
$famount = number_format($price);
			

   
echo "<a class='sr' href='ad/".$id."/".$url."'><b>$title</b></a> | ₦ $famount <br>
$desc<br>$town, $state state <br><br>";
    
}
  
//Pagination Starts
echo "<center>";
  
$prev = $start - $per_page;
$next = $start + $per_page;
                       
$adjacents = 3;
$last = $max_pages - 1;
  
if($max_pages > 1)
{   
//previous button
if (!($start<=0)) 
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$prev'>Prev</a> ";    
          
//pages 
if ($max_pages < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
{
$i = 0;   
for ($counter = 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
}  
$i = $i + $per_page;                 
}
}
elseif($max_pages > 5 + ($adjacents * 2))    //enough pages to hide some
{
//close to beginning; only hide later pages
if(($start/$per_page) < 1 + ($adjacents * 2))        
{
$i = 0;
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
} 
$i = $i + $per_page;                                       
}
                          
}
//in middle; hide some front and some back
elseif($max_pages - ($adjacents * 2) > ($start / $per_page) && ($start / $per_page) > ($adjacents * 2))
{
echo " <a href='search.php?search=$search&submit=Search+source+code&start=0'>1</a> ";
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$per_page'>2</a> .... ";
 
$i = $start;                 
for ($counter = ($start/$per_page)+1; $counter < ($start / $per_page) + $adjacents + 2; $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
}   
$i = $i + $per_page;                
}
                                  
}
//close to end; only hide early pages
else
{
echo " <a href='search.php?search=$search&submit=Search+source+code&start=0'>1</a> ";
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$per_page'>2</a> .... ";
 
$i = $start;                
for ($counter = ($start / $per_page) + 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";   
} 
$i = $i + $per_page;              
}
}
}
          
//next button
if (!($start >=$foundnum-$per_page))
echo " <a href='search.php?search=$search&submit=Search+source+code&start=$next'>Next</a> ";    
}   
echo "</center>";
} 
} 
?>
  














</div>




</div>

</div>

<div class="col-md-6"></div>




</div><!--row end-->

<?php include 'dist/footer.php'; ?>
</div><!--container end-->





</body>
</html>















