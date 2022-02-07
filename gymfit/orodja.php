<?php

/**
 * Funkcija vzpostavi povezavo z zbirko podatkov na proceduralni način
 *
 * @return $conn objekt, ki predstavlja povezavo z izbrano podatkovno zbirko
 */
function dbConnect()
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "gymfit";

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
function pripravi_odgovor_napaka($vsebina)
{
	$odgovor=array(
		'status' => 0,
		'error_message'=>$vsebina
	);
	echo json_encode($odgovor);
}

/**
 * Funkcija preveri, če podan uporabnik obstaja v podatkovni zbirki
 *
 * @param $ID_uporabnika ID_uporabnika uporabnika
 * @return true, če uporabnik obstaja, v nasprotnem primeru false
 */
function uporabnik_obstaja($ID_uporabnika)
{	
	global $zbirka;
	$ID_uporabnika=mysqli_escape_string($zbirka, $ID_uporabnika);
	
	$poizvedba="SELECT * FROM uporabnik WHERE ID_uporabnika='$ID_uporabnika'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

function fitnes_obstaja($ID_fitnesa)
{	
	global $zbirka;
	$ID_fitnesa=mysqli_escape_string($zbirka, $ID_fitnesa);
	
	$poizvedba="SELECT * FROM fitnes WHERE ID_fitnesa='$ID_fitnesa'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

function termin_obstaja($ID_termina)
{	
	global $zbirka;
	$ID_termina=mysqli_escape_string($zbirka, $ID_termina);
	
	$poizvedba="SELECT * FROM termin WHERE ID_termina='$ID_termina'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
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
function URL_vira($vir)
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