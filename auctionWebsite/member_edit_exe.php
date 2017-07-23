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
		$conn->query("UPDATE member SET memberName=\"".$_POST['name']."\", memberID=\"".$_POST['id']."\", memberPW=\"".md5($_POST['pw'])."\", memberEmail=\"".$_POST['email']."\", memberAddress=\"".$_POST['address']."\", memberEpaper=\"".$_POST['epaper']."\" WHERE memberNo=\"".$_POST['no']."\"");
	}
	header("Location: member.php");
?>