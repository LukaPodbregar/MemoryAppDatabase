<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"]!=True){
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Aplikacija - Prva stran</title>
		<link rel="stylesheet" type="text/css" href="styleIndex.css" />
	</head>
	<body>
		<div class="center">
			<?php include"Menu.html"?>
		</div>
	</body>
</html>