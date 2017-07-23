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
	if ($mode != 2) {
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
	$result = $conn->query("SELECT * FROM member WHERE memberNo=".$_GET['no']);
	$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Member Edit</title>
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
	<form action="member_edit_exe.php" method="POST" class="ui form">
		<div class="ui left aligned segment">
			<div class="field">
				<label>會員ID</label>
				<input type="text" name="id" class="two wide field" <?php echo "value=\"".$row['memberID']."\""; ?>>
			</div>
			<div class="field">
				<label>會員PW</label>
				<input type="password" name="pw" class="two wide field">
			</div>
			<div class="field">
				<label>會員姓名</label>
				<input type="text" name="name" class="two wide field" <?php echo "value=\"".$row['memberName']."\""; ?>>
			</div>
			<div class="field">
				<label>會員Email</label>
				<input type="text" name="email" class="four wide field" <?php echo "value=\"".$row['memberEmail']."\""; ?>>
			</div>
			<div class="field">
				<label>會員地址</label>
				<input type="text" name="address" class="four wide field" <?php echo "value=\"".$row['memberAddress']."\""; ?>>
			</div>
			<div class="field">
				<label>會員電子報</label>
				<?php 
					if ($row['memberEpaper'] == 1) {
						echo "<input type=\"radio\" name=\"epaper\" value=\"1\" checked>是　";
						echo "<input type=\"radio\" name=\"epaper\" value=\"0\" >否　";
					}
					else {
						echo "<input type=\"radio\" name=\"epaper\" value=\"1\" >是　";
						echo "<input type=\"radio\" name=\"epaper\" value=\"0\" checked>否　";
				 	}
				 ?>
			</div>
			<input type="submit" class="ui primary button" name="submit" value="修改">
			<a href="member.php" class="ui red button">返回</a>
			<input type="hidden" name="no" <?php echo "value=".$row['memberNo']; ?>>
		</div>
	</form>
</body>
</html>