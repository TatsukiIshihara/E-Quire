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
if (isset($_POST["submit"])) {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$age = $_POST["age"];
	$gender =$_POST["gender"];

	$sql = "SELECT * FROM user WHERE email = '$email' AND name = '$name'
			 AND age ='$age' AND gender = '$gender'";
// WHEREに指定してるすべてが見つかればその時点でチェックできたことになる。
	$result = $conn->query($sql); 

    if($result->num_rows > 0){
    	while ($row = $result->fetch_assoc()){
		$password = $row["password"];
		}
    	$title = "E-Quireからパスワードの確認";
    	mb_language("Japanese");
		mb_internal_encoding("UTF-8");
		if(mb_send_mail($email, $title, "あなたのパスワード　".$password)){
        echo "メールを送信しました";
      } else {
        echo "メールの送信に失敗しました";
      } 
  	}else{
      	echo '<font color="red">'."送信情報に誤りがあります。".'</font>';
      }
}      
 ?> 
<div class="form">
<h3>In case you forget your password</h3>
<h3>Please input your  registered information</h3>
<h4>I will send you e-mail</h4>
<form action="forget_pass.php"  method="POST"><br>
 	<p>User Name: <input type="text" name="name" placeholder="<!>Name must be unique." maxlength="30" required></p><br>
 	<p>E-mail: <input type="email" name="email" required maxlength="50"></p><br>
 	
 <p>Age: <select name="age" required>
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