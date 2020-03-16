<?php
include ("dist/core/conx.php");?>
<?php
$name = $_POST['cmtnamefld'];
$email = $_POST['cmtemailfld'];
$body = $_POST['cmtbodyfld'];
$date = $_POST['cmtdatefld'];
$postid = $_POST['cmtpostidfld'];


$sql = "INSERT INTO comment (comment_body, comment_date, post_id, name, comment_email) values('$body', '$date', '$postid', '$name', '$email')";
if(mysqli_query($link, $sql)){ 
	echo "<br><br><p style='color:green'>Successful. Your comment will become visible after approval.</p>";
 }else {
 	echo "pheww, An error has occurred.".mysqli_error($link);
 }
?>