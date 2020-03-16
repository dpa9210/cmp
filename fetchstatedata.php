<?php
include('dist/core/conx.php');
$per_page = 3;
if($_GET){
	$page = $_GET['page'];
}

$start = ($page-1)*per_page;
$sql = "SELECT * FROM ads WHERE ad_status = '1' order by id limit $start, $per_page";
$rsd = mysqli_query($link, $sql);

?>
<table id="tbl">
<th><b>Name</b></th>
<th><b>Type</b></th>
<th><b>Price</b></th>
<th><b>State</b></th>
<th><b>Town</b></th>
<?php
while ($row = mysqli_fetch_array($rsd)){
	$adname = $row['ad_title'];
	$type = $row['ad_title'];
	$price = $row['ad_price'];
	$state = $row['ad_state'];
	$town = $row['ad_town'];

?>
<tr>
	<td><?php echo $adname ?></td>
	<td><?php echo $type ?></td>
	<td><?php echo $price ?></td>
	<td><?php echo $state ?></td>
	<td><?php echo $town ?></td>
</tr>
<?php
}
?>
</table>