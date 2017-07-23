<?php 
	$mode = 0;
	if (isset($_COOKIE['admin'])) {
		$mode = 2;
		setcookie("admin", $_COOKIE['admin'], date('U')+300);
	} else {
		header("Location: index.php");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Member</title>
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
<form action="member_delete.php" method="POST">
	<div class="ui center aligned segment">
		<input type="submit" name="submit" value="刪除" class="ui red button">
		<table class="ui table">
			<thead>
				<th>會員ID</th>
				<th>會員名字</th>
				<th>會員Email</th>
				<th>會員地址</th>
				<th>會員電子報</th>
				<th>刪除</th>
				<th>編輯</th>
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
				$result = $conn->query("SELECT * FROM member");
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>".$row['memberID']."</td>";
					echo "<td>".$row['memberName']."</td>";
					echo "<td>".$row['memberEmail']."</td>";
					echo "<td>".$row['memberAddress']."</td>";
					if ($row['memberEpaper'] == 1) {
						echo "<td>是</td>";
					} else
						echo "<td>否</td>";
					echo "<td><input type=\"checkbox\" name=\"delete[]\" value=".$row['memberNo']."></td>";
					echo "<td><a href=\"member_edit.php?no=".$row['memberNo']."\">Link</a></td>";
				}	
			 ?>
			</tbody>
		</table>
	</div>
</form>
</body>
</html>