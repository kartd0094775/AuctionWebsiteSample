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
		$imgType = strchr($_FILES['image']['name'], ".");
		$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$conn->query("UPDATE product SET productName=\"".$_POST['name']."\", productAbstract=\"".$_POST['abstract']."\", productContent=\"".$_POST['content']."\", productPrice=\"".$_POST['price']."\", productStock=\"".$_POST['stock']."\", productPicType=\"".trim($imgType, '.')."\", productPicBlob=\"$image\" WHERE productNo=\"".$_POST['no']."\"");
	}
	header("Location: product_view.php?no=".$_POST['no']);
?>