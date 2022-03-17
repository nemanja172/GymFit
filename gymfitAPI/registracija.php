<?php
$DEBUG = true;							

include("orodja.php"); 					

$zbirka = dbConnect();					

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
	
	$result=mysqli_query($zbirka,$sql);
	
	$row=mysqli_fetch_array($result);
	
	if(mysqli_num_rows($result)>0)
	{
		if($_POST["email"] == $email && $_POST["geslo"] == $geslo){
			http_response_code(201);
		}
		else{
			//v nasprotnem primeru zavrnemo avtentikacijo
			http_response_code(401);
		}
	}
	else
	{
		http_response_code(401);  //ni uspelo 
	}
}

?>
