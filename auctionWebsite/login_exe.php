<?php 
	if (isset($_POST['submit'])) {
		require("../php_dbinfo.php");
		require("password.php");
		if ($_POST['username'] == $adminID && !strcmp($_POST['password'], $adminPW)) {
			setcookie("admin", 0, date('U')+300);
			header("Location: index.php");
			exit();
		}
		$database = "ch8";
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) {
			die("Connected Fail: $conn->connect_error");
		}
		$conn->query("SET NAMES 'utf8'");
		$conn->select_db($database);
		$result = $conn->query("SELECT * FROM member WHERE memberID = \"".$_POST['username']."\"");
		if ($row = $result->fetch_assoc()) {
			if (md5($_POST['password']) == $row['memberPW']) {
				setcookie("username", $row['memberID'], date('U')+120);
				header("Location: index.php");
				exit();
			}  
		}
	} 
	header("Location: login.php");


?>