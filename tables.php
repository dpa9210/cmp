<?php
require('dist/core/conx.php');


$tbl_user = "CREATE TABLE IF NOT EXISTS user(
			 id INT(20) NOT NULL AUTO_INCREMENT,
			 nickname VARCHAR(15) NOT NULL,
			 email VARCHAR(30) NOT NULL,
			 password VARCHAR(15) NOT NULL,
			 gender ENUM('Male', 'Female') NOT NULL,
			 userlevel ENUM('a','b') NOT NULL DEFAULT 'a',
			 ip VARCHAR(255) NOT NULL,
			 signupdate VARCHAR(30) NOT NULL,
			 activated ENUM('0','1') NOT NULL DEFAULT '1', 
			 UNIQUE KEY email (email),
			 PRIMARY KEY (id)
			 
	)";
$query = mysqli_query($link, $tbl_user);
if ($query === TRUE){
	echo "Users table created successfully :)"."<br>"."<br>";
	
	}else{
		echo "<h3>User table not created :(</h3>".mysqli_error($link)."<br>"."<br>";
}

//////////////////////////////////////////////////////////////
$tbl_product = "CREATE TABLE IF NOT EXISTS product(
				id INT(255) NOT NULL AUTO_INCREMENT,
				category VARCHAR(30) NOT NULL,
				type VARCHAR(15) NOT NULL,
				title VARCHAR(50) NOT NULL,
				description VARCHAR(255) NOT NULL,
				price VARCHAR(15) NOT NULL,
				state VARCHAR(15) NOT NULL,
				town VARCHAR(20) NOT NULL,
				name VARCHAR(100) NOT NULL,
				contact VARCHAR(11) NOT NULL,
				createdate VARCHAR(30) NOT NULL,
				ipadd VARCHAR(80) NULL,
				ua VARCHAR(180) NULL,
				status ENUM('0', '1') NOT NULL DEFAULT '0',
				PRIMARY KEY (id)
				)";
$query = mysqli_query($link, $tbl_product);
if ($query === TRUE){
	echo "Products table created successfully :)"."<br>"."<br>";
	
	}else{
		echo "Products table not created :(".mysqli_error($link)."<br>"."<br>";
}

////////////////////////////////////////////////////

$tbl_admin = "CREATE TABLE IF NOT EXISTS manager(
			   id INT(1) NOT NULL AUTO_INCREMENT,
			   nickname VARCHAR(10) NOT NULL,
			   email VARCHAR(15) NOT NULL,
			   password VARCHAR(15) NOT NULL,
			   PRIMARY KEY (id),
			   UNIQUE KEY email (email))";
$query = mysqli_query($link, $tbl_admin);
if ($query === TRUE){
	echo "Admin table created succesfully"."<br>"."<br>";
	} else{
		echo "There was an error creating the admin table".mysqli_error($link)."<br>"."<br>";
		}
		
//////////////////////////////////////////////////////////////////

$tbl_useroptions = "CREATE TABLE IF NOT EXISTS useroptions(
				id INT(11) NOT NULL,
				email VARCHAR(25) NOT NULL,
				question VARCHAR(255) NOT NULL,
				answer VARCHAR(255) NOT NULL,
				PRIMARY KEY (id),
				UNIQUE KEY email (email)
				)";
$query = mysqli_query($link, $tbl_useroptions);
if ($query === TRUE){
	echo "User Options table created successfully"."<br>"."<br>";
	} else{
		echo "There was an error creating the user options table".mysqli_error($link)."<br>"."<br>";
		}


//////////////////////////////////////////////////////////////


////////////////////////////////////////////////////

$tbl_user = "CREATE TABLE IF NOT EXISTS users(
			 user_id INT(20) NOT NULL AUTO_INCREMENT,
			 user_nickname VARCHAR(15) NOT NULL,
			 user_email VARCHAR(30) NOT NULL,
			 user_password VARCHAR(15) NOT NULL,
			 user_ip VARCHAR(30) NOT NULL,
			 user_signupdate VARCHAR(40) NOT NULL,
			 activated ENUM('0','1') NOT NULL DEFAULT '1', 
			 UNIQUE KEY user_email (user_email),
			 PRIMARY KEY (user_id)
			 
	)";
$query = mysqli_query($link, $tbl_user);
if ($query === TRUE){
	echo "Users table created successfully :)"."<br>"."<br>";
	
	}else{
		echo "<h3>User table not created :(</h3>".mysqli_error($link)."<br>"."<br>";
}

////////////////////////////////

/////////////////////////////////////////////////////////
$tbl_ads = "CREATE TABLE IF NOT EXISTS ads(
				ad_id INT(255) NOT NULL AUTO_INCREMENT,
				ad_title VARCHAR(20) NOT NULL,
				ad_type VARCHAR(20) NOT NULL,
				ad_description VARCHAR(200) NOT NULL,
				ad_price VARCHAR(15) NOT NULL,
				ad_state VARCHAR(15) NOT NULL,
				ad_town VARCHAR(20) NOT NULL,
				ad_sellername VARCHAR(100) NOT NULL,
				ad_contact VARCHAR(11) NOT NULL,
				ad_email VARCHAR(20) NOT NULL,
				ad_status ENUM('0', '1') NOT NULL DEFAULT '1',
				ad_date VARCHAR(40) NOT NULL,
				user_id INT(20) NOT NULL,
				PRIMARY KEY (ad_id),
				FOREIGN KEY (user_id) REFERENCES users(user_id)
				ON DELETE CASCADE 
				ON UPDATE CASCADE
				)";
$query = mysqli_query($link, $tbl_ads);
if ($query === TRUE){
	echo "Ads table created successfully :)"."<br>"."<br>";
	
	}else{
		echo "Ads table not created :(".mysqli_error($link)."<br>"."<br>";
}


//////////////////////////////////
$tbl_blogposts = "CREATE TABLE IF NOT EXISTS post(
		post_id INT(255) NOT NULL AUTO_INCREMENT,
		post_title VARCHAR(30) NOT NULL,
		seo_title VARCHAR(50) NOT NULL,
		post_body VARCHAR(1000) NOT NULL,
		post_date VARCHAR(40) NOT NULL,
		post_user VARCHAR(15) NOT NULL,
		PRIMARY KEY (post_id)

	)";
$query = mysqli_query($link, $tbl_blogposts);
if($query === TRUE){
	echo "Blog table created successfully"."<br>";
}else{
	echo "Blog table not created".mysqli_error($link);
}

///////////////////////////////////////////////////
$tbl_comments = "CREATE TABLE IF NOT EXISTS comment(
		comment_id INT(255) NOT NULL AUTO_INCREMENT,
		name VARCHAR(20) NOT NULL,
		comment_body VARCHAR(200) NOT NULL,
		comment_date VARCHAR(20) NOT NULL,
		comment_email VARCHAR(30) NOT NULL,
		comment_status ENUM('0', '1') NOT NULL DEFAULT '0',
		post_id INT(255) NOT NULL,
		PRIMARY KEY (comment_id),
		FOREIGN KEY (post_id) REFERENCES post(post_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE

	)";
	$query = mysqli_query($link, $tbl_comments);
	if($query === TRUE){
		echo "Comment table created";
	}else{
		echo "Error occurred while creating comment table".mysqli_error($link);
	}
?>