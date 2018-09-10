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
	<link rel="stylesheet" type="text/css" href="askquestion.css">
</head>
<body>
<div class="header">
	<header>
		<div class="E-Quire">
			<?php	
	if ($_SESSION["email_A"]=="") { ?>
		<input type="button" name="E-Quire" value="E-Quire" onClick="location.href='homepage.php'"
		style="border:none;background-color:transparent;
					color:blue; font-size:35px; font-style:italic; font-weight: bold;">
	<?php
	} else { ?>
		<input type="button" name="E-Quire" value="E-Quire" onClick="location.href='admin_userlist.php'"
		style="border:none;background-color:transparent;
					color:blue; font-size:35px; font-style:italic; font-weight: bold;">
		(admin)	
	<?php				
	}
	?>			
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
	</header>
</div>	
 <div class="profile">
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
<h4><i>NAME :　</i><?php  echo $_SESSION["name"]; ?></h4><br>
<h4><i>E-mail :　</i><br><?php echo $_SESSION["email"]; ?></h4>
<h4><i>Age :　</i><?php echo $_SESSION["age"]; ?></h4>
<h4><i>Gender :　</i><?php echo $_SESSION["gender"]; ?></h4>
<h4><i>Occupation :　</i><?PHP echo $_SESSION["occupation"]; ?></h4>
<h4><i>place :　</i><?php echo $_SESSION["place"]; ?></h4>
<h4><i>Self Introduction </i></h4>
<div class="introduction">
<?php echo $_SESSION["introduce"]; ?>
</div>
<input type="button" value="Edit" onClick="location.href='user_edit.php'">
</div>

<br>

<div class="ask">

	
	<h2>Ask Question</h2>
	<form action="askquestion.php" method="POST">
		<p>Category: <select name="category" required>
			<option value="">すべて</option>
			<option value="スポーツ">スポーツ</option>
			<option value="外国語">外国語</option>
			<option value="科学">科学</option>
			<option value="社会・経済">社会・経済</option>
			<option value="法律・政治">法律・政治</option>
			<option value="プログラミング">プログラミング</option>
			<option value="生活">生活</option>
			<option value="その他">その他</option>
		</select><br><br>
		<p>質問タイトル</p> 
		<div class="title">
			<textarea name="title" required style="height:150px; width:450px; max-width:450px; "></textarea>
		</div>	
		<br><br><br>
		<p>質問詳細</p>
		<textarea name="content" required style="height:300px; width:450px; max-width:450px; "></textarea>
 	
 	 	<br>
    	<input type="submit" name="register"　value=" Submit ">
	</form>

	<?php
	if(isset($_POST["register"])) {
		$name = $_SESSION["name"];
		$category = $_POST["category"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		include 'dbconnect4.php';

			// num_rowsが０の場合、新しく登録できる。
			$sql = "INSERT INTO question (name, category, title, content)
			VALUES('$name', '$category','$title', '$content')";

			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully!!";
				echo "<br><br><a href='homepage.php'>Back to Main home</a>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				echo "<br><br>ページを戻ってください</a>";
			}	
	}
		
	?>
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