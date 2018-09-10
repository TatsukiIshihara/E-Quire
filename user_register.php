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


<div class="form">
<h2>Registration Form</h2>
<form action="user_register2.php"  method="POST"><br>
 	<p>User Name: <input type="text" name="name" placeholder="<!>Name must be unique." maxlength="30" required></p><br>
 	<p>E-mail: <input type="email" name="email" required maxlength="50"></p><br>
 	<p>Password: <input type="password" name="password" placeholder="<!>パスワードは８文字"
 					 maxlength="8" minlength="8" required></p><br>
 <p>Age: <select name="age" required>
 		<option value="" selected="selected">選択してください</option>
		<option value="10代">10代</option>
		<option value="20代">20代</option>
		<option value="30代">30代</option>
		<option value="40代">40代</option>
		<option value="50代以上">50代以上</option></p>
	</select><br><br>	
 	
 	<p>Gender: <input type="radio" name="gender" value="male" required>Male
			   <input type="radio" name="gender" value="female" required>Female</p>
    <br>
    <input type="submit" name="submit"　value="登録" >	
</form>
<br><br>
<a href="user_login.php">Back to Login page </a>
</p>
</div>
<div class="footer">
	<footer>
	</footer>	
</div>

</body>
</html>