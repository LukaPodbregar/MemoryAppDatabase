<?php
$DEBUG = true;
include("tools.php"); 

$database = dbConnect();

header('Content-Type: application/json');	
header('Access-Control-Allow-Origin: *');	
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');		

switch($_SERVER["REQUEST_METHOD"]){
	case 'GET':
		if(!empty($_GET["userID"])){
			fetchUserImages($_GET["userID"]);	
		}
		break;

	}
mysqli_close($database);

// Functions
function fetchUserImages($userID){
	global $database;
	$response=array();
	$userID=mysqli_escape_string($database, $userID);
	$request="SELECT path, imageName FROM application.images WHERE userID=$userID";
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

?>