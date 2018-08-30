<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
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
			echo "<br><br><a href='retieve_activity.php'>Back to Main home</a>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			echo "<br><br>ページを戻ってください</a>";
		}	


?>

</body>
</html>