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
		$result = $conn->query("SELECT * FROM member WHERE memberID=\"".$_POST['username']."\"");
		if ($row = $result->fetch_assoc()) {
			header("Location: register.php");
			exit();
		}
		$sql = "INSERT INTO member (memberID, memberPW, memberName, memberEmail, memberAddress, memberEpaper) VALUES (\"".$_POST['username']."\", \"".md5($_POST['password'])."\", \"".$_POST['name']."\", \"".$_POST['email']."\", \"".$_POST['address']."\", \"".$_POST['ePaper']."\")";
		$conn->query($sql);
		$conn->close();
		setcookie("username", $_POST['username'], date('U')+120);
	} 
	header("Location: index.php");
?>