<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

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

if($result_A->num_rows > 0){
    // num_rowsが１以上の場合そのユーザーネームは既に使われている為登録できない。
    echo '<font color="red">'."Error: Sorry. This username is already used.".'</font>';
    echo "<br><br>";
    echo '<font color="red">'."Please go back page.".'</font>';
    echo "<br><br>"	;
} if($result_B->num_rows > 0){
    // num_rowsが１以上の場合そのアドレスは既に使われている為登録できない。
    echo '<font color="red">'."Error: Sorry. This E-mail address is already used.".'</font>';
    echo "<br><br>";
    echo '<font color="red">'."Please go back page.".'</font>';
    	
}else {
		// num_rowsが０の場合、新しく登録できる。
		$sql_C = "INSERT INTO user (name, email, password, age, gender)
		VALUES('$name', '$email','$password', '$age','$gender')";

		if ($conn->query($sql_C) === TRUE) {
			echo "New record created successfully!!";
			echo "<br><br><a href='retieve_activity.php'>Go to Login page</a>";
		} else {
			echo "Error: " . $sql_C . "<br>" . $conn->error;
			echo "<br><br><a href='retieve_activity.php'>Back to Register home</a>";
		}	
	}

?>

</body>
</html>