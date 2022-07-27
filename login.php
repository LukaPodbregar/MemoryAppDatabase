<?php
$DEBUG = true;
include("tools.php"); 

require 'vendor/autoload.php';
use ReallySimpleJWT\Token;

$database = dbConnect();

header('Content-Type: application/json');	// MIME type of response
header('Access-Control-Allow-Origin: *');	// Allow access from outside of current domain (CORS)
header('Access-Control-Allow-Methods: GET');	// Allowed methods

switch($_SERVER["REQUEST_METHOD"]){
	case 'GET':
		if(!empty($_GET['username']) & !empty($_GET['password'])){
			loginUser($_GET['username'], $_GET['password']);	
		}
		else{
			fetchAllUsers();
		}
		break;

	default:
		http_response_code(405);
		break;
}

mysqli_close($database);

// Functions
function fetchAllUsers(){ // Function fetches all users and userIDs of users in database
	global $database;
	$response=array();
	$request="SELECT username, userID FROM application.users";	
	$result=mysqli_query($database, $request);
	
	while($row=mysqli_fetch_assoc($result)){
		$response[]=$row;
	}
	
	http_response_code(200);	// OK
	echo json_encode($response);
}

function loginUser($username, $password){ // Function compares users login information to the data saved in the database. If successful, the function creates jwt token that is used in further requests
	global $database;
	$username=mysqli_escape_string($database, $username);
	$passwordInput=mysqli_escape_string($database, $password);
	$requestPW="SELECT password FROM application.users WHERE username='$username'";
	$requestUserID="SELECT userID FROM application.users WHERE username='$username'";
	$resultPW=mysqli_query($database, $requestPW);
	$resultUserID=mysqli_query($database, $requestUserID);
	
	if(mysqli_num_rows($resultPW)>0){
		$userID = $resultUserID->fetch_array()[0];
		$hashedPassword = $resultPW->fetch_array()[0];
		// Verify if password is correct
		if(password_verify($passwordInput, $hashedPassword)){
			// Create jwt token	
			$secret = 'sec!ReT423*&';
			$expiration = time() + 3600;
			$issuer = 'localhost';
			$token = Token::create($userID, $secret, $expiration, $issuer);
			$response = 'Login succesful!';
			$array = Array(
				"LoginStatus" => $response,
				"token" => $token);
			http_response_code(200);	// OK
			echo json_encode($array);
		}
		else{
			http_response_code(401);	// Unauthorized (wrong password)
		}
	}
	else{
		http_response_code(404);	// Not found
	}
}

?>