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
	<link rel="stylesheet" type="text/css" href="admin_userlist.css">
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

$img = $_SESSION['img'];
      echo    "<img src=uploads/$img width='120' height='120'>";  
   
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
<input type="button" value="Edit" onClick="location.href='admin_edit.php'">
</div>


<?php
include 'dbconnect4.php';
             
if(isset($_POST["submit"])){
	$search = $_POST["search"];
	$select = $_POST["category"];
 	
	 $SearchSQL = "SELECT * FROM question WHERE CONCAT(category , name ,  title , content) LIKE '%$search%' AND category LIKE '%$select%'";
 	
	$result = $conn->query($SearchSQL);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$name = $row["name"];
			$category = $row["category"];
			$title = $row["title"];
			$content = $row["content"];
			$questID =$row["questID"];

			echo "<div class='result'>";
			echo "<form action='user_detail.php' method='POST'>";
			echo "<a style='font-size:30px; font-style:italic; font-family:'ＭＳ明朝';'>Q</a>";
			echo "uestion　　　";
			echo "<input type='hidden' name='name' value='$name'>";
			echo "<a><input type='submit'  value='$name'
					style='border:none;background-color:transparent;
					color:#fcff4c;text-decoration:underline; font-size:20px;'></a>";
			echo "</form>";
			echo "カテゴリー : $category <br>";
			echo "質問タイトル : $title <br>";
			
			echo "<form action='QandA.php' method='POST'>";
			echo "<input type='hidden' name='questID' value=$questID>";
			echo "<input type='submit' name='submit' value='詳しく見る'>";
			echo "</form>";
			echo "</div>";
		}
	} else {
		echo "No match found";
	}
} else { 
	echo "<div class='myquestion'>";
	echo "<h2>User's List</h2><br><br>";
	if(isset($_POST["userID"])){
	$userID = $_POST["userID"];
	$sql_delete = "DELETE FROM user WHERE userID='$userID'";
	if ($conn->query($sql_delete) === TRUE) {
		echo "Record is deleted successfully!!";
		echo "<br>";
	} else {
		echo "Error during deleting record.: " . $conn->error;
		echo "<br>";
	}
}

	$username = $_SESSION["name"];
	$defaultSQL = "SELECT * FROM user ";
	$result2 = $conn->query($defaultSQL);


	if ($result2->num_rows > 0) {
		while($row2 = $result2->fetch_assoc()) {
			$userID = $row2["userID"];
			$name = $row2["name"];
			$email = $row2["email"];
			$img = $row2['img'];
			
			echo "<div class='image'>";
            echo "<img src=uploads/$img width='120' height='120'>";  
 	        echo "</div>";
 	        echo "<div class='userinfo'>";
 	        echo "ユーザーID : $userID <br>";
			echo "<form action='user_detail.php' method='POST'>";
			echo "User Name : ";
			echo "<input type='hidden' name='name' value='$name'>";
			echo "<a><input type='submit'  value='$name'
					style='border:none;background-color:transparent;
					color:#fcff4c;text-decoration:underline; font-size:20px;'></a>";
			echo "</form>";
			echo "E-mail : $email<br>";
			echo "<form action='admin_userlist.php' method='POST'>";
			echo "<input type='hidden' name='userID' value='$userID'>";
			echo "　　　　　　　　　　　     　　　　　　　";
			echo "<input type='submit' value='Delete' onclick='return confirm('Are you sure?') >";
			echo "</form>";
			echo "<br>";
			echo "</div>";
			echo "<br><br>";
		}
}
 echo "</div>";
}

?>

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