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
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$age =  $_POST["age"];
$gender = $_POST["gender"]; 


include 'dbconnect4.php';


	
$sql_A = "SELECT * FROM user WHERE name = '$name'";
// パスワードチェックと同じ考え方。
// WHEREで$nameが見つかれば、そのユーザーネームは既に使われている。
$result_A = $conn->query($sql_A); 

$sql_B = "SELECT * FROM user WHERE email = '$email'";
$result_B = $conn->query($sql_B); 
$count= mb_strlen( $name, 'UTF-8');

$error = 0;

if($result_A->num_rows > 0){
	$error = 1;

    // num_rowsが１以上の場合そのユーザーネームは既に使われている為登録できない。
    echo '<font color="red">'."Error: Sorry. This username is already used.".'</font>';
    echo "<br><br>";
    echo '<font color="red">'."Please go back page.".'</font>';
    echo "<br><br><a href='user_register.php'>Back to Register home</a>";
    echo "<br><br>"	;
} if($result_B->num_rows > 0){
	$error = 1;
    // num_rowsが１以上の場合そのアドレスは既に使われている為登録できない。
    echo '<font color="red">'."Error: Sorry. This E-mail address is already used.".'</font>';
    echo "<br><br>";
    echo '<font color="red">'."Please go back page.".'</font>';
    echo "<br><br><a href='user_register.php'>Back to Register home</a>";
    	
} if( $count > 31){
		$error = 1;
	echo "<br><br>";
    echo '<font color="red">'."　Error: Sorry. Japanese characters must be less than 31 characters."
    		.'</font>';
    echo "<br><br>";
    echo '<font color="red">'."　Please go back page.".'</font>';	
    echo "<br><br><a href='user_register.php'>Back to Register home</a>";	

}  if ($error == 0) {
// num_rowsが０の場合、新しく登録できる。
		$sql_C = "INSERT INTO user (name, email, password, age, gender)
		VALUES('$name', '$email','$password', '$age','$gender')";

		if ($conn->query($sql_C) === TRUE) {
			echo "New record created successfully!!";
			echo "<br><br><a href='user_login.php'>Go to Login page</a>";
		} else {
			echo "Error";
			echo "<br><br><a href='user_register.php'>Back to Register home</a>";
		}	
	}
	

		

?>
</div>
<div class="footer">
	<footer>
	</footer>	
</div>
</body>
</html>