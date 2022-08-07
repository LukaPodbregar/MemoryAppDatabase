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
		<title>New user</title>
		<link rel="stylesheet" type="text/css" href="styleIndex.css" />
		<script src="applicationAPI/users.js"></script>
	</head>
	<body>
		<div class="center">
			<?php include "Menu.html"?>
		
			<form id="form" onsubmit="addUser(); return false;">
				<label for="username">Username:</label><br>
				<input type="text" name="username" required/> <br>
				
				<label for="password">Password:</label><br>
				<input type="password" name="password" required/> <br>
				
				<input type="submit" value="Submit" />
			</form>
			<div id="result"></div>
		</div>
	</body>
</html>