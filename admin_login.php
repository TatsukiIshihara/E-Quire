<?php
session_start();

include 'dbconnect4.php';
?> 
<!DOCTYPE html>

<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="user_login.css">
</head>
<body>

<div class="header">
	<header>
		

	</header>	
	<h1>E-Quire</h1>
</div>	
 <?php	
if (isset($_POST["login"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$sql = "SELECT * FROM admin WHERE Aemail = '$email' AND Apassword = '$password'";
s
	$result = $conn->query($sql); 

    if($result->num_rows > 0){
    	$_SESSION["username"] = $username;
		header("Location:retieve_activity.php");
	} else {
		echo '<font color="red">'."（注）ユーザ名もしくはパスワードが違っています。".'</font>';
	}


}
?> 
<div class="form">
<h2><font color="blue"> ADMIN </font></h2>
 <div class="form2"> 
<h2> LOGIN Form</h2><br>
<form action="user_login.php" method="POST">
 	<p> Email Adress: <input type="text" name="email" required class="email"></p><br>
 	<p> Password: <input type="Password" name="password" 
 					 placeholder="<!>パスワードは８文字。"
 					maxlength='8' minlength="8" required class="password"></p>
 	<br><br>
    <input type="submit" name="login" value="LOGIN" class="login">	<br><br>
 </form> 
</form>
</div>
<br>
<input type="button" value="Register" onClick="location.href='insert_activity.php'"
class="register">
</div>
<div class="footer">
	<footer>
	</footer>	
</div>


</body>
</html