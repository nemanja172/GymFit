<?php
$DEBUG = true;							

include("orodja.php"); 					

$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko

header('Content-Type: application/json');
header("Accept", "application/json");	

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization");

$headers = apache_request_headers();	

// preverimo, ce je prisotno polje Authorization
if(isset($headers['Authorization'])) 
{
	$headers = trim($headers["Authorization"]);
	
	// preverimo, ce je vrsta avtentikacije 'Bearers', in shranimo zeton
	if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) 
	{
		// preverimo, ce je zeton v bazi ujema z zetonom v brskalniku, potem preverimo 
		$sql = "SELECT * from uporabnik where token = '$matches[1]'";
		//echo $sql;
		$result=mysqli_query($zbirka,$sql);
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
		}
		else
		{
			echo "Ni pravega žetona, ni pravih podatkov!";
			http_response_code(401);
		}
	}
	else{
		echo "Ni žetona, ni podatkov!";
		http_response_code(401);
	}
}
else{
	echo "Ni žetona, ni podatkov!";
	http_response_code(401);
}

switch($_SERVER["REQUEST_METHOD"])		
{
	case 'GET':
		if(!empty($_GET["ID_fitnesa"]))
		{
			pridobi_fitnes($_GET["ID_fitnesa"]);		
		}
		elseif($user_level == '0' || $user_level == '1') 
		{
			pridobi_vse_fitnese();					
		}
		else
		{
			http_response_code(400);    
		}
		break;
		
	case 'POST':
		if($user_level == '1') 
		{
			dodaj_fitnes();
		}
		else
		{
			http_response_code(400);    
		}
		break;

	case 'PUT':
		if(!empty($_GET["ID_fitnesa"]) && $user_level == '1')
		{
			posodobi_fitnes($_GET["ID_fitnesa"]);
		}
		else
		{
			http_response_code(400);    
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

	case 'OPTIONS':
		http_response_code(204);
		break;
		
	default:
		http_response_code(405);		
		break;
}

mysqli_close($zbirka);					

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
		if(!fitnes_obstaja($ime))	
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
	if(f_obstaja($ID_fitnesa))
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


function izbrisi_fitnes($ID_fitnesa)
{
	global $zbirka, $DEBUG;	
	$ID_fitnesa=mysqli_escape_string($zbirka, $ID_fitnesa);
	
	if(f_obstaja($ID_fitnesa))
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