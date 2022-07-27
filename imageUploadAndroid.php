<?php
$DEBUG = true;
include("tools.php"); 

require 'vendor/autoload.php';
use ReallySimpleJWT\Token;

$database = dbConnect();

header('Content-Type: application/json');	// MIME type of response
header('Access-Control-Allow-Origin: *');   // Allow access from outside of current domain (CORS)
header('Access-Control-Allow-Methods: GET, POST');	// Allowed methods	

switch($_SERVER["REQUEST_METHOD"]){
	case 'POST':
		if(!empty($_GET['token']) & !empty($_POST['image']) & !empty($_POST['name']) & !empty($_POST['gender']) & !empty($_POST['extension'])){
			uploadImage($_GET['token'], $_POST['image'], $_POST['name'], $_POST['gender'], $_POST['extension']);	
		}
		break;

	default:
		http_response_code(405);    // Method not allowed
		break;
}

mysqli_close($database);

// Functions
function uploadImage($token, $imageBase64, $name, $gender, $extension){ // Function checks if valid token is used, then recieves and decodes image in base64 format and saves it to server and database
    global $database;
    // Check if token is valid
	$token=mysqli_escape_string($database, $token);
	$secret = 'sec!ReT423*&';
	if(Token::validate($token, $secret)){
        $payload = Token::getPayload($token, $secret);
		$userID = $payload["user_id"];
        $timeStamp = time();
        // Decode and save image to userImages map with name composed of inputs: userID_timeStamp_name.extension
        $path = "userImages/".$userID."_".$timeStamp."_".$name.".".$extension;
        $newImage = fopen($path, "w+");
        fwrite($newImage, base64_decode($imageBase64));
        fclose($newImage);
        // Save userID of current user, image path, name and gender to database      
        $request = "INSERT INTO application.images (userID, imageName, path, gender) VALUES ($userID, '$name', '$path', '$gender')";
        $requestUserID="SELECT username FROM application.users WHERE userID=$userID";
        if(mysqli_num_rows(mysqli_query($database, $requestUserID))>0){
            if(mysqli_query($database, $request)){
                http_response_code(201);    // OK
                $msg = "Image added successfully!";
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