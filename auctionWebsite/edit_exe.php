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
		$result = $conn->query("SELECT memberPW FROM member WHERE memberID=\"".$_COOKIE['username']."\"");
		$row = $result->fetch_assoc();
		if (md5($_POST['oldPW']) == $row['memberPW']) {
			if($_POST['newPW'] != '') {
				$conn->query("UPDATE member SET memberPW=\"".md5($_POST['newPW'])."\", memberEpaper =".$_POST['ePaper']." WHERE memberID=\"".$_COOKIE['username']."\"");
			}
			if($_POST['name'] != '') {
				$conn->query("UPDATE member SET memberName=\"".$_POST['name']."\", memberEpaper =".$_POST['ePaper']." WHERE memberID=\"".$_COOKIE['username']."\"");
			}
			if($_POST['address'] != '') {
				$conn->query("UPDATE member SET memberAddress=\"".$_POST['address']."\", memberEpaper =".$_POST['ePaper']." WHERE memberID=\"".$_COOKIE['username']."\"");
			}
			if($_POST['email'] != '') {
				$conn->query("UPDATE member SET memberEmail=\"".$_POST['email']."\", memberEpaper =".$_POST['ePaper']." WHERE memberID=\"".$_COOKIE['username']."\"");
			}

		} else {
			header("Location: edit.php");
			exit();
		}
		$conn->close();
	} 
	header("Location: index.php");
?>