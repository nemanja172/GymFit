<?php

function dbConnect(){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "gymfit";

	// Ustvarimo povezavo do podatkovne zbirke
	$zbirka = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($zbirka,"utf8");

	// Preverimo uspeh povezave
	if (mysqli_connect_error()) {
		printf("Povezovanje s podatkovnim stre�nikom ni uspelo: %s\n", mysqli_connect_error());
		exit();
	} 	
	return $zbirka;
}

?>