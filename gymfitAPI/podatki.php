<?php 
	$DEBUG = true;							// Priprava podrobnejših opisov napak (med testiranjem)

	include("orodja.php"); 					// Vključitev 'orodij'

	header('Content-Type: application/json');	

	header ("Access-Control-Allow-Origin: *");
	header ("Access-Control-Allow-Headers: Content-type, application/x-www-form-urlencoded, Authorization, Accept, application/json");
	header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
	header ("Access-Control-Allow-Headers: *");
	
	$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko
	if($_SERVER["REQUEST_METHOD"]=='GET')
	{	
		// uporabimo funkcijo apache_request_headers(), ker spremenljivka $_SERVER ne vsebuje vseh polj zaglavja (headerja)
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
					echo $user_level;
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
	}
?>