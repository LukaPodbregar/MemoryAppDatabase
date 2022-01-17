<?php
$DEBUG = true;
include("tools.php"); 

require 'vendor/autoload.php';
use ReallySimpleJWT\Token;

$database = dbConnect();

header('Content-Type: application/json');	
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');	

switch($_SERVER["REQUEST_METHOD"]){
	case 'POST':
		if(!empty($_GET['token']) & !empty($_POST['image']) & !empty($_POST['name']) & !empty($_POST['gender']) & !empty($_POST['extension'])){
			uploadImage($_GET['token'], $_POST['image'], $_POST['name'], $_POST['gender'], $_POST['extension']);	
		}
		break;

	default:
		http_response_code(405);
		break;
}

function uploadImage($token, $imageBase64, $name, $gender, $extension){
    global $database;
	$token=mysqli_escape_string($database, $token);
	$secret = 'sec!ReT423*&';
	if(Token::validate($token, $secret)){
        $payload = Token::getPayload($token, $secret);
		$userID = $payload["user_id"];
        $path = "userImages/".$userID."_".$name.".".$extension;
        $newImage = fopen($path, "w+");
        fwrite($newImage, base64_decode($imageBase64));
        fclose($newImage);        
        $request = "INSERT INTO images (userID, imageName, path, gender) VALUES ($userID, '$name', '$path', '$gender')";
        $requestUserID="SELECT username FROM application.users WHERE userID=$userID";
        if(mysqli_num_rows(mysqli_query($database, $requestUserID))>0){
            if(mysqli_query($database, $request)){
                http_response_code(201);
                $msg = "Image added successfully!";
                echo $msg;
            }
            else{
                http_response_code(500);
                $msg = "Server error!";
            }
        }
        else{
            http_response_code(404);
            $msg = "User not found!";
        }
    }

}
?>