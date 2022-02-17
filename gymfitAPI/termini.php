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
		if(!empty($_GET["ID_uporabnika"]))
		{
			pridobi_termine_uporabnika($_GET["ID_uporabnika"]);		// Če odjemalec posreduje ID_uporabnika, mu vrnemo podatke izbranega uporabnika
		}
		else
		{
			pridobi_vse_termine();					// Če odjemalec ne posreduje ID, mu vrnemo podatke vseh uporabnikih
		}
		break;
		
	case 'POST':
		dodaj_termin();
		break;

	case 'PUT':
		if(!empty($_GET["ID_termina"]))
		{
			posodobi_termin($_GET["ID_termina"]);
		}
		else
		{
			http_response_code(400);    //bad request
		}
		break;

	case 'DELETE':
		if(!empty($_GET["ID_termina"]))
		{
			izbrisi_termin($_GET["ID_termina"]);
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
		http_response_code(405);		//Če naredimo zahtevo s katero koli drugo metodo je to 'Method Not Allowed'
		break;
}

mysqli_close($zbirka);					// Sprostimo povezavo z zbirko


// ----------- konec skripte, sledijo funkcije -----------

function pridobi_vse_termine()
{
	global $zbirka;
	$odgovor=array();
	
	$poizvedba="SELECT ID_termina, ID_uporabnika, ID_fitnesa, datum FROM termin";	
	
	$rezultat=mysqli_query($zbirka, $poizvedba);
	
	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;
	}
	
	http_response_code(200);		//OK
	echo json_encode($odgovor);
}

function pridobi_termine_uporabnika($ID_uporabnika)
{
	global $zbirka;
	$odgovor=array();
	$ID_uporabnika=mysqli_escape_string($zbirka, $ID_uporabnika);
	
	$poizvedba="SELECT f.Ime as Ime_fitnesa, t.datum as Datum FROM termin t join fitnes f ON(t.ID_fitnesa = f.ID_fitnesa) join uporabnik u ON(u.ID_uporabnika = t.ID_uporabnika) WHERE u.ID_uporabnika='$ID_uporabnika' ";
	
	$rezultat=mysqli_query($zbirka, $poizvedba);

	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;
	}
	
	http_response_code(200);		//OK
	echo json_encode($odgovor);
}


// *********** Dopolnite še z ostalimi funkcijami


?>