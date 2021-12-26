<!DOCTYPE html>
<html>
    <head>
        <title>Image Upload</title>
        <link rel="stylesheet" type= "text/css" href ="styleUpload.css"/>
        <script src="applicationAPI/images.js"></script>
	</head>

	<body>
        <div class="center">
            <?php include "Menu.html"?>

            <form id="form" onsubmit="userImages(); return false;">
				<label for="token">Token:</label>
				<input type="text" name="token" required /><br>
				<input type="submit" value="Search" />
            </form>
            <div id="result"></div>
        </div>
    </body>
</html>