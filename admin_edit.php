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
<h2>Registration Form</h2>
 	<div class="image">
<?php 
$email = $_SESSION["email"];
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql); 

if($result->num_rows > 0){
	while ($row = $result->fetch_assoc()){

$img = $row['img'];
      echo    "<img src=uploads/$img width='120' height='120'>";  
    
       
}
}
?>
 	</div>
<p>プロフィール画像</p> 	
<form action="admin_edit2.php"  method="POST" enctype="multipart/form-data"><br>
	 <input type="file" name="fileToUpload" id="fileToUpload"　>
 	<p>User Name: <?php echo $_SESSION['name'] ;?> </p><br>
 	<p>E-mail: <?php echo $_SESSION['email']; ?></p><br>
 	<!-- <p>Password: <input type="password" name="password" placeholder="<!>パスワードは８文字"
 					 maxlength="8" minlength="8" required></p><br> -->
 <p>Age: <select name="age" required>
		<option value="10代"<?php if($_SESSION['age']=="10代"){echo "selected";}?>>10代</option>
		<option value="20代"<?php if($_SESSION['age']=="20代"){echo "selected";}?>>20代</option>
		<option value="30代"<?php if($_SESSION['age']=="30代"){echo "selected";}?>>30代</option>
		<option value="40代"<?php if($_SESSION['age']=="40代"){echo "selected";}?>>40代</option>
		<option value="50代以上"<?php if($_SESSION['age']=="50代以上"){echo "selected";}?>>50代以上</option></p>
	</select><br><br>	
 <p>Gender: <input type="radio" name="gender" value="male"
 				<?php if ($_SESSION['gender'] == "male" ) { echo "checked";}?>
 				 required>Male
			   <input type="radio" name="gender" value="female"
			    <?php if ($_SESSION['gender'] == "female" ) { echo "checked";}?>
			    required>Female	
	<p>Occupation: <input type="text" name="occupation" value="<?php echo $_SESSION['occupation'] ;?>">
 	<p>Place: <input type="text" name="place" value="<?php echo $_SESSION['place'] ;?>"placeholder="（例）東京都">
 	<p>Self Introduction</p>
 	
 	<p><textarea name="introduce" ><?php echo $_SESSION['introduce'] ;?></textarea></p>	
    
    <input type="submit" name="edit"　value=" Submit ">	
</form>
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