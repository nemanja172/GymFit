<?php
$DEBUG = true;							// Priprava podrobnejših opisov napak (med testiranjem)

include("orodja.php"); 					// Vključitev 'orodij'

$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko

header('Content-Type: application/json');	// Nastavimo MIME tip vsebine odgovora

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: GET, POST, PUT, DELETE');

switch($_SERVER["REQUEST_METHOD"])		// Glede na HTTP metodo v zahtevi izberemo ustrezno dejanje nad virom
{
	case 'GET':
		if(!empty($_GET["ID_fitnesa"]))
		{
			pridobi_fitnes($_GET["ID_fitnesa"]);		// Če odjemalec posreduje ID_fitnesa, mu vrnemo podatke izbranega fitnesa
		}
		else
		{
			pridobi_vse_fitnese();					// Če odjemalec ne posreduje ID, mu vrnemo podatke vseh fitnesih
		}
		break;
		
	case 'POST':
		dodaj_fitnes();
		break;

	case 'PUT':
		if(!empty($_GET["ID_fitnesa"]))
		{
			posodobi_fitnes($_GET["ID_fitnesa"]);
		}
		else
		{
			http_response_code(400);    //bad request
		}
		break;

	case 'DELETE':
		if(!empty($_GET["ID_fitnesa"]))
		{
			izbrisi_fitnes($_GET["ID_fitnesa"]);
		}
		else
		{
			http_response_code(400);    //bad request
		}
		break;

		
	default:
		http_response_code(405);		//Če naredimo zahtevo s katero koli drugo metodo je to 'Method Not Allowed'
		break;
}

mysqli_close($zbirka);					// Sprostimo povezavo z zbirko


// ----------- konec skripte, sledijo funkcije -----------

function pridobi_vse_fitnese()
{
	global $zbirka;
	$odgovor=array();
	
	$poizvedba="SELECT ID_fitnesa, ime, lokacija, naslov, tip FROM fitnes";	
	
	$rezultat=mysqli_query($zbirka, $poizvedba);
	
	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;
	}
	
	http_response_code(200);		//OK
	echo json_encode($odgovor);
}

function pridobi_fitnes($ID_fitnesa)
{
	global $zbirka;
	$ID_fitnesa=mysqli_escape_string($zbirka, $ID_fitnesa);
	
	$poizvedba="SELECT ID_fitnesa, ime, lokacija, naslov, tip FROM fitnes WHERE ID_fitnesa='$ID_fitnesa'";
	
	$rezultat=mysqli_query($zbirka, $poizvedba);

	if(mysqli_num_rows($rezultat)>0)	//fitnes obstaja
	{
		$odgovor=mysqli_fetch_assoc($rezultat);
		
		http_response_code(200);		//OK
		echo json_encode($odgovor);
	}
	else							// fitnes ne obstaja
	{
		http_response_code(404);		//Not found
	}
}


// *********** Dopolnite še z ostalimi funkcijami


function dodaj_fitnes()
{
	global $zbirka, $DEBUG;
	$podatki = json_decode(file_get_contents('php://input'), true);
	
	//če so podatki ustrezni
	if(isset($podatki["ID_fitnesa"], $podatki["ime"], $podatki["lokacija"], $podatki["naslov"], $podatki["tip"]))
	{
		$ID_fitnesa=mysqli_escape_string($zbirka, $podatki["ID_fitnesa"]);
		$ime=mysqli_escape_string($zbirka, $podatki["ime"]);
		$lokacija=mysqli_escape_string($zbirka, $podatki["lokacija"]);
		$naslov=mysqli_escape_string($zbirka, $podatki["naslov"]);
		$tip=mysqli_escape_string($zbirka, $podatki["tip"]);

		//če fitnesa še ni
		if(!fitnes_obstaja($ID_fitnesa))	
		{
			$poizvedba= "INSERT INTO fitnes (ID_fitnesa, ime, lokacija, naslov, tip) VALUES ('$ID_fitnesa', '$ime', '$lokacija', '$naslov', '$tip')";
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(201);			//Created
				$odgovor=URL_vira($ID_fitnesa);
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
			pripravi_odgovor_napaka("Fitnes obstaja!");
		}
	}
	else
	{
		http_response_code(400);					//bad request
		pripravi_odgovor_napaka("Nekaj je narobe!");
	}
}


function posodobi_fitnes($ID_fitnesa)
{
	global $zbirka, $DEBUG;
	$ID_fitnesa=mysqli_escape_string($zbirka, $ID_fitnesa);
	$podatki = json_decode(file_get_contents('php://input'), true);
	
	//ce fitnes obstaja
	if(fitnes_obstaja($ID_fitnesa))
	{
		if(isset($podatki["ime"], $podatki["lokacija"], $podatki["naslov"], $podatki["tip"]))
		{
			$ime=mysqli_escape_string($zbirka, $podatki["ime"]);
			$lokacija=mysqli_escape_string($zbirka, $podatki["lokacija"]);
			$naslov=mysqli_escape_string($zbirka, $podatki["naslov"]);
			$tip=mysqli_escape_string($zbirka, $podatki["tip"]);
		
			$poizvedba = "UPDATE fitnes SET ime='$ime', lokacija='$lokacija', naslov='$naslov', tip='$tip' WHERE ID_fitnesa='$ID_fitnesa'";
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(204); 		//OK with no content
			}
			else
			{
				http_response_code(500);  		//Internal Server Error
				
				if($DEBUG)		//Pozor: vracanje podatkov o napaki na strezniku je varnostno tveganje
				{
					pripravi_odgovor_napaka(mysqli_error($zbirka));
				}
			}
		}
		else
		{
			http_response_code(400); 		//Bad request
		}			
	}
	else
	{
		http_response_code(404);
	}
}


function izbrisi_fitnes($ID_fitnesa)
{
	global $zbirka, $DEBUG;	
	$ID_fitnesa=mysqli_escape_string($zbirka, $ID_fitnesa);
	
	if(fitnes_obstaja($ID_fitnesa))
	{
		$poizvedba = "DELETE FROM fitnes WHERE ID_fitnesa='$ID_fitnesa'";
		
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