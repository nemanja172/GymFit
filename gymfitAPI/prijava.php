<?php
$DEBUG = true;							// Priprava podrobnejših opisov napak (med testiranjem)

include("orodja.php"); 					// Vključitev 'orodij'

header('Access-Control-Allow-Origin: *');
header('Content-type', 'application/x-www-form-urlencoded');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
//header('Access-Control-Allow-Headers: Accept, Content-type, Authorization');

$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email=$_POST["email"];
	$geslo=$_POST["geslo"];

	$query="select * from uporabnik where email='".$email."' AND geslo='".$geslo."' ";
	
	$result=mysqli_query($zbirka,$query);
	$row=mysqli_fetch_array($result);
	
	if(mysqli_num_rows($result)>0)
	{
		foreach($result as $data){
			$ID_uporabnika = $data['ID_uporabnika'];
			$ime = $data['Ime'];
			$priimek = $data['Priimek'];
			$email = $data['Email'];
			$Datum_rojstva = $data['Datum_rojstva'];
			$Tel_stevilka = $data['Tel_stevilka'];
			$Spol = $data['Spol'];
			$user_level = $data['user_level'];
			$Paket = $data['Paket'];
			$geslo = $data['Geslo'];
		}
		
		$token = hash("md5",$email.$geslo);

		$poizvedba="UPDATE uporabnik SET token='$token' WHERE Email = '$email'";	
		$rezultat=mysqli_query($zbirka, $poizvedba);
		echo json_encode(array('token'=>$token, 'ID_uporabnika'=>$ID_uporabnika));
	}
	else{
		//v nasprotnem primeru zavrnemo avtentikacijo
		http_response_code(401);
	}
}
else{
	http_response_code(500);
}
?>