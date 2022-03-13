<?php
session_start();
$DEBUG = true;							// Priprava podrobnejših opisov napak (med testiranjem)

include("orodja.php"); 					// Vključitev 'orodij'

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
		
		$_SESSION['user_level'] = "$user_level"; //1-admin 0-user
		$_SESSION['start']=time();
		$_SESSION['expire']=$_SESSION['start']+(20*60);
		$_SESSION['auth_user'] = [
			'ID_uporabnika'=>$ID_uporabnika,
			'ime'=>$ime,
			'priimek'=>$priimek,
			'email'=>$email,
			'Datum_rojstva'=>$Datum_rojstva,
			'Tel_stevilka'=>$Tel_stevilka,
			'Spol'=>$Spol,
			'Paket'=>$Paket,
			'geslo'=>$geslo
		];	
		if($_POST["email"] == $email && $_POST["geslo"] == $geslo){
			$token = hash("md5",$email.$geslo);
			echo json_encode(array('token'=>$token,'level'=>$user_level,'ID_uporabnika'=>$ID_uporabnika));
		}
		else{
			//v nasprotnem primeru zavrnemo avtentikacijo
			http_response_code(401);
		}
	}
	else{
		http_response_code(401);
	}
}
?>