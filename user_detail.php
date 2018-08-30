
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
		<div class="E-Quire">
		<input type="button" name='E-Quire' value="E-Quire" onClick="location.href='homepage.php'"
		style="border:none;background-color:transparent;
					color:blue; font-size:35px; font-style:italic; font-weight: bold;">
	</div>			

		<div class="search">
		<form action="homepage.php" method="POST">
		　　	<input type="text" name="search" placeholder="　Search"style="height:25px; width:300px; border-radius:15px;" >
			<select name="category" >
				<option value="">すべて</option>
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
		</div>
	</header>	

<div class="profile">
<h2>User Information</h2>
 	<div class="image">
<?php 
include 'dbconnect4.php';	
$name = $_POST["name"];
$sql = "SELECT * FROM user WHERE name = '$name'";
$result = $conn->query($sql);

if($result->num_rows > 0){
	while ($row = $result->fetch_assoc()){

$img = $row['img'];
      echo   "<img src=uploads/$img  width='120' height='120'>";  
}
}
?>
 	</div>
<h4><i>NAME :　</i><?php  echo $_SESSION["name"]; ?></h4><br>
<h4><i>E-mail :</i><br><?php echo$_SESSION["email"]; ?></h4>
<h4><i>Age :　</i><?php echo $_SESSION["age"]; ?></h4>
<h4><i>Gender :　</i><?php echo $_SESSION["gender"]; ?></h4>
<h4><i>Occupation :　</i><?PHP echo $_SESSION["occupation"]; ?></h4>
<h4><i>place :</i><?php echo $_SESSION["place"]; ?></h4>
<h4><i>Self Introduction </i></h4>
<div class="introduction">
<?php echo $_SESSION["introduce"]; ?>
</div>
<input type="button" value="Edit" onClick="location.href='user_edit.php'">
</div>


</div>
<div class="footer">
	<div class="logout">
		<input type="button" name='logout' value="Logout" onClick="location.href='logout.php'"
		style="border:none;background-color:transparent;
					color:#ffffff; font-size:16px;">
	</div>	
	<footer>
	</footer>	
</div>
</body>
</html>