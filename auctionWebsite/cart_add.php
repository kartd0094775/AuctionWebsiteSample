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
		$result = $conn->query("SELECT memberNo FROM member WHERE memberID=\"".$_COOKIE['username']."\"");
		$row = $result->fetch_assoc();
		$sql = "INSERT INTO transact (memNo, productNo, number) VALUES (".$row['memberNo'].", ".$row['productNo']", ".$number.")";
		
		$conn->query($sql);
		$conn->close();
	}
	//echo $sql;
	header("Location: product.php");
?>