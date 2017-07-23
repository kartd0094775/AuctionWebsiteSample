<?php 
	if (isset($_COOKIE['admin']) && isset($_POST['submit'])) {	
		require("../php_dbinfo.php");
		$database = "ch8";
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) {
			die("Connected Fail: $conn->connect_error");
		}
		$conn->query("SET NAMES 'utf8'");
		$conn->select_db($database);
		$conn->query("UPDATE news SET newsSubject=\"".$_POST['subject']."\", newsContent=\"".$_POST['content']."\" WHERE newsNo=\"".$_POST['no']."\"");
	}
	header("Location: news_view.php?no=".$_POST['no']);
?>