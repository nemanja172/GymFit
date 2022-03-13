<?php
$DEBUG = true;							

include("orodja.php"); 					

$zbirka = dbConnect();					

header('Content-Type: application/json');	

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: GET, POST, PUT, DELETE');

switch($_SERVER["REQUEST_METHOD"])		
{
	case 'GET':
		if(!empty($_GET["ID_uporabnika"]))
		{
			pridobi_uporabnika($_GET["ID_uporabnika"]);		// Če odjemalec posreduje ID_uporabnika, mu vrnemo podatke izbranega uporabnika
		}
		else
		{
			pridobi_vse_uporabnike();					
		}
		break;
		
	case 'POST':
		dodaj_uporabnika();
		break;

	case 'PUT':
		if(!empty($_GET["ID_uporabnika"]))
		{
			posodobi_uporabnika($_GET["ID_uporabnika"]);
		}
		else
		{
			http_response_code(400);    //bad request
		}
		break;

	case 'DELETE':
		if(!empty($_GET["ID_uporabnika"]))
		{
			izbrisi_uporabnika($_GET["ID_uporabnika"]);
		}
		else
		{
			http_response_code(400);    //bad request
		}
		break;

	case 'OPTIONS':
		http_response_code(204);
		break;
		
	default:
		http_response_code(405);	
		break;
}

mysqli_close($zbirka);					


function pridobi_vse_uporabnike()
{
	global $zbirka;
	$odgovor=array();
	
	$poizvedba="SELECT ID_uporabnika, ime, priimek, geslo, Datum_rojstva, Spol, Tel_stevilka, email, Paket, user_level FROM uporabnik";	
	
	$rezultat=mysqli_query($zbirka, $poizvedba);
	
	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;
	}
	
	http_response_code(200);		//OK
	echo json_encode($odgovor);
}

function pridobi_uporabnika($ID_uporabnika)
{
	global $zbirka;
	$ID_uporabnika=mysqli_escape_string($zbirka, $ID_uporabnika);
	
	$poizvedba="SELECT ID_uporabnika, ime, priimek, Datum_rojstva, Spol, Tel_stevilka, email, paket, user_level FROM uporabnik WHERE ID_uporabnika='$ID_uporabnika'";
	
	$rezultat=mysqli_query($zbirka, $poizvedba);

	if(mysqli_num_rows($rezultat)>0)	//uporabnik obstaja
	{
		$odgovor=mysqli_fetch_assoc($rezultat);
		
		http_response_code(200);		//OK
		echo json_encode($odgovor);
	}
	else							// uporabnik ne obstaja
	{
		http_response_code(404);		//Not found
	}
}


function dodaj_uporabnika()
{
	global $zbirka, $DEBUG;
	$podatki = json_decode(file_get_contents('php://input'), true);
	
	//če so podatki ustrezni
	if(isset($podatki["ID_uporabnika"], $podatki["ime"], $podatki["priimek"], $podatki["geslo"], $podatki["Datum_rojstva"], $podatki["Spol"], $podatki["Tel_stevilka"], $podatki["email"], $podatki["Paket"]))
	{
		$ID_uporabnika=mysqli_escape_string($zbirka, $podatki["ID_uporabnika"]);
		$ime=mysqli_escape_string($zbirka, $podatki["ime"]);
		$priimek=mysqli_escape_string($zbirka, $podatki["priimek"]);
		$geslo=mysqli_escape_string($zbirka, $podatki["geslo"]);
		$Datum_rojstva=mysqli_escape_string($zbirka, $podatki["Datum_rojstva"]);
		$Spol=mysqli_escape_string($zbirka, $podatki["Spol"]);
		$Tel_stevilka=mysqli_escape_string($zbirka, $podatki["Tel_stevilka"]);
		$email=mysqli_escape_string($zbirka, $podatki["email"]);
		$Paket=mysqli_escape_string($zbirka, $podatki["Paket"]);

		//če uporabnika še ni
		if(!uporabnik_obstaja($ID_uporabnika))	
		{
			$poizvedba= "INSERT INTO uporabnik (ID_uporabnika, ime, priimek, geslo, Datum_rojstva, Spol, Tel_stevilka, email, Paket) VALUES ('$ID_uporabnika', '$ime', '$priimek','$geslo', '$Datum_rojstva', '$Spol', '$Tel_stevilka', '$email', '$Paket')";
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(201);			//Created
				$odgovor=URL_vira($ID_uporabnika);
				echo json_encode($odgovor);
			}
			else
			{
				http_response_code(500);			//napaka streznika
				
				if($DEBUG)					//varnostno tveganje
				{
				pripravi_odgovor_napaka(mysqli_error($zbirka));
				}
			}
			//ga vpiši v bazo
	
		}
		else
		{
			http_response_code(409);							//konflikt
			pripravi_odgovor_napaka("Uporabnik obstaja!");
		}
	}
	else
	{
		http_response_code(400);					//bad request
		pripravi_odgovor_napaka("Nekaj je narobe!");
	}
}


