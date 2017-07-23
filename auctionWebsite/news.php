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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>News</title>
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
		<table class="ui table">
			<thead>
				<th>消息名稱</th>
				<th>日期</th>
			</thead>
			<tbody>
			<?php 
				require("../php_dbinfo.php");
				$database = "ch8";
				$conn = new mysqli($servername, $username, $password);
				if ($conn->connect_error) {
					die("Connected Fail: $conn->connect_error");
				}
				$conn->query("SET NAMES 'utf8'");
				$conn->select_db($database);
				$result = $conn->query("SELECT * FROM news");
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td><a href=\"news_view.php?no=".$row['newsNo']."\">".$row['newsSubject']."</a>";
					echo "</td>";
					echo "<td>".$row['newsDate']."</td>";
					echo "</tr>";
				}				
			 ?>
			</tbody>
		</table>
	</div>
	<?php 
		if (isset($_COOKIE['admin'])) {

		echo "<div class=\"ui left aligned segment\">";
		echo "<form action=\"news_add.php\" method=\"POST\" class=\"ui form\">";
		echo "<div class=\"field\">";
		echo "<label>新聞標題</label>";
		echo "<input type=\"text\" class=\"two wide field\" name=\"subject\">";
		echo "</div>";
		echo "<div class=\"field\">";
		echo "<label>新聞內容</label>";
		echo "<textarea name=\"content\"></textarea>";
		echo "</div>";
		echo "<div class=\"field\">";
		echo "<input type=\"submit\" name=\"submit\" class=\"ui primary button\" value=\"送出\">";
		echo "<a href=\"news.php\" class=\"ui red button\">取消</a>";
		echo "</div>";
		echo "</form>";
		echo "</div>";
		}
	 ?>
</body>
</html>