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
		$sql = "INSERT INTO transaction (memberID, productNo, number) VALUES (\"" . $_COOKIE['username'] . "\", " . $_POST['productNo'] . ", " . $_POST['number'] .")";
		$conn->query($sql);
		$conn->close();
	}
	echo $sql;
	header("Location: cart.php");
?>