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
	<link rel="stylesheet" type="text/css" href="homepage.css">
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
	</header>

</div>
 <div class="profile">
 	<div class="image">
<?php 
// $email = $_SESSION["email"];
// $sql = "SELECT * FROM user WHERE email = '$email'";
// $result = $conn->query($sql); 

// if($result->num_rows > 0){
// 	while ($row = $result->fetch_assoc()){

$img = $_SESSION['img'];
      echo    "<img src=uploads/$img width='120' height='120'>";  
    
       
// }
// }
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
	$username = $_SESSION["name"];
	$defaultSQL = "SELECT * FROM question WHERE name = '$username'";
	$result2 = $conn->query($defaultSQL);
echo "<div class='myquestion'>";
echo "<h2>MY Question</h2><br><br>";
echo "<form action='askquestion.php' method='POST'>";
echo "<input type ='submit' name='ask' value = 'AskQuestion'>";
echo "</form>";
	if ($result2->num_rows > 0) {
		while($row2 = $result2->fetch_assoc()) {
			$name = $row2["name"];
			$category = $row2["category"];
			$title = $row2["title"];
			$content = $row2["content"];
			$questID =$row2["questID"];
			
			echo "<form action='user_detail.php' method='POST'>";
			echo "<a style='font-size:30px; font-style:italic; font-family:'ＭＳ明朝';'>Q</a>";
			echo "uestion　　　";
			echo "<input type='hidden' name='name' value='$name'>";
			echo "<a><input type='submit'  value='$name'
					style='border:none;background-color:transparent;
					color:#fcff4c;text-decoration:underline; font-size:20px;'></a>";
			echo "</form>";
			
			echo " <br>";
			echo "カテゴリー : $category <br>";
			echo "質問タイトル : $title<br>";
			echo "<form action='QandA.php' method='POST'>";
			echo "<input type='hidden' name='questID' value=$questID>";
			echo "<input type='submit' name='submit' value='詳しく見る'>";
			echo "</form>";
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