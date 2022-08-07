<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"]!=True){
	header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Images</title>
        <link rel="stylesheet" type= "text/css" href ="styleUpload.css"/>
        <script src="applicationAPI/images.js"></script>
	</head>

	<body>
        <div class="center">
            <?php include "Menu.html"?>
            <h4 id="title">Fetch user token (ignore ""):</h4>
            <form id="form" onsubmit="fetchUserTokenAdmin(); return false;">
				<label for="userID">UserID:</label>
				<input type="text" id="userID" name="userID" required /><br>
				<input type="submit" value="Fetch" />
            </form>
            <div id="resultToken"></div>

            <h4 id="title">Fetch user Images:</h4>
            <form id="form" onsubmit="userImages(); return false;">
				<label for="token">Token:</label>
				<input type="text" id="token" name="token" required /><br>
				<input type="submit" value="Search" />
            </form>
            <div id="result"></div>
        </div>
    </body>
</html>