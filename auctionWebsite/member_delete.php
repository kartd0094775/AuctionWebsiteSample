<?php 
	$delete = $_POST['delete'];
	if (isset($_COOKIE['admin']) && sizeof($delete) != 0) {
		require("../php_dbinfo.php");
		$database = "ch8";
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) {
			die("Connected Fail: $conn->connect_error");
		}
		$conn->query("SET NAMES 'utf8'");
		$conn->select_db($database);
		for ($i=0; $i<sizeof($delete);$i++) {
			$sql = "DELETE FROM member WHERE memberNo=".$delete[$i];
			$conn->query($sql);
		}
	}
	header("Location: member.php");
	$conn->close();
?>