<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"]==True){
	header('location: home.php');
}
$error = "";
if(isset($_POST['username']) && isset($_POST['pwd'])){
	$username = $_POST['username'];
	$password = $_POST['pwd'];
	$_SESSION["login"] = true;
if($username == "admin" && $password == "admin"){
	header('location: home.php');
}
else {
	$error = "Invalid username or password!";
}
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Login to Face app Administration interface</title>
		<link rel="stylesheet" type="text/css" href="styleIndex.css" />
	</head>
	<body>
	<h2>Login to Face app Administration interface</h2><br>
		<form action="" method="post">
			<label for="username">Username:</label><br>
			<input type="text" name="username" required/> <br>

			<label for="password">Password:</label><br>
				<input type="password" name="pwd" required/> <br>

			<input type="submit" value="Login" />
		</form>
		<?php echo $error;?>
	</body>
</html>