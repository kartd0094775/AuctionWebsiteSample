<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<link rel="stylesheet" type="text/css" href="../semantic/semantic.min.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="../semantic/semantic.min.js"></script>
<body>
	<div class="ui center aligned segment">
		<form action="login_exe.php" method="POST" class="ui form">			
			<div class="field">
				<label>會員帳號</label>
				<input type="text" name="username" class="two wide field">
			</div>
			<div class="field">
				<label>會員密碼</label>
				<input type="password" name="password" class="two wide field">
			</div>
			<input type="submit" name="submit" value="確認" class="ui primary button">
			<a href="index.php" class="ui red button">取消</a>
		</form>
	</div>
</body>
</html>