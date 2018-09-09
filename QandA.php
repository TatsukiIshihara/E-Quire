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
	<link rel="stylesheet" type="text/css" href="QandA.css">
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
<input type="button" value="Edit" onClick="location.href='user_edit.php'">
</div>

<div class='result'>
<?php
include 'dbconnect4.php';
	$questID = $_POST["questID"]; 	
	// var_dump($questID);
	 $SQL = "SELECT * FROM question WHERE questID='$questID'";
	$result = $conn->query($SQL);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$name = $row["name"];
			$category = $row["category"];
			$title = $row["title"];
			$content = $row["content"];

			echo "<form action='user_detail.php' method='POST'>";
			echo "<a style='font-size:30px; font-style:italic; font-family:'ＭＳ明朝';'>Q</a>";
			echo "uestion　　　";
			echo "<input type='hidden' name='name' value='$name'>";
			echo "<a><input type='submit'  value='$name'
					style='border:none;background-color:transparent;
					color:#fcff4c;text-decoration:underline; font-size:20px;'></a>";
			echo "</form>";
			
			echo "カテゴリー : $category"."<br>";
			echo "質問タイトル : $title"."<br>";
			echo "質問詳細　<br>";
			echo "$content"."<br>";

			if ($_SESSION["email_A"]!="") {
				echo "<form action='QandA.php' method='POST'>";
				echo "<input type='hidden' name='questID' value='$questID'>";
				echo "　　　　　　　　　　　     　　　　　　　";
				echo "<input type='submit' name='deleteQ' value='Delete' onclick='return confirm('Are you sure?') >";
				echo "</form>";
				if(isset($_POST["deleteQ"])){
					$sql_delete = "DELETE FROM question WHERE questID='$questID'";
					if ($conn->query($sql_delete) === TRUE) {
						
						header("Location:admin_userlist.php");
						
					} else {
						echo "Error during deleting record.: " . $conn->error;
						echo "<br>";
					}
				}
			}

		}
	} else {
		echo "No match found";
	}
echo "<br><br>";	
 $sql_answer = "SELECT * FROM answer WHERE questionID = '$questID'";
	$result = $conn->query($sql_answer);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$username= $row["username"];
			$content= $row["content"];
			$answerID = $row["answerID"];

			echo "<form action='user_detail.php' method='POST'>";
			echo "<a style='font-size:30px; font-style:italic; font-family:'ＭＳ明朝';'>A</a>";
			echo "nswer　　　";
			echo "<input type='hidden' name='name' value='$username'>";
			echo "<a><input type='submit'  value='$username'
					style='border:none;background-color:transparent;
					color:#fcff4c;text-decoration:underline; font-size:20px;'></a>";
			echo "</form>";
			echo "<br>";
			echo "$content"."<br><br><br><br>";

			if ($_SESSION["email_A"]!="") {
				echo "<form action='QandA.php' method='POST'>";
				echo "<input type='hidden' name='questID' value='$questID'>";
				echo "<input type='hidden' name='AdeleteID' value='$answerID'>";
				echo "　　　　　　　　　　　     　　　　　　　";
				echo "<input type='submit' name='deleteA' value='Delete' onclick='return confirm('Are you sure?') >";
				echo "</form>";
				if(isset($_POST["deleteA"])){
					$AdeleteID = $_POST["AdeleteID"];
					$sql_delete = "DELETE FROM answer WHERE answerID='$AdeleteID'";
					if ($conn->query($sql_delete) === TRUE) {
						header("Location:admin_userlist.php");
						echo "Record is deleted successfully!!";
						echo "<br>";
					} else {
						echo "Error during deleting record.: " . $conn->error;
						echo "<br>";
					}
				}
			}

			}
	} else {
		echo "There is no answer.";
	}
	echo "<br><br>";
?>
<?php
if ($_SESSION["email_A"]==""){ ?>
<h3>Make new answer</h3>
<form action="QandA.php"  method="POST">
 	<p>User Name: <?php echo $_SESSION["name"]; ?></p>
 	
	<p>回答内容</p>
		<textarea name="answer" required style="height:200px; width:450px; max-width:450px; "></textarea>
		<br>
	
    <input type="hidden" name="questID" value="<?php echo $questID ?>">
    <input type="submit" name="submit_A"　value=" Submit ">
</form>

<?php

if(isset($_POST["submit_A"])){	
$answer = $_POST["answer"];
$name_answer = $_SESSION['name'];

$sql_insert = "INSERT INTO answer (questionID, username, content)
		VALUES('$questID', '$name_answer','$answer')";

		if ($conn->query($sql_insert) === TRUE) {
			echo "New record is created successfully!!";
			echo "<br><br><a href='homepage.php'>Back to home</a>";
		} else {
			echo "Error: " . $sql_insert . "<br>" . $conn->error;
			echo "<br><br><a href='homepage.php'>Back to home</a>";
				}
				
	} else {
		 echo "";
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