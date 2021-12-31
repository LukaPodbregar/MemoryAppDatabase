<?php
$DEBUG = true;
include("tools.php"); 

require 'vendor/autoload.php';
use ReallySimpleJWT\Token;

$database = dbConnect();

header('Content-Type: application/json');	
header('Access-Control-Allow-Origin: *');	
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');		

switch($_SERVER["REQUEST_METHOD"]){
	case 'GET':
		if(!empty($_GET["token"])){
			fetchUserImages($_GET["token"]);	
		}
		break;

	}
mysqli_close($database);

// Functions
function fetchUserImages($token){
	global $database;
	$response=array();
	$token=mysqli_escape_string($database, $token);
	$secret = 'sec!ReT423*&';
	if(Token::validate($token, $secret)){
		// Validate token and retrieve payload (userID)
		$payload = Token::getPayload($token, $secret);
		$userID = $payload["user_id"];
		$request="SELECT path, imageName, gender FROM application.images WHERE userID=$userID ORDER BY RAND()";
		$requestUserID="SELECT username FROM application.users WHERE userID=$userID";
		$userIdNumber = mysqli_query($database, $requestUserID);
		if(mysqli_num_rows($userIdNumber)>0){
			$result=mysqli_query($database, $request);
			while ($row = mysqli_fetch_assoc($result)){
				$response[]=$row; 
			}
			http_response_code(201);
			echo json_encode($response);
		}
		else{
			http_response_code(404);		//Not found
		}
	}
	else{
		http_response_code(401);
	}
}

?>