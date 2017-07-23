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
		$imgType = strchr($_FILES['image']['name'], ".");
		$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$sql = "INSERT INTO product (productName, productAbstract, productContent, productPrice, productStock, productPicType, productPicBlob) VALUES (\"".$_POST['name']."\", \"".$_POST['abstract']."\", \"".$_POST['content']."\", \"".$_POST['price']."\", \"".$_POST['stock']."\", \"".trim($imgType, '.')."\", \"$image\")";
		//$sql = "UPDATE product SET productPicBlob=\"".$image."\" WHERE productNo=1";
		$conn->query($sql);
		$conn->close();
	}
	//echo $sql;
	header("Location: product.php");
?>