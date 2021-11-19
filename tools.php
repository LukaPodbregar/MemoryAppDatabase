<?php

/**
 * Funkcija vzpostavi povezavo z zbirko podatkov na proceduralni način
 *
 * @return $conn objekt, ki predstavlja povezavo z izbrano podatkovno zbirko
 */
function dbConnect()
{
	$servername = "localhost";
	$username = "admin";
	$password = "appadmin";
	$dbname = "application";

	// Ustvarimo povezavo do podatkovne zbirke
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,"utf8");
	
	// Preverimo uspeh povezave
	if (mysqli_connect_errno())
	{
		printf("Povezovanje s podatkovnim strežnikom ni uspelo: %s\n", mysqli_connect_error());
		exit();
	} 	
	return $conn;
}

/**
 * Funkcija pripravi odgovor v obliki JSON v primeru napake
 *
 * @param $vsebina Znakovni niz, ki opisuje napako
 */
function readyError($vsebina)
{
	$answer=array(
		'status' => 0,
		'error_message'=>$vsebina
	);
	echo json_encode($answer);
}

/**
 * Funkcija preveri, če podan igralec obstaja v podatkovni zbirki
 *
 * @param $vzdevek Vzdevek igralca
 * @return true, če igralec obstaja, v nasprotnem primeru false
 */
function userExists($username)
{	
	global $database;
	$username=mysqli_escape_string($database, $username);
	
	$request="SELECT * FROM application.users WHERE username='$username'";
	if(mysqli_num_rows(mysqli_query($database, $request)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

function userIDExists($userID)
{	
	global $database;
	$usernameTemp=mysqli_escape_string($database, $userID);
	
	$request="SELECT * FROM application.users WHERE userID=$userID";
	if(mysqli_num_rows(mysqli_query($database, $request)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

/**
 * Funkcija pripravi URL podanega vira
 *
 * @param $vir Ime vira
 * @return $url URL podanega vira
 */
function sourceURL($vir)
{
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
	{
		$url = "https"; 
	}
	else
	{
		$url = "http"; 
	}
	$url .= "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $vir;
	
	return $url; 
}

?>