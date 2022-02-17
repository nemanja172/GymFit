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
	
	//$row=mysqli_fetch_array($result);
	
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
		}
		
		$_SESSION['test'] = 'JANKO';
		$_SESSION['auth'] = true;
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
			'Paket'=>$Paket
		];
		
		if($_SESSION["user_level"]=="1")
		{
			$_SESSION['message']='Dobrodošli v administratorski vmesnik. ';
			header("location: http://localhost/gymfit/domacaAdmin.php");
			exit(0);
		}
	
		elseif($_SESSION["user_level"]=="0")
		{
			$_SESSION['message']='Dobrodosli na uporabnisko stran';
			header("location:http://localhost/gymfit/domaca.php");
		}
	}
	else
	{
		http_response_code(401);
		$_SESSION['message']='Nekaj je bilo narobe';
		header("location:http://localhost/gymfit/napacno.php");
	}
}
else
{
	$_SESSION['message']='Nimate pravice za dostop do dokumenta';
	header("location:http://localhost/gymfit/index.php");
	exit(0);
}
?>