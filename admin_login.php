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

	$email = $_POST["email"];
	$password = $_POST["password"];

	$sql = "SELECT * FROM admin WHERE Aemail = '$email' AND Apassword = '$password'";

	$result = $conn->query($sql); 

	if($result->num_rows > 0){
 
     while ($row = $result->fetch_assoc()){
		$name = $row["Aname"];
		$email2 = $row["Aemail"];
		$age = $row["Aage"];
		$gender = $row["Agender"];
		$occupation = $row["Aoccupation"];
		$place = $row["Aplace"];
		$introduce = $row["Aintroduce"];
		$img = $row['Aimg'];
	}
		$_SESSION["name"] = $name;
    	$_SESSION["email"] = $email2;
    	$_SESSION["age"] = $age;
    	$_SESSION["gender"] = $gender;
    	$_SESSION["occupation"] = $occupation;
    	$_SESSION["place"] = $place;
    	$_SESSION["introduce"] = $introduce;
		$_SESSION["img"] = $img;
		
		$_SESSION["email_A"] = $email2;
   
		header("Location:admin_userlist.php");

	} else {
		echo '<font color="red">'."（注）ユーザ名もしくはパスワードが違っています。".'</font>';
	}


}
?> 
<div class="form">
<h2><font color="blue"> ADMIN </font></h2>
 <div class="form2"> 
<h2> LOGIN Form</h2><br>
<form action="admin_login.php" method="POST">
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
<input type="button" value="User Login" onClick="location.href='user_login.php'"
class="register">
</div>
<div class="footer">
	<footer>
	</footer>	
</div>


</body>
</html