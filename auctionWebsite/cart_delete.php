<?php 
	if (isset($_COOKIE['username']) && isset($_POST['submit'])) {
		require("../php_dbinfo.php");
		$database = "ch8";
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) {
			die("Connected Fail: $conn->connect_error");
		}
		$conn->query("SET NAMES 'utf8'");
		$conn->select_db($database);
		$sql = "DELETE FROM transaction WHERE transactNo=".$_POST['no'];
		$conn->query($sql);
	}
	header("Location: cart.php");
	$conn->close();
?>