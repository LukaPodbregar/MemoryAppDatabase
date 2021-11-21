<?php
$DEBUG = true;
include("tools.php"); 

$database = dbConnect();

header('Content-Type: application/json');	
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');	

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
function fetchAllUsers(){
	global $database;
	$response=array();
	$request="SELECT username, userID FROM application.users";	
	$result=mysqli_query($database, $request);
	
	while($vrstica=mysqli_fetch_assoc($result)){
		$response[]=$vrstica;
	}
	
	http_response_code(200);
	echo json_encode($response);
}

function loginUser($username, $password){
	global $database;
	$username=mysqli_escape_string($database, $username);
	$passwordInput=mysqli_escape_string($database, $password);
	$request="SELECT password FROM application.users WHERE username='$username'";
	$result=mysqli_query($database, $request);
	$hashedPassword = $result->fetch_array()[0];

	if(mysqli_num_rows($result)>0){
		if(password_verify($passwordInput, $hashedPassword)){
			$response = 'Login succesful!';
			http_response_code(200);
			echo json_encode($response);
		}
		else{
			http_response_code(401); // Unauthorized
		}
	}
	else{
		http_response_code(404);
	}
}

?>