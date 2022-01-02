<?php
$DEBUG = true;
include("tools.php"); 

require 'vendor/autoload.php';
use ReallySimpleJWT\Token;

$database = dbConnect();

header('Content-Type: application/json');	
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');	

switch($_SERVER["REQUEST_METHOD"]){
	case 'POST':
		if(!empty($_GET['token']) & !empty($_FILES['image']['name']) & !empty($_POST['name']) & !empty($_POST['gender'])){
			uploadImage($_GET['token'], $_FILES['image']['name'], $_POST['name'], $_POST['gender']);	
		}
		break;

	default:
		http_response_code(405);
		break;
}

function uploadImage($token, $imageFile, $name, $gender){
    global $database;
	$token=mysqli_escape_string($database, $token);
	$secret = 'sec!ReT423*&';
	if(Token::validate($token, $secret)){
        $payload = Token::getPayload($token, $secret);
		$userID = $payload["user_id"];
        echo $userID;
        $path = "userImages/".$userID."_".$imageFile;
        $tempname = $_FILES["image"]["tmp_name"];  
        $request = "INSERT INTO images (userID, imageName, path, gender) VALUES ($userID, '$name', '$path', '$gender')";
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

}
?>