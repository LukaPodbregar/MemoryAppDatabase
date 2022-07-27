<?php
$DEBUG = true;
include("tools.php"); 

$database = dbConnect();
$msg = "";

if (isset($_POST['upload'])) { // Upload image via browser interface
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $userID = $_POST['userID'];
    $imageName = $_POST['imageName'];
    $gender = $_POST['gender'];
    $timeStamp = time();
    $path = "userImages/".$userID."_".$timeStamp."_".$filename;
    $request = "INSERT INTO images (userID, imageName, path, gender) VALUES ($userID, '$imageName', '$path', '$gender')";
    $requestUserID="SELECT username FROM application.users WHERE userID=$userID";

    if(mysqli_num_rows(mysqli_query($database, $requestUserID))>0){
        if (move_uploaded_file($tempname, $path)) {
            if(mysqli_query($database, $request)){
                http_response_code(201); // OK
                $msg = "Image added successfully!";
            }
            else{
                http_response_code(500);	//Server error
                $msg = "Server error!";
            }
        }
    }
    else{
        http_response_code(404);	//Not found
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
                <label for="gender">Gender of the person (male/female):</label><br>
                <input type="text" name="gender" required/> <br>
                <input type="file" name="uploadfile" value=""/><br>
                <button type="submit" name="upload">UPLOAD</button>
            </form>
            <?php echo $msg?>
        </div>
    </body>
</html>