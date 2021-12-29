<?php
$DEBUG = true;
include("tools.php"); 

$database = dbConnect();

header('Content-Type: application/json');	//Nastavimo MIME tip vsebine responsea
header('Access-Control-Allow-Origin: *');	//Dovolimo dostop izven trenutne domene (CORS)
header('Access-Control-Allow-Methods: GET');		//V preflight poizvedbi za CORS sta dovoljeni le metodi GET in POST

switch($_SERVER["REQUEST_METHOD"]){
	case 'GET':
		if(!empty($_GET['gender'])){
			fetchRandomNames($_GET['gender']);	
		}
		else{
			fetchAllNames();
		}
		break;

	default:
		http_response_code(405);
		break;
}

mysqli_close($database);

// Functions
function fetchRandomNames($gender){
	global $database;
    $response=array();
    $gender=mysqli_escape_string($database, $gender);
	$request="SELECT name FROM application.randomnames WHERE gender = '$gender' ORDER BY RAND() LIMIT 10";

	$result=mysqli_query($database, $request);
    while($vrstica=mysqli_fetch_assoc($result)){
		$response[]=$vrstica;
	}
    if(count($response) != 0){
        http_response_code(201);		//OK
        echo json_encode($response);
    }
    else{
        http_response_code(404);		//Not found
    }
}

function fetchAllNames(){
	global $database;
	$request="SELECT name, gender FROM application.randomnames";
	$result=mysqli_query($database, $request);

    while($vrstica=mysqli_fetch_assoc($result)){
		$response[]=$vrstica;
	}
    if(count($response) != 0){
        http_response_code(201);		//OK
        echo json_encode($response);
    }
    else{
        http_response_code(404);		//Not found
    }
}

?>