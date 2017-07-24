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
	if ($mode != 1) {
		header("Location: index.php");
	}
	require("../php_dbinfo.php");
	$database = "ch8";
	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error) {
		die("Connected Fail: $conn->connect_error");
	}
	$conn->query("SET NAMES 'utf8'");
	$conn->select_db($database);
	$result = $conn->query("SELECT * FROM transaction WHERE transactNo");
	$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cart</title>
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

<div class="ui grid">
	<br><br>
	<div class="sixteen wide column">
		<h2 class="ui header">購物車</h2>
	</div>
	<?php 
		$sql = "SELECT * FROM transaction WHERE memberID = \"" . $_COOKIE['username'] . "\"";
		$result = $conn->query($sql);
	
		while ($row = $result->fetch_assoc()) {
			$product_Rs = $conn->query("SELECT * FROM product WHERE productNo = \"" . $row['productNo'] . "\"");
			$product_Row = $product_Rs->fetch_assoc();
			if (isset($row)) {
				echo "<form action=\"cart_delete.php\" method=\"POST\">";
				echo "<div class=\"four wide column\">";
				echo "<h5 class=\" ui header\"><a href=\"product_view.php?no=".$product_Row['productNo']."\">".$product_Row['productName']."</a>　數量： " . trim($row['number'], '0') . "</h5>";
				echo "<img width=\"200\" heigh=\"100\" src=\"getImage.php?no=".$product_Row['productNo']."\">";
				echo "<h5 class=\" ui header\"><input class=\"ui red button\" type=\"submit\" name=\"submit\" value=\"移出購物車\"></h5>";
				echo "<input type=\"hidden\" name=\"no\" value=\"". $row['transactNo'] . "\">";
				echo "</div></form>";
			}
		}
	 ?>
</div>
	<div class="ui center aligned segment">
		<button class="ui green button">結帳</button>
	</div>
</body>
</html>