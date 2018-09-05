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

	$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
// WHEREにemailとpasswordを指定してるのでどちらもが見つかればその時点でチェックできたことになる。
	$result = $conn->query($sql); 

    if($result->num_rows > 0){
 
     while ($row = $result->fetch_assoc()){
		$name = $row["name"];
		$email2 = $row["email"];
		$age = $row["age"];
		$gender = $row["gender"];
		$occupation = $row["occupation"];
		$place = $row["place"];
		$introduce = $row["introduce"];
		$img = $row['img'];
	}
		$_SESSION["name"] = $name;
    	$_SESSION["email"] = $email2;
    	$_SESSION["age"] = $age;
    	$_SESSION["gender"] = $gender;
    	$_SESSION["occupation"] = $occupation;
    	$_SESSION["place"] = $place;
    	$_SESSION["introduce"] = $introduce;
		$_SESSION["img"] = $img;
		$_SESSION["email_A"] = "";
   
		header("Location:homepage.php");

	} else {
		echo '<font color="red">'."（注）ユーザ名もしくはパスワードが違っています。".'</font>';
	}


}
?>
<div class="form">
<h2><font color="rainbow"> USER </font></h2>
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

</div>
<br>
<input type="button" value="Register" onClick="location.href='user_register.php'"
class="register">
<br><br>
<a href="forget_pass.php">In case you forget your password... </a>
</div>

<div class="footer">
	<footer>
	</footer>
</div>


</body>
</html