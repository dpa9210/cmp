<?php
session_start();
include "../dist/core/conx.php";

function string_limit_words($string, $word_limit) 
{
$words = explode(' ', $string);
return implode(' ', array_slice($words, 0, $word_limit));
}

$title = $_POST['titlefld'];
$body = $_POST['postbodyfld'];
$date = $_POST['datefld'];
$name = $_POST['nicknamefld'];

//Title to friendly URL conversion
$newtitle=string_limit_words($title, 8); 
$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
$newurltitle=str_replace(" ","-",strtolower($newtitle));
$url= $newurltitle; // Final URL


$sql = "INSERT INTO post (post_title, seo_title, post_body, post_date, post_user) values ('$title', '$url', '$body', '$date', '$name')";
if(mysqli_query($link, $sql)){
	echo "<br><br><p style='color:green'>Insert Successful</p>";
 }else {
 	echo "pheww, An error has occurred.";
 }

 ?>

