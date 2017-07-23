<?php 
	$mode = 0;
	if (isset($_COOKIE['username'])) {
		$mode = 1;
		setcookie("username", $_COOKIE['username'], date('U')+120);
	}
	if (isset($_COOKIE['admin'])) {
		$mode = 2;
		setcookie("admin", $_COOKIE['admin'], date('U')+300);
	}
	require("../php_dbinfo.php");
	$database = "ch8";
	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error) {
		die("Connected Fail: $conn->connect_error");
	}
	$conn->query("SET NAMES 'utf8'");
	$conn->select_db($database);
	$result = $conn->query("SELECT * FROM product WHERE productNo=".$_GET['no']);
	$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product Edit</title>
</head>
<link rel="stylesheet" type="text/css" href="../semantic/semantic.min.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="../semantic/semantic.min.js"></script>
<body>
<?php 
	if ($mode == 0) {
		echo "<div class=\"ui right aligned segment\">";
		echo "<a href=\"index.php\" class=\"ui button\">首頁</a>";
		echo "<a href=\"news.php\" class=\"ui button\">最新消息</a>";
		echo "<a href=\"product.php\" class=\"ui button\">商品列表</a>";
		echo "<a href=\"login.php\" class=\"ui button\">登入</a>";
		echo "<a href=\"register.php\" class=\"ui button\">註冊</a>";	
		echo "</div>";
	} else if ($mode == 1) {
		echo "<div class=\"ui right aligned segment\">";
		echo "<h2 class=\"ui left header\">您好: ".$_COOKIE['username']."</h2>";
		echo "<a href=\"index.php\" class=\"ui button\">首頁</a>";
		echo "<a href=\"news.php\" class=\"ui button\">最新消息</a>";
		echo "<a href=\"product.php\" class=\"ui button\">商品列表</a>";
		echo "<a href=\"cart.php\" class=\"ui button\">購物車</a>";
		echo "<a href=\"edit.php\" class=\"ui button\">會員資料</a>";
		echo "<a href=\"logout.php\" class=\"ui button\">登出</a>";
		echo "</div>";
	} else {
		echo "<div class=\"ui right aligned segment\">";
		echo "<h2 class=\"ui left header\">您好: 管理員</h2>";
		echo "<a href=\"index.php\" class=\"ui button\">首頁</a>";
		echo "<a href=\"news.php\" class=\"ui button\">最新消息</a>";
		echo "<a href=\"product.php\" class=\"ui button\">商品管理</a>";
		echo "<a href=\"member.php\" class=\"ui button\">會員管理</a>";
		echo "<a href=\"ePaper.php\" class=\"ui button\">電子報管理</a>";
		echo "<a href=\"logout.php\" class=\"ui button\">登出</a>";
	}
?>
	<br><br>
	<form action="product_edit_exe.php" method="POST" class="ui form" enctype="multipart/form-data">
		<div class="ui left aligned segment">
			<div class="field">
				<label>商品名稱</label>
				<input type="text" name="name" class="two wide field" <?php echo "value=\"".$row['productName']."\""; ?>>
			</div>
			<div class="field">
				<label>商品概述</label>
				<input type="text" name="abstract" class="four wide field" <?php echo "value=\"".$row['productAbstract']."\""; ?>>
			</div>
			<div class="field">
				<label>商品內容</label>
				<textarea name="content" ><?php echo $row['productContent']; ?></textarea>
			</div>
			<div class="field">
				<label>商品價格</label>
				<input type="text" name="price" class="one wide field" <?php echo "value=\"".$row['productPrice']."\""; ?>>
			</div>
			<div class="field">
				<label>商品存量</label>
				<input type="text" name="stock" class="one wide field" <?php echo "value=\"".$row['productStock']."\""; ?>>
			</div>
			<div class="field">
				<label>商品圖片</label>
				<input type="file" name="image" accept="image/*" class="two wide field">
			</div>
			<input type="submit" class="ui primary button" name="submit" value="送出">
			<a <?php echo "href=\"product_view.php?no=".$row['productNo']."\"" ?> class="ui red button">取消</a>
			<input type="hidden" name="no" <?php echo "value=".$row['productNo']; ?>>
		</div>
	</form>
</body>
</html>