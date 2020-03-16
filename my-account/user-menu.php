<h5 style="color:Brown;">Welcome <?php 
$query = mysqli_query($link, "SELECT user_nickname FROM users WHERE user_email = '$emsessvar'");
$result = mysqli_fetch_assoc($query);
echo "<a href='account'>".$result['user_nickname']."</a>";
?> | <a href="logout">[Logout]</a>  </h5><br>
