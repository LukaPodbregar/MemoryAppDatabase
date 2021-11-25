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
    $sex = $_POST['sex'];
    $path = "userImages/".$userID."_".$filename;
    $request = "INSERT INTO images (userID, imageName, path, sex) VALUES ($userID, '$imageName', '$path', $sex)";
    $requestUserID="SELECT username FROM application.users WHERE userID=$userID";

    if(mysqli_num_rows(mysqli_query($database, $requestUserID))>0){
        if (move_uploaded_file($tempname, $path)) {
            if(mysqli_query($database, $request)){
                http_response_code(201);
                $msg = "Image added successfully!";
            }
            else{
                http_response_code(500);
                $msg = "Server error!";
            }
        }
    }
    else{
        http_response_code(404);
        $msg = "User not found!";
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
                <label for="sex">Gender of the person (0 for male, 1 for female):</label><br>
                <input type="number" name="sex" min="0" max="1" step="1" required/> <br>
                <input type="file" name="uploadfile" value=""/><br>
                <button type="submit" name="upload">UPLOAD</button>
            </form>
            <?php echo $msg?>
        </div>
    </body>
</html>