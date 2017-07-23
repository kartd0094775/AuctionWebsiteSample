<?php 
	if (isset($_COOKIE['username'])) {
		setcookie("username", $_COOKIE['username'], date('U')+120);
	} else {
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
	$result = $conn->query("SELECT * FROM member WHERE memberID =\"".$_COOKIE['username']."\"");
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit</title>
</head>
<link rel="stylesheet" type="text/css" href="../semantic/semantic.min.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="../semantic/semantic.min.js"></script>
<body>
	<div class="ui center aligned segment">
		<form action="edit_exe.php" method="POST" class="ui form">
			<div class="field">
				<label>會員帳號</label>
				<h3 class="ui header"><?php echo $row['memberID'] ?></h3>
			</div>
			<div class="field">
				<label>舊密碼</label>
				<input type="password" class="two wide field" name="oldPW" required>
			</div>
			<div class="field">
				<label>新密碼</label>
				<input type="password" class="two wide field" name="newPW">
			</div>
			<div class="field">
				<label>會員姓名</label>
				<input type="text" class="one wide field" name="name" value=<?php echo "\"".$row['memberName']."\"" ?>>
			</div>
			<div class="field">
				<label>聯絡Email</label>
				<input type="text" class="three wide field" name="email" value=<?php echo "\"".$row['memberEmail']."\"" ?> >
			</div>
			<div class="field">
				<label>聯絡地址</label>
				<input type="text" class="three wide field" name="address" value=<?php echo "\"".$row['memberAddress']."\"" ?>>
			</div>
			<div class="field">
				<label>是否訂閱電子報</label>
				<?php 
					if ($row['memberEpaper'] == 1) {
						echo "<input type=\"radio\" name=\"ePaper\" value=\"1\" checked>是";
						echo "<input type=\"radio\" name=\"ePaper\" value=\"0\">否<br>";

					} else {
						echo "<input type=\"radio\" name=\"ePaper\" value=\"1\">是";
						echo "<input type=\"radio\" name=\"ePaper\" value=\"0\" checked>否<br>";
					}

				 ?>
			</div>
			<div class="field">
				<input type="submit" name="submit" value="送出" class="ui primary button">
				<a href="index.php" class="ui red button">取消</a>
			</div>
		</form>
	</div>
</body>
</html>
<?php 
	$conn->close();
?>