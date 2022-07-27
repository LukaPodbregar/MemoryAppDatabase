<?php
$DEBUG = true;
include("tools.php"); 

require 'vendor/autoload.php';
use ReallySimpleJWT\Token;

$database = dbConnect();

header('Content-Type: application/json');	// MIME type of response
header('Access-Control-Allow-Origin: *');   // Allow access from outside of current domain (CORS)	
header('Access-Control-Allow-Methods: PUT');	// Allowed methods		

switch($_SERVER["REQUEST_METHOD"]){
	case 'PUT':
		if(!empty($_GET['token'])){
			updateImage($_GET['token']);	
			
		}
		break;

	default:
		http_response_code(405);    // Method not allowed
		break;
	}

mysqli_close($database);

// Functions
function updateImage($token){ // Function checks if token is correct. If it is, updates the data of image
	global $database;
	$data = json_decode(file_get_contents('php://input'), true);
	$imageName = mysqli_escape_string($database, $data["imageName"]);
	$gender = mysqli_escape_string($database, $data["gender"]);
	$path = mysqli_escape_string($database, $data["path"]);
	$token = mysqli_escape_string($database, $token);
	$secret = 'sec!ReT423*&';
	if(Token::validate($token, $secret)){
		// Validate token and retrieve payload (userID)
		$payload = Token::getPayload($token, $secret);
		$userID = $payload["user_id"];
		$request = "UPDATE application.images SET imageName = '$imageName', gender = '$gender' WHERE path = '$path' AND userID = $userID";
		$requestUserID="SELECT username FROM application.users WHERE userID=$userID";
		$userIdNumber = mysqli_query($database, $requestUserID);
        if(mysqli_num_rows(mysqli_query($database, $requestUserID))>0){
            if(mysqli_query($database, $request)){
                http_response_code(201);    // OK
                $msg = "Image updated successfully!";
            }
            else{
                http_response_code(500);	//Server error
                $msg = "Server error!";
            }
        }
        else{
            http_response_code(404);	//Not found
            $msg = "User not found!";
        }
    echo $msg;
	}
}

?>