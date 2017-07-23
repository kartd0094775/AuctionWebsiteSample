<?php 
	if (isset($_COOKIE['admin']) && isset($_GET['no'])) {
		require("../php_dbinfo.php");
		$database = "ch8";
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) {
			die("Connected Fail: $conn->connect_error");
		}
		$conn->query("SET NAMES 'utf8'");
		$conn->select_db($database);
		$sql = "DELETE FROM product WHERE productNo=".$_GET['no'];
		$conn->query($sql);
	}
	header("Location: product.php");
	$conn->close();
?>