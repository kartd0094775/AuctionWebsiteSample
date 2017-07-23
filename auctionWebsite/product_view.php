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
	<title>News View</title>
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
	<div class="ui center aligned segment">
<?php 
	if($mode == 2) {
		echo "<a class=\"ui red button\" href=\"product_delete.php?no=".$_GET['no']."\">刪除商品</a>";
		echo "<a class=\"ui green button\" href=\"product_edit.php?no=".$_GET['no']."\">編輯商品</a>";
	} else if ($mode == 1) {
		echo "<form action=\"cart_add.php?no=".$row['productNo']."\" method=\"POST\" class=\"ui form\">";
	}
 ?>
		<table class="ui table">
			<thead>
				<tr>
					<th>商品：<?php echo "<h1>".$row['productName']."</h1>" ?></th>
				</tr>
			</thead>
			<tbody>
				<tr><td></td></tr>
				<tr>
					<td>圖片：<br><img <?php echo "src=\"getImage.php?no=".$row['productNo']."\"" ?> /></td>
				</tr>
				<tr>
					<td>內容：<br><?php echo $row['productContent'] ?></td>
				</tr>
				<tr>
					<td>價格：<br><?php echo $row['productPrice'] ?></td>
				</tr>
				<tr>
					<td>庫存：<br><?php echo $row['productStock'] ?></td>
				</tr>
				<?php 
					if ($mode == 1) {
						echo "<tr><td><div class=\"field\"><p>數量：</p><input type=\"text\" name=\"number\" class=\"one wide field\" value=\"0\" required>";

					}
				 ?>
			</tbody>
		</table>
		<?php 
			if ($mode == 1) {
				echo "<input type=\"submit\" name=\"submit\" value=\"加入購物車\" class=\"ui green button\">";
				echo "<input type=\"hidde\" name=\"productNo\" value=\"".$_GET['no']."\">";
			}
		 ?>
		<a href="product.php" class="ui button">回上一頁</a>
		<?php 
			if ($mode == 1) {
				echo "</form>";
			}
		 ?>
	</div>
</body>
</html>