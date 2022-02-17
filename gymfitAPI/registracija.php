<?php
$DEBUG = true;							// Priprava podrobnejših opisov napak (med testiranjem)

include("orodja.php"); 					// Vključitev 'orodij'

$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$ime= $_POST["ime"];
	$priimek=$_POST["priimek"];
	$geslo=$_POST["geslo"];
	$Datum_rojstva=$_POST["Datum_rojstva"];
	$Spol=$_POST["Spol"];
	$Tel_stevilka=$_POST["Tel_stevilka"];
	$email=$_POST["email"];
	$Paket=$_POST["Paket"];
	
	$sql="insert into uporabnik(ime, priimek, geslo, Datum_rojstva, Spol, Tel_stevilka,email, Paket)
			values('$ime','$priimek', '$geslo','$Datum_rojstva', '$Spol', '$Tel_stevilka','$email', '$Paket') ";
	
	if(mysqli_query($zbirka,$sql))
	{
		header("location: http://localhost/gymfit/uspesnaregistracija.php");
		//http_response_code(201);			//Created
	}
	else
	{
		//http_response_code(500);			//napaka streznika
		echo "Povezovanje s podatkovnim strežnikom ni uspelo:";
	}
}

?>
