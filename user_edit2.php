<?php
session_start();

if($_SESSION["email"]==""){
	header("Location: user_login.php");
}	
include 'dbconnect4.php';	
?>
<!DOCTYPE html>

<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="user_edit.css">
</head>
<body>
<div class="header">
	<header>
		<h1>E-Quire</h1>

		<div class="search">
		<form action="homepage.php" method="POST">
		　　	<input type="text" name="search" placeholder="　Search"style="height:25px; width:300px; border-radius:15px;" >
			<select name="category" >
				<option value="*">すべて</option>
				<option value="スポーツ">スポーツ</option>
				<option value="外国語">外国語</option>
				<option value="科学">科学</option>
				<option value="社会・経済">社会・経済</option>
				<option value="法律・政治">法律・政治</option>
				<option value="プログラミング">プログラミング</option>
				<option value="生活">生活</option>
				<option value="その他">その他</option>
			</select>
			<input type="submit" name="submit" value="Submit">
		</form>
		</div>
	</header>	

<div class="profile">
<?php

$age = $_POST["age"];
$gender = $_POST["gender"];
$occupation =  $_POST["occupation"];
$place = $_POST["place"]; 
$introduce = $_POST["introduce"];
$email = $_SESSION["email"];


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$image = $_FILES["fileToUpload"]["name"];


	$sql = "UPDATE user SET age='$age', gender='$gender', occupation='$occupation', place='$place', introduce='$introduce', img='$image' WHERE email = '$email'";


	if($conn->query($sql) === TRUE) {
		echo "Record is updated successfully";	

		// echo "NAME: $_SESSION['name']";
		// echo "E-Mail: $_SESSION['email']";
		// echo "Age: $age";
		// echo "gender: $gender";
		// echo "Occupation: $occupation";
		// echo "Place: $place";
		// echo "Self Introduce<br>$introduce";
	} else {
		echo "Error during updating record:" . $conn->error;
	}

?>
</form>
<br><br>
<a href="http://192.168.33.10/PHPForm-Activity/retieve_activity.php">Back to Home </a>
</div>


<div class="footer">
	<footer>
	</footer>	
</div>
</body>
</html>	