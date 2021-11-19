<?php
$DEBUG = true;
include("tools.php"); 

$database = dbConnect();

$msg = "";

if (isset($_POST['upload'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $userID = $_POST['userID'];
    $imageName = $_POST['imageName'];
    $path = "userImages/".$userID."_".$filename;
    $request = "INSERT INTO images (userID, imageName, path) VALUES ($userID, '$imageName', '$path')";
    $requestUserID="SELECT username FROM application.users WHERE userID=$userID";

    if(mysqli_num_rows(mysqli_query($database, $requestUserID))>0){
        if (move_uploaded_file($tempname, $path)) {
            if(mysqli_query($database, $request)){
                http_response_code(201);
            }
            else{
                http_response_code(500);
            }
        }
    }
    else{
        http_response_code(404);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Image Upload</title>
        <link rel="stylesheet" type= "text/css" href ="styleUpload.css"/>
	</head>

	<body>
        <div class="center">
            <?php include "Menu.html"?>

            <form action="" method="post" enctype="multipart/form-data">
                <label for="userID">UserID:</label><br>
                <input type="text" name="userID" required/> <br>
                <label for="imageName">Name of the person:</label><br>
                <input type="text" name="imageName" required/> <br>
                <input type="file" name="uploadfile" value=""/><br>
                <button type="submit" name="upload">UPLOAD</button>
            </form>
            <div id="response"></div>
        </div>
    </body>
</html>