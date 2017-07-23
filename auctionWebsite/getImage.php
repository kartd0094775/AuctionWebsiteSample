<?php 
	require("../php_dbinfo.php");
	$database = "ch8";
	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error) {
		die("Connected Fail: $conn->connect_error");
	}
	$conn->query("SET NAMES 'utf8'");
	$conn->select_db($database);
	$result = $conn->query("SELECT productPicType, productPicBlob FROM product WHERE productNo=\"".$_GET['no']."\"");
	$row = $result->fetch_assoc();
	$conn->close();
	header("Content-type: image/".$row['productPicType']);
	echo $row['productPicBlob'];
?>