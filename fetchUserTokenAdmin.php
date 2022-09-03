<?php
$DEBUG = true;
include("tools.php"); 

$database = dbConnect();

require 'vendor/autoload.php';
use ReallySimpleJWT\Token;

header('Content-Type: application/json');	// MIME type of response
header('Access-Control-Allow-Origin: *');	// Allow access from outside of current domain (CORS)
header('Access-Control-Allow-Methods: GET');		// Allowed methods

switch($_SERVER["REQUEST_METHOD"]){
	case 'GET':
		if(!empty($_GET['userID'])){
			fetchUserToken($_GET['userID']);	
		}
		break;

}

mysqli_close($database);

// Functions
function fetchUserToken($userID){ // Function fetches token for user with certain userID... ONLY USED BY ADMINISTRATOR
	global $database;
	$userID=mysqli_escape_string($database, $userID);
	$request="SELECT username FROM application.users WHERE userID=$userID";
	$result=mysqli_query($database, $request);

	session_start();
	if(!isset($_SESSION["login"]) || $_SESSION["login"]!=True){
		http_response_code(404);	//Not found
	}
	else{
		if(mysqli_num_rows($result)>0){
			$secret = 'sec!ReT423*&';
			$expiration = time() + 3600;
			$issuer = 'localhost';
			$token = Token::create($userID, $secret, $expiration, $issuer);
			http_response_code(200);	// OK
			echo json_encode($token);
		}
		else{
			http_response_code(404);	//Not found
		}
	}
}

?>