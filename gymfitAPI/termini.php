<?php
$DEBUG = true;							

include("orodja.php"); 					

$zbirka = dbConnect();					

header('Content-Type: application/json');	

header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Method: GET, POST, PUT, DELETE');

switch($_SERVER["REQUEST_METHOD"])	
{
	case 'GET':
		if(!empty($_GET["ID_uporabnika"]))
		{
			pridobi_termine_uporabnika($_GET["ID_uporabnika"]);		
		}
		else
		{
			pridobi_vse_termine();				
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
			http_response_code(400);    
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
	
	$poizvedba="SELECT f.Ime as Ime_fitnesa, t.datum as Datum FROM termin t join fitnes f ON(t.ID_fitnesa = f.ID_fitnesa) join uporabnik u ON(u.ID_uporabnika = t.ID_uporabnika) WHERE u.ID_uporabnika='$ID_uporabnika' ORDER BY Datum";
	
	$rezultat=mysqli_query($zbirka, $poizvedba);

	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;
	}
	
	http_response_code(200);		//OK
	echo json_encode($odgovor);
}

function dodaj_termin()
{
	global $zbirka, $DEBUG;
	$podatki = json_decode(file_get_contents('php://input'), true);
	
	//če so podatki ustrezni
	if(isset($podatki["ID_uporabnika"], $podatki["ID_fitnesa"], $podatki["datum"]))
	{
		$ID_uporabnika=mysqli_escape_string($zbirka, $podatki["ID_uporabnika"]);
		$ID_fitnesa=mysqli_escape_string($zbirka, $podatki["ID_fitnesa"]);
		$datum=mysqli_escape_string($zbirka, $podatki["datum"]);

		$poizvedba= "INSERT INTO termin (ID_uporabnika, ID_fitnesa, datum) VALUES ('$ID_uporabnika', '$ID_fitnesa', '$datum')";
		
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
	}
	else
	{
		http_response_code(400);					//bad request
		pripravi_odgovor_napaka("Nekaj je narobe!");
	}
}


?>