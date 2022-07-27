<?php
$DEBUG = true;
include("tools.php"); 

require 'vendor/autoload.php';
use ReallySimpleJWT\Token;

$database = dbConnect();

header('Content-Type: application/json');	// MIME type of response		
header('Access-Control-Allow-Origin: *');   // Allow access from outside of current domain (CORS)	
header('Access-Control-Allow-Methods: DELETE');	// Allowed methods		

switch($_SERVER["REQUEST_METHOD"]){

	case 'DELETE':
		if(!empty($_GET['token']) & !empty($_GET['path'])){
			deleteImage($_GET['token'], $_GET['path']);	
		}
		break;

	default:
		http_response_code(405);
		break;
	}
mysqli_close($database);

// Functions
function deleteImage($token, $path){ // Function checks if token is correct. If it is, it deletes image and its data from database and server
	global $database; 
	global $database;
	$token = mysqli_escape_string($database, $token);
	$secret = 'sec!ReT423*&';
	if(Token::validate($token, $secret)){
		// Validate token and retrieve payload (userID)
		$payload = Token::getPayload($token, $secret);
		$userID = $payload["user_id"];
		$request = "DELETE FROM application.images WHERE path = '$path' AND userID = $userID";
		$requestUserID="SELECT username FROM application.users WHERE userID=$userID";
		$requestImageExists = "SELECT imageName FROM application.images WHERE path = '$path' AND userID = $userID";
		$userIdNumber = mysqli_query($database, $requestUserID);
        if(mysqli_num_rows(mysqli_query($database, $requestUserID))>0){
			if(mysqli_num_rows(mysqli_query($database, $requestImageExists))>0){
				if(mysqli_query($database, $request)){
					http_response_code(201);
					$msg = "Image deleted successfully!";
					// Delete file on server
					unlink($path);
				}
				else{
					http_response_code(500);	//Server error
					$msg = "Server error!";
				}
			}
			else{
				http_response_code(404);	//Not found
				$msg = "Image doesn't exist!";
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