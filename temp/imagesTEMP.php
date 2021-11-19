<?php
$DEBUG = true;
include("tools.php"); 

$database = dbConnect();

header('Content-Type: image/png');	
header('Access-Control-Allow-Origin: *');	
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');	

switch($_SERVER["REQUEST_METHOD"]){

	case 'POST':
		imageUpload();
		break;
}

mysqli_close($database);

// Functions
function imageUpload(){
	global $database, $DEBUG;
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($_POST['upload'])){
        $response=array();
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "images/".$filename;
        $request="INSERT INTO images (filename) VALUES ('$filename')";

        if(mysqli_query($database, $request)){
            http_response_code(201);
            $response=mysqli_query($db, "SELECT * FROM image");
            echo json_encode($response);
        }
    }
}
	
?>