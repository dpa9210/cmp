<?php require("dist/core/conx.php");?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Buying and Selling for Corpers">
<meta name="keywords" content="">
<meta name="author" content="wizedavis">
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="dist/css/cmp.css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<script src="dist/js/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
</head>
<body>
<b>Post your comment</b><br>
<form id ="commentform" method="post" action="dist/ncp.php" class="commentformwidth" >
<input type="text" name="name" id="cmtnamefld" name="cmtnamefld" placeholder="name" class="form-control" required><br>
<input type="email" name="email" placeholder="email" id="cmtemailfld" name="cmtemailfld" class="form-control" required><br>
<textarea name="comment" maxlength="200" class="form-control" id="cmtbodyfld" name="cmtbodyfld" placeholder="Comment here" required></textarea>
<input type="hidden" name="cmtdatefld" name="cmtdatefld" value="<?php echo date("l, d-m-Y");?>">
<input type="hidden" id="cmtpostidfld" name="cmtpostidfld" value="<?php echo $id ;?>"><br>
<button id="subCom" class="btn btn-info">Post</button>
</form>
<br>
<span id="commentresponse"></span>
<script src="ncp.js"></script>
</body>
</html>