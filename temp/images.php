<?php
$DEBUG = true;
include("tools.php"); 

$database = dbConnect();

header('Content-Type: text/html');	
header('Access-Control-Allow-Origin: *');	
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');	

switch($_SERVER["REQUEST_METHOD"]){ 
    case 'POST':
        if(isset($_POST['SubmitButton'])){
            imageUpload();
            break;
        }
}

mysqli_close($database);

// Functions
function imageUpload(){
	global $database, $DEBUG;
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $userID = $_POST['userID'];
    $imageName = $_POST['imageName'];
    $path = "images/".$userID."_".$filename;
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