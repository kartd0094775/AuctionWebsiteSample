<?php 
	if(isset($_POST['submit'])) {
		require("../php_dbinfo.php");
		$database = "ch8";
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) {
			die("Connected Fail: $conn->connect_error");
		}
		$conn->query("SET NAMES 'utf8'");
		$conn->select_db($database);
		$conn->query("INSERT INTO news (newsSubject, newsContent, newsDate) VALUES (\"".$_POST['subject']."\", \"".$_POST['content']."\", NOW())");
		$conn->close();
	}
	header("Location: news.php");
?>