function posodobi_uporabnika($ID_uporabnika)
{
	global $zbirka, $DEBUG;
	$ID_uporabnika=mysqli_escape_string($zbirka, $ID_uporabnika);
	$podatki = json_decode(file_get_contents('php://input'), true);
	
	//ce uporabnik obstaja
	if(uporabnik_obstaja($ID_uporabnika))
	{
		if(isset($podatki["ime"], $podatki["priimek"], $podatki["geslo"], $podatki["Datum_rojstva"], $podatki["Spol"], $podatki["Tel_stevilka"], $podatki["email"], $podatki["Paket"], $podatki["user_level"]))
		{
			$ime=mysqli_escape_string($zbirka, $podatki["ime"]);
			$priimek=mysqli_escape_string($zbirka, $podatki["priimek"]);
			$geslo=mysqli_escape_string($zbirka, $podatki["geslo"]);
			$Datum_rojstva=mysqli_escape_string($zbirka, $podatki["Datum_rojstva"]);
			$Spol=mysqli_escape_string($zbirka, $podatki["Spol"]);
			$Tel_stevilka=mysqli_escape_string($zbirka, $podatki["Tel_stevilka"]);
			$email=mysqli_escape_string($zbirka, $podatki["email"]);
			$Paket=mysqli_escape_string($zbirka, $podatki["Paket"]);
			$user_level=mysqli_escape_string($zbirka, $podatki["user_level"]);
		
			$poizvedba = "UPDATE uporabnik SET ime='$ime', priimek='$priimek', geslo='$geslo', Datum_rojstva='$Datum_rojstva', Spol='$Spol', email='$email', Paket='$Paket', user_level='$user_level' WHERE ID_uporabnika='$ID_uporabnika'";
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(204); 		
			}
			else
			{
				http_response_code(500);  		
				
				if($DEBUG)		
				{
					pripravi_odgovor_napaka(mysqli_error($zbirka));
				}
			}
		}
		else
		{
			http_response_code(400); 		
		}			
	}
	else
	{
		http_response_code(404);
	}
}


function izbrisi_uporabnika($ID_uporabnika)
{
	global $zbirka, $DEBUG;	
	$ID_uporabnika=mysqli_escape_string($zbirka, $ID_uporabnika);
	
	if(uporabnik_obstaja($ID_uporabnika))
	{
		$poizvedba = "DELETE FROM uporabnik WHERE ID_uporabnika='$ID_uporabnika'";
		
		if(mysqli_query($zbirka, $poizvedba))
		{
			http_response_code(204);
		}
		else
		{
			http_response_code(500);
			
			if($DEBUG)
			{
				pripravi_odgovor_napaka(mysqli_error($zbirka));
			}
		}
	}
	else
	{
		http_response_code(404);
	}
}

?>