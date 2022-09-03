<?php
$DEBUG = true;
include("tools.php"); 

$database = dbConnect();

header('Content-Type: application/json');	// MIME type of response
header('Access-Control-Allow-Origin: *');	// Allow access from outside of current domain (CORS)
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');		// Allowed methods

switch($_SERVER["REQUEST_METHOD"]){
	case 'GET':
		if(!empty($_GET['userID'])){
			fetchUser($_GET['userID']);	
		}
		else{
			fetchAllUsers();
		}
		break;

	case 'POST':
		addUser();
		break;
		
	case 'PUT':
		if(!empty($_GET['userID'])){
			updateUser($_GET['userID']);
		}
		else{
			http_response_code(400);
		}
		break;
		
	case 'DELETE':
		if(!empty($_GET['userID'])){
			deleteUser($_GET['userID']);
		}
		else{
			http_response_code(400);
		}
		break;
		
	case 'OPTIONS':	
		http_response_code(204);
		break;
		
	default:
		http_response_code(405);
		break;
}

mysqli_close($database);

// Functions
function fetchAllUsers(){ // Function fetches all usernames
	global $database;
	$response=array();
	$request="SELECT username FROM application.users";	
	$result=mysqli_query($database, $request);
	$response[0]=""; // Users are numbered from 1 forward, while list is numbered from 0 forward... This line makes sure the 0 element of the table is ignored
	while($row=mysqli_fetch_assoc($result)){
		$response[]=$row;
	}
	http_response_code(200);	//OK
	echo json_encode($response);
}

function fetchUser($userID){ // Function fetches username and hashed password from user with certain userID
	global $database;
	$userID=mysqli_escape_string($database, $userID);
	$request="SELECT username, password FROM application.users WHERE userID=$userID";
	$result=mysqli_query($database, $request);

	if(mysqli_num_rows($result)>0){
		$response=mysqli_fetch_assoc($result);
		http_response_code(200);	//OK
		echo json_encode($response);
	}
	else{
		http_response_code(404);	//Not found
	}
}

function addUser(){ // Function adds new user to database
	global $database, $DEBUG;
	$data = json_decode(file_get_contents('php://input'), true);
	
	if(isset($data["username"], $data["password"])){
		$username = mysqli_escape_string($database, $data["username"]);
		$password = password_hash(mysqli_escape_string($database, $data["password"]), PASSWORD_DEFAULT);

		if(!userExists($username)){	
			$request="INSERT INTO users (username, password) VALUES ('$username', '$password')";
			
			if(mysqli_query($database, $request)){
				http_response_code(201);	//OK
				$response=sourceURL($username);
				echo json_encode($response);
			}
			else{
				http_response_code(500);	//Server error
				
				if($DEBUG){
					readyError(mysqli_error($database));
				}
			}
		}
		else{
			http_response_code(409);	// Conflict
			readyError("User already exists!");
		}
	}
	else{
		http_response_code(400);	// Bad Request
	}
}

function updateUser($userID) // Function updates data of already existing user with userID
{
	global $database, $DEBUG;
	$userID = mysqli_escape_string($database, $userID);
	$data = json_decode(file_get_contents("php://input"),true);

	if(userIDExists($userID)){
		if(isset($data["password"], $data["username"])){
			$username = mysqli_escape_string($database, $data["username"]);
			$password = password_hash(mysqli_escape_string($database, $data["password"]), PASSWORD_DEFAULT);
			$request = "UPDATE application.users SET password='$password', username='$username' WHERE userID=$userID";
			
			if(mysqli_query($database, $request)){
				http_response_code(204);	//OK with no content
			}
			else{
				http_response_code(500);	// Internal Server Error
				
				if($DEBUG){
					readyError(mysqli_error($database));
				}
			}
		}
		else{
			http_response_code(400);	// Bad Request
		}
	}
	else{
		http_response_code(404);	//Not found
	}
}	
	
function deleteUser($userID){	 // Function deletes existing user with certain userID
	global $database, $DEBUG;
	$userID=mysqli_escape_string($database, $userID);

	if(userIDExists($userID)){
		$request="DELETE FROM application.users WHERE userID=$userID";
		
		if(mysqli_query($database, $request)){
			http_response_code(204);	//OK with no content
		}
		else{
			http_response_code(500);	// Internal Server Error
			
			if($DEBUG){
				readyError(mysqli_error($database));
			}
		}
	}
	else{
		http_response_code(404);	//Not found
	}
}
?>