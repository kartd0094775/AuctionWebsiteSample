<?php 
	if (isset($_COOKIE['username'])) setcookie("username", '', date('U'));
	if (isset($_COOKIE['admin'])) setcookie("admin", '', date('U'));

	header("Location: index.php");
?>