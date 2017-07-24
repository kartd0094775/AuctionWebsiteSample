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
		$result = $conn->query("SELECT memberEmail FROM member WHERE memberEpaper = 1");
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: 電子報發信系統 <epaper@example.com>' . "\r\n";
		while ($row = $result->fetch_assoc()) {
			mail($row['memberEmail'], $_POST['subject'], $_POST['content'], $headers);
		}
	}
	header("Location: index.php");
?>
