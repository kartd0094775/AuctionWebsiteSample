<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
</head>
<link rel="stylesheet" type="text/css" href="../semantic/semantic.min.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="../semantic/semantic.min.js"></script>
<body>
	<div class="ui center aligned segment">
		<form action="register_exe.php" method="POST" class="ui form">
			<div class="field">
				<label>會員帳號</label>
				<input type="text" class="two wide field" name="username" required>	
			</div>
			<div class="field">
				<label>會員密碼</label>
				<input type="password" class="two wide field" name="password" required>
			</div>
			<div class="field">
				<label>會員姓名</label>
				<input type="text" class="one wide field" name="name" required>
			</div>
			<div class="field">
				<label>聯絡Email</label>
				<input type="text" class="three wide field" name="email" required>
			</div>
			<div class="field">
				<label>聯絡地址</label>
				<input type="text" class="three wide field" name="address">
			</div>
			<div class="field">
				<label>是否訂閱電子報</label>
				<input type="radio" name="ePaper" value="1" checked>是
				<input type="radio" name="ePaper" value="0">否<br>
			</div>
			<div class="field">
				<input type="submit" name="submit" value="送出" class="ui primary button">
				<a href="index.php" class="ui red button">取消</a>
			</div>
		</form>
	</div>
</body>
</html>