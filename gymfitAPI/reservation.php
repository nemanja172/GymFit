<?php
$DEBUG = true;							// Priprava podrobnejših opisov napak (med testiranjem)

include("orodja.php"); 					// Vključitev 'orodij'

$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$ID_uporabnika= $_POST["ID_uporabnika"];
	$ID_fitnesa=$_POST["ID_fitnesa"];
	$datum=$_POST["datum"];
	
	$sql="insert into termin(ID_uporabnika, ID_fitnesa, datum)
			values('$ID_uporabnika','$ID_fitnesa', '$datum') ";
	
	if(mysqli_query($zbirka,$sql))
	{
		header("location: http://localhost/gymfit/uspesnarezervacija.php");
		//http_response_code(201);			//Created
	}
	else
	{
		http_response_code(500);			//napaka streznika
		echo "Povezovanje s podatkovnim strežnikom ni uspelo:";
	}
}

?>